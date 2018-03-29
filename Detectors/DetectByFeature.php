<?php namespace Detectors;

use ast;
use Detectors\Finding\Confident;

/**
 * There is full confidence in language feature detection
 */
class DetectByFeature
{
  public $priority = 70;

  public function __construct($version, callable $detector, $name='')
  {
    $this->version = $version;
    $this->detector = $detector;
    $this->feature = $name;    
  }

  function investigate($node, $context=null) 
  { 
    $detector = $this->detector;
    $matched = $detector($node);
    if (!$matched) {return null;}
    
    return new Confident ($this->feature);
  }
}
