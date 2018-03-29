<?php namespace Detectors;

use Detectors\Finding;

class DetectVersionSet
{
  public function __construct($version, $detectors=[])
  {
    $this->version = $version;
    $this->detectors = $detectors;
    $this->notes = [];
    $this->quickCheck = true;
  }

  public function shouldInvestigate()
  {
    return !(($this->quickCheck === true) and $this->foundEvidence());
  }
  
  public function investigate($node, $file, $context=null): void
  {
    foreach ($this->detectors as $detector) {
      $finding = $detector->investigate($node);
      if (is_null($finding)) {continue;}
      $class = class_shortname($detector);
      $class = str_replace('DetectBy', '', $class);
      $this->notes[] = [$this->version, $class, $finding, $file, $node->lineno,];
      if ($this->quickCheck === true) {
        // break;
      }
    }
  }

  public function getNotes(): array 
  {
    return $this->notes;
  }

  public function foundEvidence(): bool
  {
    return count($this->notes) > 0;
  }
}
