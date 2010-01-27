#!/usr/bin/php
<?php

$input = "";
$fp = fopen("php://stdin", "r");
while ( $line = fgets($fp, 1024) )
$input .= $line;

fclose($fp);


echo create_doc_block($input);

/** Functions **/
function create_doc_block($input) {
  $output = '';

  // Get name of function.
  $input_formatted = _get_string_between($input, 'function', '(');

  // Process parameters.
  $signature = _get_string_between($input, '(', ')');
  $parameters = explode(',', $signature);
  $parameters_output = '';
  foreach($parameters as $param) {
    $parameter_formatted = '
 *
 * @param ' . $param . '
 *   Variable.';
   $parameters_output .= $parameter_formatted;
  }
  // Add a return documentation.
  $return_output = '';
  $return_param = strpos($input, 'return');
  if($return_param) {
    $return_output = '
 *
 * @return
 *   Return.';

  }

  $output .= '/**
 * This function ' . trim($input_formatted) . '  $$IP$$.'
  . $parameters_output
  . $return_output . '
 */
' . $input ;

 return $output;
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