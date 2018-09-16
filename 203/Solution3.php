<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/16
 * Time: 下午12:12
 */

/**
 * 递归解法
 *
 * Class Solution
 */
class Solution3
{

    /**
     *
     *  模拟调用，例如：[1, 2, 3] 删除 2
     *
     *  1->2->3->null
     *               => 2->3->null
     *                            => 3->null
     *                                      => null
     *                                      <= null
     *                            <= 3->null
     *               <=  3->null
     *  1->3->null
     *
     */
    public function removeElements($head, int $val)
    {
        if ($head == null) {
            return $head;
        }

        $head->next = $this->removeElements($head->next, $val);
        return $head->val == $val ? $head->next : $head;
    }

}