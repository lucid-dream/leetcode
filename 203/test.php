<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/16
 * Time: 上午10:30
 */
include "ListNode.php";
include "Solution.php";

try {

    echo '<pre>';

    $solution = new Solution();
    $nums = [1, 2, 3, 4, 1, 6];

    $node = new ListNode();
    $node->init($nums);
    print_r($node);

    $res = $solution->removeElements($node, 1);
//    $res = $solution->removeElements($node, 2);
    print_r($res);


} catch (Exception $exception) {

    echo $exception->getMessage();

}