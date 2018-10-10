<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/10
 * Time: 上午9:48
 */

class Solution
{

    public function intersection($nums1, $nums2) : array
    {

        $map = new \Ds\Map();

        foreach ($nums1 as $num) {
            if (!$map->hasKey($num)) {
                $map->put($num, 1);
            } else {
                $map->put($num, $map->get($num) + 1);
            }
        }

        $list = [];

        foreach ($nums2 as $num) {

            // 是否包含元素
            if ($map->hasKey($num)) {
                $list[] = $num;

                $map->put($num, $map->get($num) - 1);
                if($map->get($num) == 0) {
                    $map->remove($num);
                }
            }
        }

        return $list;

    }

}

$solution = new Solution();

$nums1 = [4,9,5,4];
$nums2 = [9,4,9,8,4];

$data = $solution->intersection($nums1, $nums2);

var_dump($data);