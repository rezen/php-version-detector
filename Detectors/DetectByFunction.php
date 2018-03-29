<?php namespace Detectors;

use ast;
use Detectors\Finding\Possible;
use Detectors\Finding\Confident;


class DetectByFunction extends DetectInList
{
  public $priority = 30;
  public $checked = [];

  public function investigate($node, $context=null) 
  {

    if ($node->kind !== ast\AST_CALL) {return null;}

    $name = $node->children['expr']->children['name'];

    if ($name === 'function_exists') {
      $arg = $node->children['args']->children[0];
      if (is_string($arg)) {
        $this->checked[] = $arg;
      }
      return null;
    }

    if (!in_array($name, $this->list)) {return null;}

    if (in_array($name, $this->checked)) {
      return new Possible($name, "There was a check for function_exists");
    }

    return new Confident($name);
  }
}