<?php namespace Detectors;

class DetectInList
{
  public $priority = 10;

  public function __construct($version, $list=[])
  {
    $this->version = $version;
    $this->list    = $list;
    $this->node    = null;
    $this->found   = null;
  }
}