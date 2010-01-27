#!/usr/bin/php
<?php

$input = "";

$fp = fopen("php://stdin", "r");
while ( $line = fgets($fp, 1024) )
$input .= $line;

fclose($fp);

process_function($input);

function process_function($input) {
  $output = '// $Id$

/**
 * @file
 *
 * Description of file.
 */
';

  echo $output;

}

?>