<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/20
 * Time: 12:46 PM
 */

class WordDictionary
{

    private $root = null; //Node

    public function __construct()
    {
        $this->root = new Node();
    }

    // 向Trie中添加一个新的单词word
    public function addWord(String $word) : void
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

        }

    }

    // 查询单词word是否在Trie中
    public function search(String $word): bool
    {
        return $this->match($this->root, $word, 0);
    }

    // 匹配
    public function match(Node $node, string $word, int $index) : bool
    {

        // 递归到底情况
        if($index == strlen($word)) {
            return $node->isWord;
        }

        $c = $word[$index];

        if ($c != '.') {

            if ($node->next->haskey($c) === false) {
                return false;
            }

            return $this->match($node->next->get($c), $word, $index+1);

        } else {


            $keys = $node->next->keys();

            foreach ($keys as $key) {

                if ($this->match($node->next->get($key), $word, $index+1)) {

                    return true;
                }


            }

            return false;

        }

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

try {

    $wd = new WordDictionary();
    $wd->addWord("bad");
    $wd->addWord("dad");
    $wd->addWord("mad");

    echo '<pre>';

    var_dump($wd->search("pad")); // -> false
    var_dump($wd->search("bad")); // -> true
    var_dump($wd->search(".ad")); // -> true
    var_dump($wd->search("b..")); // -> true

    print_r($wd);

} catch (Error $error) {

    echo $error->getMessage();

}




