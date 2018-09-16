<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/16
 * Time: 下午12:12
 */

/**
 * 虚拟头节点解法
 *
 * Class Solution
 */
class Solution2
{

    public function removeElements($head, int $val)
    {
        // 相比普通解法少一层 while($head) 逻辑
        $dummyHead = new ListNode(-1);
        $dummyHead->next = $head;

        $prev = $dummyHead;

        while ($prev->next != null) {
            if ($prev->next->val == $val) {
                $prev->next = $prev->next->next;
            } else {
                $prev = $prev->next;
            }
        }
        return $dummyHead->next;
    }

}