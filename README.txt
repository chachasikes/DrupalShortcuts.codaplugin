A plugin for Panic Coda which creates shortcuts for common Drupal 
code typing tasks.

Features include:
*DrupalDocBlock
*DrupalFileBlock

--------------------------------------------------------------------------------

*DrupalDocBlock: Create a doc block for a function.

  How to use:
  *Select a function and type Command-.
    
  A Drupal code standard doc block will be created.
  Based on these standards: http://drupal.org/node/1354?no_cache=1264546172

  @return only appears if your function has a return value.

An example:

_____________
function myFunction($param1, $param2) {
  return 'string';
}
_____________

becomes:

_____________

/**
 * Description of myFunction.
 *
 * @param $param1
 *   Parameter description here.
 *
 * @param  $param2
 *   Parameter description here.
 *
 * @return
 *   Return description here.
 */
function myFunction($param1, $param2) {
  return 'string';
}
_____________





*DrupalFileBlock: Create the block of text that goes at the
 beginning of Drupal files.

// $Id$

/**
 * @file
 *
 * Description of file.
 */
