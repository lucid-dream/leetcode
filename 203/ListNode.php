<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/16
 * Time: 上午10:11
 */

class ListNode
{
    public $val;
    public $next; //ListNode
    public function __construct(int $x = -1)
    {
        $this->val = $x;
    }

    // 初始化测试数据
    public function init(array $arr)
    {
        if (empty($arr)) {
            return $this;
        }

        $this->val = $arr[0];
        $cur = $this;

        foreach ($arr as $key => $val) {

            if ($key > 0) {
                $cur->next = new ListNode($val);
                $cur = $cur->next;
            }

        }

        return $this;

    }


}