<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/15
 * Time: 下午9:29
 */

class Solution
{

    public function topKFrequent(array $nums, int $k)
    {
        // 最大堆， java PriorityQueue 类是最小堆
        $queue = new \Ds\PriorityQueue();

        $map = new \Ds\Map();

        foreach ($nums as $num) {

            // Map (key => 频次)
            if (!$map->hasKey($num)) {
                $map->put($num, 1);
            } else {
                $map->put($num, $map->get($num) + 1);
            }
        }

        foreach ($map->toArray() as $key => $freq) {

            // 维持堆的高度不超过 $k
            if($queue->count() < $k) {

                $queue->push($key, $freq);

            } elseif ($freq > $map->get($queue->peek())) {

                //每次遍历map中的频次 和 堆首(最大值) 做比较，如果频次大于堆首，则移除堆末尾元素，并添加当前元素
                $queue->pop();
                $queue->push($key, $freq);

            }

        }

        $list = $queue->toArray();
        return $list;
    }


}

$solution = new Solution();
$solution->topKFrequent([1, 1, 1, 2, 2, 3], 2);