<?php namespace Detectors\Printers;


function printCli($notes=[]) {
  echo "v   | type    | confirmed | file                 | line". PHP_EOL;
  echo str_repeat("-", 60) . PHP_EOL;

  foreach ($notes as $note) {
    $parts = [ 
      str_pad($note[0], 3), 
      str_pad($note[1], 7),
      str_pad(\Detectors\class_shortname($note[2]), 9), 
      $note[3],
      $note[4]
    ];

    echo implode(' | ', $parts) . PHP_EOL;
  }
}

