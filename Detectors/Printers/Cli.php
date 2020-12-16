<?php namespace Detectors\Printers;


function printCli($notes=[]) {
  echo str_repeat("-", 100) . PHP_EOL;
  echo "v   | type    | confirmed | evidence                      | file                      | line". PHP_EOL;
  echo str_repeat("-", 100) . PHP_EOL;

  foreach ($notes as $note) {
    $parts = [ 
      str_pad($note[0], 3), 
      str_pad($note[1], 7),
      str_pad(\Detectors\class_shortname($note[2]), 9),
      str_pad($note[2]->name, 29),
      str_pad($note[3], 25),
      $note[4]
    ];

    echo implode(' | ', $parts) . PHP_EOL;
    echo str_repeat("-", 100) . PHP_EOL;
  }
}

