<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/16
 * Time: 上午10:10
 */

/***
    删除链表中等于给定值 val 的所有节点。
        示例:
            输入: 1->2->6->3->4->5->6, val = 6
            输出: 1->2->3->4->5
 */

/**
 * 普通解法
 *
 * Class Solution
 */
class Solution
{

    public function removeElements($head, int $val)
    {

        // 如果头节点(第一个节点) 值相等情况
        // 例如 $head = [1,2,3,4,1] , $val = 1 情况
        while ($head != null && $head->val == $val) {
            $delNode = $head;
            $head = $head->next;
            $delNode->next = null;
        }

        if ($head == null) {
            return $head;
        }

        $prev = $head;
        while ($prev->next != null) {

            if ($prev->next->val == $val) {

                $delNode = $prev->next;
                $prev->next = $delNode->next;

                $delNode->next = null;

            } else {

                $prev = $prev->next;

            }

        }

        return $head;
    }

}


