<?php
/**
 * LRU 最近最少使用策略 LRU（Least Recently Used）。
 *
 * 1. 如果此数据之前已经被缓存在链表中了，我们遍历得到这个数据对应的结点，并将其从原来的位置删除，然后再插入到链表的头部。
 * 2. 如果此数据没有在缓存链表中，又可以分为两种情况：
 *  如果此时缓存未满，则将此结点直接插入到链表的头部；
 *  如果此时缓存已满，则链表尾结点删除，将新的数据结点插入链表的头部。这样我们就用链表实现了一个 LRU 缓存
 *
 *   空间复杂度 O(n)
 *   时间复杂度O(n) 操作链表每次需要查询遍历
 */

/**
 * node
 *
 * Class LRUBaseLinkedListNode
 */
class LRUBaseLinkedListNode
{

    /**
     * 数据值
     *
     * @var int
     */
    private $data;

    /**
     * 指针
     *
     * @var object
     */
    public $next;

    /**
     * LRUBaseLinkedListNode constructor.
     *
     * @param null $data
     * @param null $next
     */
    public function __construct($data = null, $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }

    /**
     * 设置指针
     *
     * @param $node
     * @return $this
     */
    public function setNext($node)
    {
        $this->next = $node;
        return $this;
    }

    /**
     * 获得成员属性
     *
     * @param $var
     * @return mixed
     */
    public function __get($var)
    {
        return $this->$var;
    }
}

/**
 * 链表操作类
 *
 * Class LRUBaseLinkedList
 */
class LRUBaseLinkedList
{

    /**
     * 头数据
     *
     * @var LRUBaseLinkedListNode
     */
    public $head;

    /**
     * 链表最大存储个数
     *
     * @var int
     */
    private $maxNum = 10;

    /**
     * 当前链表的总长度
     *
     * @var int
     */
    private $count = 0;

    /**
     * LRUBaseLinkedList constructor.
     */
    public function __construct()
    {
        // 边界
        $this->head = new LRUBaseLinkedListNode();
    }

    /**
     * 向链表头插入数据
     *
     * @param $data
     * @return $this
     */
    public function insertHead($data)
    {

        $preNode = $this->getPreNode($data);

        if ($preNode == null) {
            if ($this->count >= $this->maxNum) {
                $this->delTail();
            }
            $this->_insertHead($data);
        } else {

            // preNode 指针指向当前的下一级
            $preNode->next = $preNode->next->next;
            $this->_insertHead($data);
        }

        return $this;
    }

    /**
     * 删除链表最后一个元素
     *
     * @return $this|void
     */
    public function delTail()
    {
        // 空链表
        if ($this->head->next == null) {
            return;
        }

        // 获得倒数第二个节点，让倒数第二个节点的 next 为 null
        $ptr = $this->head;
        while ($ptr->next->next != null) {
            $ptr = $ptr->next;
        }

        $ptr->setNext(null);
        $this->count--;

        return $this;
    }

    /**
     * 打印链表数据
     */
    public function printAll()
    {
        $node = $this->head->next;
        $rs = '';
        while ($node != null) {
            $rs .= sprintf("%s, ", $node->data);
            $node = $node->next;
        }
        echo rtrim($rs, ', ') . "\n";
    }

    /**
     * 执行插入操作
     *
     * @param $data
     */
    private function _insertHead($data)
    {
        // 获取上一个元素的前一个节点
        $next = $this->head->next;

        $node = new LRUBaseLinkedListNode($data, $next);
        $this->head->setNext($node);
        $this->count++;
    }

    // 如果存在，获取我上一个节点的指针
    public function getPreNode($data)
    {
        $node = $this->head;
        while ($node->next != null) {
            if ($data == $node->next->data) {
                return $node;
            }
            $node = $node->next;
        }

        return null;
    }
}

$rs = new LRUBaseLinkedList();
$rs->insertHead(13)
    ->insertHead(10)
    ->insertHead(12)
    ->insertHead(14);

$rs->printAll();
