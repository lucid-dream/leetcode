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

        $maxFreq = 100; // 假设最大的频次不超过100

        foreach ($nums as $num) {

            // Map (key => 出现的频次)
            if (!$map->hasKey($num)) {
                $map->put($num, 1);
            } else {
                $map->put($num, $map->get($num) + 1);
            }
        }

        foreach ($map->toArray() as $key => $freq) {

            // 维持堆的大小 不超过 $k
            if($queue->count() < $k) {

                $queue->push($key, $maxFreq - $freq);

            } elseif ($freq > $map->get($queue->peek())) {

                //每次遍历map中的频次 和 堆首(最大值) 做比较，如果频次大于堆首，则移除堆末尾元素，并添加当前元素
                $queue->pop();
                // $maxFreq - $freq ( 最小堆 ) 让频次最小的key, 放到堆首 ,以便pop()移除的是 最小的频次key
                $queue->push($key, $maxFreq - $freq);

            }

        }

        $list = $queue->toArray();
        return $list;
    }


}

$solution = new Solution();
$solution->topKFrequent([1, 1, 1, 2, 2, 3], 2);