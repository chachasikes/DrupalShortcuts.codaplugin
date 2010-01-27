#!/usr/bin/php
<?php

$input = "";

$fp = fopen("php://stdin", "r");
while ( $line = fgets($fp, 1024) )
$input .= $line;

fclose($fp);

generate_output($input);

function generate_output($input) {
  echo function_sugar($input);
}

/**
 * Convert a function from an informal sugar syntax to
 * a properly formatted Drupal function.
 *
 * Example:
 * 1. Enter:
 * function functionname $variable $variable $variable : $variable
 *
 * - Separate arguments by spaces, not commas.
 * - Enter a color then
 *
 * 2. Select what you have typed. 
 * -It will receive all the function formatting,
 *
 */
function function_sugar($input) {
  $output = '';
  $input_clean = preg_replace('/\s\s+/', ' ', $input);
  $return_string = explode(':', $input_clean);

  $return = trim($return_string[1]);
  $args = explode(' ', $return_string[0]);

  $output = '
' .   trim(array_shift($args)) . ' ' . trim(array_shift($args));
  // Remove last item if it is empty.
  $last_arg = $args[count($args) - 1];
  if(empty($last_arg)) {
    array_pop($args);
  }
  $output .= '(' . implode(', ', $args) . ')' . ' {
  ';
  
  if (!empty($return)) {
    $output .= '
  return ' . $return . ';';
  }

  $output .= '
}'
;
  $output = create_doc_block($output);
  return $output;
}

/**
 * Generate a Drupal doc block.
 */
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
 * @param ' . trim($param) . '
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
 * This function ' . trim($input_formatted) . ' $$IP$$.'
  . $parameters_output
  . $return_output . '
 */' . $input ;
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