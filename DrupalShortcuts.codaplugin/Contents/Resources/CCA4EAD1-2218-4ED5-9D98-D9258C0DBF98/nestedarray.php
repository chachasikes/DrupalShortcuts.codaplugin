#!/usr/bin/php
<?php

$input = "";

$fp = fopen("php://stdin", "r");
while ( $line = fgets($fp, 1024) )
$input .= $line;

fclose($fp);

echo nested_array($input);

function nested_array($input) {
$output = $input . " = array(
    '' => '',
    '' => array(
        '' => '',
    ),     
  );";
  return $output;
}

?>