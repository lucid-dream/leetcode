<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/16
 * Time: 上午10:37
 */

include 'Solution.php';

$solution = new Solution();

$result = $solution->isValid("[]");
var_dump($result);

$result = $solution->isValid("()[]{}");
var_dump($result);

$result = $solution->isValid("(]");
var_dump($result);

$result = $solution->isValid("([)]");
var_dump($result);

$result = $solution->isValid("{[]}");
var_dump($result);