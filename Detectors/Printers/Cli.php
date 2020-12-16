<?php namespace Detectors\Printers;


function printCli($notes=[]) {
  echo str_repeat("-", 100) . PHP_EOL;
  echo "v   | type    | confirmed | evidence                      | file                          | line". PHP_EOL;
  echo str_repeat("-", 100) . PHP_EOL;

  foreach ($notes as $note) {
    $parts = [ 
      str_pad($note->version, 3), 
      str_pad($note->class, 7),
      str_pad(\Detectors\class_shortname($note->finding), 9),
      str_pad($note->finding->name, 29),
      str_pad($note->file, 29),
      $note->node->lineno
    ];

    echo implode(' | ', $parts) . PHP_EOL;
    echo str_repeat("-", 100) . PHP_EOL;
  }
}

