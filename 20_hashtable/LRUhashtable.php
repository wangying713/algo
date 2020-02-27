<?php
/**
 * LRU 最近最少使用策略 LRU（Least Recently Used）。其实 php 做散列表意义不大，只是为了学习而已，php 的数组本身就是散列实现的。支持字符串当做 key
 *
 * 1. 如果此数据之前已经被缓存在链表中了，我们遍历得到这个数据对应的结点，并将其从原来的位置删除，然后再插入到链表的头部。
 * 2. 如果此数据没有在缓存链表中，又可以分为两种情况：
 *  如果此时缓存未满，则将此结点直接插入到链表的头部；
 *  如果此时缓存已满，则链表尾结点删除，将新的数据结点插入链表的头部。这样我们就用链表实现了一个 LRU 缓存
 *
 *   空间复杂度 O(n)
 *   时间复杂度O(1)
 */
class LRUhashtable
{
    public $head;

    /**
     * 缓存中最大的存储个数
     *
     * @var int
     */
    private $maxNum = 10;

    /**
     * 链表的长度
     *
     * @var int
     */
    private $num = 0;

    /**
     * 链表
     *
     * @var array
     */
    public $hashTable = [];

    public function __construct()
    {
        $this->head = new Node();
    }

    /**
     * 监测链表中是否存在这个数据
     *  1. 如果存在，那么将其删除
     *  2. 将新的数据插入表头
     *
     * @param [string] $val
     *
     * @return void
     */
    public function add($val)
    {
        if (($originNode = $this->getNode($val)) != null) {
            $this->delete($originNode);
        }

        if ($this->num >= $this->maxNum) {
            $node = current($this->hashTable);
            $preNode = $node->prev;
            $preNode->next = null;
        }

        // 新 node 的节点
        $node = new Node($val);

        // 新节点的前指针指向新节点
        $this->head->prev = $node;

        // 新节点的后指针指向现在的头节点
        $node->next = $this->head;
        // 更新到头
        $this->head = $node;

        // hashkey
        $hashKey = $this->getHashKey($val);
        $this->hashTable[$hashKey] = $node;

        $this->num++;
    }

    /**
     * 删除节点
     *
     * @param Node $node
     *
     * @return void
     */
    public function delete(Node $node)
    {
        $preNode = $node->prev;
        $nextNode = $node->next;

        $preNode->next = $nextNode;
        $nextNode->prev = $preNode;
    }

    /**
     * 获取节点
     *
     * @param [int] $val
     *
     * @return void
     */
    public function getNode($val)
    {
        $hashKey = $this->getHashKey($val);

        return isset($this->hashTable[$hashKey]) ? $this->hashTable[$hashKey] : null;
    }

    /**
     * 获取 haskkey
     *
     * @param [int] $val
     *
     * @return void
     */
    public function getHashKey($val)
    {
        return $val;
    }
}

class Node
{
    public $prev;
    public $val;
    public $next;
    public $hnext;

    public function __construct($val = null, $prev = null, $next = null)
    {
        $this->val = $val;
        $this->prev = $prev;
        $this->next = $next;
    }
}
$rs = new LRUhashtable();
$rs->add(1);
$rs->add(2);
$rs->add(3);
$rs->add(4);
$rs->add(5);
$rs->add(6);
$rs->add(7);
$rs->add(8);
$rs->add(9);
$rs->add(10);
$rs->add(11);
$rs->add(12);
$rs->add(13);
$rs->add(14);
$rs->add(15);
$rs->add(16);

print_r($rs);
