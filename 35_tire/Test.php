<?php
/**
 * Trie 树也叫字典书，是一种树形结构，它是一种专门处理字符串匹配的数据结构
 * Tire 树的本质是就是利用字符串之间的公共前缀，将重复的前缀合并在一起最后构造成树。
 */
class TireTree
{
    public $root;

    public function __construct()
    {
        $this->root = new TireNode('/');
    }

    public function insert($data)
    {
        $node = $this->root;
        $len = strlen($data);
        for ($i = 0; $i < $len; $i++) {
            // 假设不包括中文
            $k = ord($data[$i]);
            if (!isset($node->children[$k])) {
                $newNode = new TireNode($data[$i]);
                $node->children[$k] = $newNode;
            }
            $node = $node->children[$k];
        }
    }

    public function find($pattern)
    {
        $node = $this->root;
        for ($i = 0; $i < strlen($pattern); $i++) {
            $index = ord($pattern[$i]);
            if (isset($node->children[$index])) {
                $node = $node->children[$index];
            } else {
                return false;
            }
        }
        return true;
    }
}

class TireNode
{
    public $data;
    public $children = [];

    public function __construct($data)
    {
        $this->data = $data;
    }
}

$rs = new TireTree();
$rs->insert('how');
$rs->insert('hi');
$rs->insert('her');

$rs = $rs->find('h');
var_dump($rs);
