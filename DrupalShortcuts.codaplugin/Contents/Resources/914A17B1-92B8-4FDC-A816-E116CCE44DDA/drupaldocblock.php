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
 *   Parameter description here';
   $parameters_formatted .= $parameter_formatted;
  }


  $output = '
/**
 * Description of ' . trim($input_formatted) . '.' 
  . $parameters_formatted .'
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




/**
 * Summary here; one sentence on one line (even if it exceeds 80 chars).
 *
 * A more detailed description goes here.
 *
 * A blank line forms a paragraph. There should be no trailing white-space
 * anywhere.
 *
 * @param $first
 *   "@param" is a Doxygen directive to describe a function parameter. Like some
 *   other directives, it takes a term/summary on the same line, and a
 *   description (this text) indented by 2 spaces on the next line. All
 *   descriptive text should wrap at 80 chars.
 *   Newlines are NOT supported within directives; if a newline would be before
 *   this text, it would be appended to the general description above.
 * @param $second
 *   There should be no newline between multiple directives of the same type.
 *
 * @return
 *   "@return" is a different Doxygen directive to describe the return value of
 *   a function, if there is any.
 */



// $Id: theme.inc,v 1.202 2004/07/08 16:08:21 dries Exp $

/**
 * @file
 * The theme system, which controls the output of Drupal.
 *
 * The theme system allows for nearly all output of the Drupal system to be
 * customized by user themes.
 */
?>