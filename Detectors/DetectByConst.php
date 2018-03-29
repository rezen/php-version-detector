<?php namespace Detectors;

use ast;
use Detectors\Finding\Possible;
use Detectors\Finding\Confident;


class DetectByConst extends DetectInList
{
  function investigate($node, $context=null) 
  {
    if ($node->kind !== ast\AST_CONST) {return null;}

    $name = $node->children['name']->children['name'];

    if (!in_array($name, $this->list)) {return null;}
    return new Possible($name);
  }
}
