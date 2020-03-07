<?php
/**
 * Trie 树，也叫“字典树”。顾名思义，它是一个树形结构
 *
 * 时间复杂度分析：
 *  用 Trie 树会非常高效。
 *  构建 Trie 树的过程，需要扫描所有的字符串，时间复杂度是 O(n)（n 表示所有字符串的长度和）。
 *  但是一旦构建成功之后，后续的查询操作会非常高效。
 *  其中查找字符串的时间复杂度是 O(k)，k 表示要查找的字符串的长度。
 *
 */
class Trie
{
    private $root;

    public function __construct()
    {
        // 带头链表
        $this->root = new TrieNode('/');
    }

    /**
     * 向 trie 树中插入一个字符串
     *
     * @param [type] $text
     *
     * @return void
     */
    public function insert($text)
    {
        $p = $this->root;
        $length = strlen($text);
        for ($i = 0; $i < $length; $i++) {
            // 从下标0开始插入
            $index = ord($text[$i]) - ord('a');
            if (!isset($p->children[$index])) {
                $newNode = new TrieNode($text[$i]);
                $p->children[$index] = $newNode;
            }
            $p = $p->children[$index];
        }

        $p->isEndingChar = true;
    }

    /**
     * 在 trie树中查找字符串
     *
     * @param [string] $pattern
     *
     * @return boolean
     */
    public function find($pattern)
    {
        $p = $this->root;
        $length = strlen($pattern);
        for ($i = 0; $i < $length; $i++) {
            $index = ord($pattern[$i]) - ord('a');
            if (!isset($p->children[$index])) {
                return false;
            }
            $p = $p->children[$index];
        }

        if ($p->isEndingChar == false) {
            return false;
        } else {
            return true;
        }
    }

}

class TrieNode
{
    public $data;
    public $children = [];
    public $isEndingChar = false;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

$rs = new Trie();

$rs->insert('hello');
$rs->insert('hi');
$rs->insert('hear');

print_r($rs);

var_dump($rs->find('hello'));
