<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/21
 * Time: 12:58 PM
 */

class MapSum
{

    private $root = null; //Node

    public function __construct()
    {
        $this->root = new Node();
    }

    public function insert(string $key, int $val) : void
    {
        $cur = $this->root;

        for($i = 0 ; $i < strlen($key) ; $i++) {

            $c = $key[$i];

            if ($cur->next->haskey($c) === false) {

                $cur->next->put($c, new Node()); // Key(String) => Value(Node)

            }

            $cur = $cur->next->get($c); //如果 haskey($c) == false, 则该行为Nil

        }

        $cur->value = $val;

    }

    public function sum(string $prefix) : int
    {

        $cur = $this->root;

        for ($i = 0 ; $i < strlen($prefix); $i++) {

            $c = $prefix[$i];

            if ($cur->next->haskey($c) === false) {
                return 0;
            }

            $cur = $cur->next->get($c);

        }

        return $this->sumNode($cur);

    }



    private function sumNode(Node $node) : int
    {

        $res = $node->value;

        $keys = $node->next->keys();

        foreach ($keys as $key) {
            $res += $this->sumNode($node->next->get($key));
        }

        return $res;

    }



}


class Node
{

    public $value; //int
    public $next; // TreeMap<Character, Node>
    public function __construct(int $value = 0)
    {
        $this->value = $value;
        $this->next = new \Ds\Map();
    }
}

echo "<pre>";

$mapSum = new MapSum();

$mapSum->insert("apple", 3);
echo $mapSum->sum("ap"). PHP_EOL; // 3
$mapSum->insert("app", 2); // 3+2 = 5
echo $mapSum->sum("ap"). PHP_EOL;

print_r($mapSum);