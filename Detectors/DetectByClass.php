<?php namespace Detectors;

use ast;
use Detectors\Finding\Possible;
use Detectors\Finding\Confident;


// By class has some uncertainity becaus
class DetectByClass extends DetectInList
{
  public $priority = 20;
  public $checked = [];

  function investigate($node, $context=null) 
  {
    // context for in class definitoin
    // @todo check for use statement for class references
    if ($node->kind === ast\AST_CALL && isset($node->children['expr'])) {
      $name = $node->children['expr']->children['name'];
      if ($name === 'class_exists') {
        $arg = $node->children['args']->children[0];
        $this->checked[] = is_string($arg) ? $arg : null;
      }
      return null;
    }

    if (!in_array($node->kind, [ast\AST_NEW, ast\AST_CLASS])) {return null;}
    
    $className = false;

    if ($node->kind === ast\AST_NEW) {
      $className = $node->children['class']->children['name'] ?? '';
    }

    if ($node->kind === ast\AST_CLASS && isset($node->children['extends'])) {
      $className = $node->children['extends']->children['name'];
    }

    if (!$className) {return null;}
    if (!in_array($className, $this->list)) {return null;}

    foreach ($this->checked as $class) {
      if (strpos($className, $class) !== false || strpos($class, $className) !== false ) {
        return new Possible("$className", "There was a check for class_exists");
      }
    }
 
    return new Confident($className);
  }
}
