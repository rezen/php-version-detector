<?php namespace Detectors;

use ast;
use ReflectionClass;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;


function class_shortname($object) {
  if (!is_object($object)) {
    return '';
  }

  return (new ReflectionClass($object))->getShortName();
}

function getDetectors() {
  $versions = [53, 54, 55, 56, 70, 71, 72];
  $versions = array_reverse($versions);
  $dir = realpath(dirname(__FILE__) . '../');
  return array_reduce($versions, function($aggr, $version) use ($dir) {
    $aggr[] = include("detect/php$version.php");
    return $aggr;
  }, []);
}


function investigateNode($node, $file, &$detectors) {  
  if (!is_object($node)) {
    return;
  }

  foreach ($detectors as $idx => $detector) {
    if (!$detector->shouldInvestigate()) {
      continue;
    }
    
    $detector->investigate($node, $file);
  }

  if (!isset($node->children)) {
    return;
  }

  foreach ($node->children as $child) {
    if (!is_object($child)) {
      continue;
    }

    investigateNode($child, $file, $detectors);
  }
}

function investigateFile($file, &$detectors) {
  $code = file_get_contents($file);
  $ast = ast\parse_code($code, $version=50);  
  
  investigateNode($ast, $file, $detectors);
}


// @todo skip directory flags
 
function rsearch($folder, $pattern) {
  $iterator = new RecursiveDirectoryIterator($folder);
  $files = [];
  foreach(new RecursiveIteratorIterator($iterator) as $file){
    if(strpos($file , $pattern) !== false){
      $files[] = $file;
    }
  }
  return $files;
}