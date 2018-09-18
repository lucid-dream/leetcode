<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/18
 * Time: 下午9:46
 */

include_once "BinarySearchTree.php";

class Solution
{

    public function uniqueMorseRepresentations(array $words) {

          $codes = [".-","-...","-.-.","-..",".","..-.","--.","....","..",".---","-.-",".-..","--","-.","---",".--.","--.-",".-.","...","-","..-","...-",".--","-..-","-.--","--.."];

          $tree = new BinarySearchTree();

          foreach ($words as $word) {

              $str = '';

              for ($i=0; $i < strlen($word); $i++) {

                  $str .= $codes[ord($word[$i]) - ord('a')];

              }

              $tree->add($str);

          }

          return $tree->getSize();

    }
}

$solution = new Solution();
$size = $solution->uniqueMorseRepresentations(["gin", "zen", "gig", "msg"]);
echo $size;