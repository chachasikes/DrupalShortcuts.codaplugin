#!/usr/bin/php
<?php

$input = "";

$fp = fopen("php://stdin", "r");
while ( $line = fgets($fp, 1024) )
$input .= $line;

fclose($fp);

process_function($input);

function process_function($input) {
  $output = '';

  // Get name of function.
  $input_formatted = _get_string_between($input, 'function', '(');

  // Process parameters.
  $signature = _get_string_between($input, '(', ')');
  $parameters = explode(',', $signature);
  $parameter_formatted = '';
  foreach($parameters as $param) {
    $parameter_formatted = '
 *
 * @param ' . $param . '
 *   Parameter description here.';
   $parameters_output .= $parameter_formatted;
  }

  // Add a return documentation.
  $return_param = strpos($input, 'return');
  if($return_param) {
    $return_output = '
 *
loaded
 * @return
 *   Return description here.';

  }

  $output = '
/**
 * Description of ' . trim($input_formatted) . '.'
  . $parameters_output
  . $return_output . '
 */
' . $input ;

  echo $output;

}

function _get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}
?>