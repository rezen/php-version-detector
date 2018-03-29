<?php


function class_shortname($object) {
  if (!is_object($object)) {
    return '';
  }

  return (new \ReflectionClass($object))->getShortName();
}


function printNotesCli($notes=[]) {
  echo "v   | type    | confirmed | file                 | line". PHP_EOL;
  echo str_repeat("-", 60) . PHP_EOL;

  foreach ($notes as $note) {
    $parts = [ 
      str_pad($note[0], 3), 
      str_pad($note[1], 7),
      str_pad(class_shortname($note[2]), 9), 
      $note[3],
      $note[4]
    ];

    echo implode(' | ', $parts) . PHP_EOL;
  }
}

function printNotesJson($notes=[]) {
  
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