<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/19
 * Time: 10:15 PM
 */

class Trie
{

    private $root = null; //Node
    private $size = 0;

    public function __construct()
    {
        $this->root = new Node();
        $this->size = 0;
    }

    // 向Trie中添加一个新的单词word
    public function insert(String $word) : void
    {

        $cur = $this->root;

        for($i = 0 ; $i < strlen($word) ; $i++) {

            $c = $word[$i];

            if ($cur->next->haskey($c) === false) {

                $cur->next->put($c, new Node()); // Key(String) => Value(Node)

            }

            $cur = $cur->next->get($c); //如果 haskey($c) == false, 则该行为Nil

        }

        // 当前 $cur 已经是 单词的最末尾，则标识是 单词
        if ($cur->isWord === false) {

            $cur->isWord = true;
            $this->size++;

        }

    }

    // 查询单词word是否在Trie中
    public function search(String $word): bool
    {
        $cur = $this->root;

        for($i = 0 ; $i < strlen($word) ; $i++) {

            $c = $word[$i];

            if ($cur->next->haskey($c) === false) {
                return false;
            }

            $cur = $cur->next->get($c);

        }

        return $cur->isWord;
    }

    // 查询是否在Trie中有单词以prefix为前缀
    public function startsWith(String $prefix) : bool
    {

        $cur = $this->root;

        for($i = 0 ; $i < strlen($prefix) ; $i++) {

            $c = $prefix[$i];

            if ($cur->next->haskey($c) === false) {
                return false;
            }

            $cur = $cur->next->get($c);

        }

        return true;
    }

}


class Node
{

    public $isWord; //boolean
    public $next; // TreeMap<Character, Node>
    public function __construct(bool $isWord = false)
    {
        $this->isWord = $isWord;
        $this->next = new \Ds\Map();
    }
}


$trie = new Trie();

$trie->insert("apple");
var_dump($trie->search("apple"));   // 返回 true
var_dump($trie->search("app"));     // 返回 false
var_dump($trie->startsWith("app")); // 返回 true

$trie->insert("app");               // isword 变为 true
var_dump($trie->search("app"));     // 返回 true

echo '<pre>';
print_r($trie);