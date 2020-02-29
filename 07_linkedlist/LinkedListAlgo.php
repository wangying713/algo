<?php

/**
 * 1) 单链表反转
 * 2) 链表中环的检测
 * 3) 两个有序的链表合并
 * 4) 删除链表倒数第n个结点
 * 5) 求链表的中间结点
 */
class LinkedListAlgo
{

    /**
     * @var LRULinkedListNode|null
     */
    protected $node = null;

    /**
     * 链表反转
     *
     * @param Node $node
     * @return Node|null
     */
    public function reverse(Node $node)
    {
        $cur = $node;
        $pre = null;
        while ($cur != null) {
            $next = $cur->getNext();
            // 将当前指针设置为 pre
            $cur->setNext($pre);
            // 上一个node=当前元素
            $pre = $cur;
            // 当前 node=next
            $cur = $next;
        }

        $this->node = $pre;
        return $pre;
    }

    /**
     * 检查环形链表 迭代方法
     *
     * 环形链表 不是环形返回 false，是环形返回当前环形的 data
     *
     * @param Node $node
     * @return bool|null
     */
    public function checkCircleHash(Node $node)
    {
        $arr = [];
        while (!isset($arr[$node->getData()])) {
            $arr[$node->getData()] = $node->getData();
            $node = $node->getNext();
        }

        if (isset($arr[$node->getData()])) {
            return $node->getData();
        }
        return false;
    }

    /**
     * 监测环形链表 快慢指针方式
     *
     * @param Node $node
     * @return bool
     */
    public function checkCircle(Node $node)
    {
        if ($node == null) {
            return false;
        }

        $slow = $node;
        $fast = $node->getNext();
        while ($fast != null && $fast->getNext() != null) {
            $slow = $slow->getNext();
            $fast = $fast->getNext()->getNext();
            if ($slow == $fast) {
                return true;
            }

        }

        return false;
    }

    /**
     * 将两个有序链表合并为一个新的有序链表并返回。新链表是通过拼接给定的两个链表的所有节点组成的。
     * 示例：
    输入：1->2->4, 1->3->4
    输出：1->1->2->3->4->4
     *
     * @param Node $list1
     * @param Node $list2
     */
    public function mergeLinkedList(Node $l1, Node $l2)
    {
        // 利用哨兵简化代码的难度
        $node = new Node();
        $pre = $node;
        while ($l1 != null && $l2 != null) {
            if ($l1->getData() < $l2->getData()) {
                $pre->setNext($l1);
                $l1 = $l1->getNext();
            } else {
                $pre->setNext($l2);
                $l2 = $l2->getNext();
            }
            $pre = $pre->getNext();
        }

        if ($l1 == null) {
            $pre->setNext($l2);
        }

        if ($l2 == null) {
            $pre->setNext($l1);
        }

        return $node->getNext();
    }

    /**
     * 递归合并两个有序链表
     *
     * @param $l1
     * @param $l2
     * @return mixed
     */
    public function mergeLinkedListRecursion($l1, $l2)
    {
        if ($l1 == null) {
            return $l2;
        }

        if ($l2 == null) {
            return $l1;
        }

        if ($l1->getData() < $l2->getData()) {
            $l1->setNext($this->mergeLinkedListRecursion($l1->getNext(), $l2));
            return $l1;
        } else {
            $l2->setNext($this->mergeLinkedListRecursion($l2->getNext(), $l1));
            return $l2;
        }
    }

    /**
     *  给定一个链表，删除链表的倒数第 n 个节点，并且返回链表的头结点。
    示例：
    给定一个链表: 1->2->3->4->5, 和 n = 2.
    当删除了倒数第二个节点后，链表变为 1->2->3->5.
    来源：力扣（LeetCode）
    链接：https://leetcode-cn.com/problems/remove-nth-node-from-end-of-list
    著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
     *
     * @param Node $node
     * @param $n
     */
    public function delLastNth(Node $head, $n)
    {
        $node = $head;
        $count = 0;
        while ($node != null) {
            $node = $node->getNext();
            $count++;
        }

        // 要删除第几个节点
        $nextNum = $count - $n;

        $node = $head;
        while ($nextNum > 1) {
            $node = $node->getNext();
            $nextNum--;
        }

        $node->setNext($node->getNext()->getNext());

        return $head;
    }

    /**
     * 删除第 n 个元素，一遍扫描方法
     *
     * @param $head
     * @param $n
     * @return mixed
     */
    public function delLastNth2(Node $head, $n)
    {
        $node = $head;
        $pre = $node;
        $i = 0;
        while ($node != null) {
            if ($i > $n) {
                $pre = $pre->getNext();
            }
            $node = $node->getNext();
            $i++;
        }

        // 删除带头大哥
        if ($pre->getNext() != null) {
            if ($i > $n) {
                $pre->setNext($pre->getNext()->getNext());
            } else {
                $head = $pre->getNext();
            }
        } else {
            $head = new Node();
        }

        return $head;
    }

    /**
     *
    给定一个带有头结点 head 的非空单链表，返回链表的中间结点。
    如果有两个中间结点，则返回第二个中间结点。
     *
     * @param Node $head
     * @return Node|null
     */
    public function getMiddleNode(Node $head)
    {
        $node = $head;
        // 暴力处理方法
        $count = 0;
        while ($node != null) {
            $node = $node->getNext();
            $count++;
        }

        $center = (int) ($count / 2);

        while ($center > 0) {
            $head = $head->getNext();
            $center--;
        }

        return $head;
    }

    /**
     * 构建一个环形链表
     *
     * @param Node $head
     * @param $nextNum 要环形在第几个链上
     * @return Node
     */
    public function buildCircleLinkedList(Node $head, $nextNum)
    {
        $node = $head;
        $i = 0;
        while ($node->getNext() != null) {
            // 链接到的 node
            if ($i == $nextNum) {
                $next = $node;
            }
            $node = $node->getNext();
            $i++;
        }
        $node->setNext($next);
        return $head;
    }

    /**
     * 插入数据到链表末尾
     *
     * @param $data
     * @return $this
     */
    public function insertTail($data)
    {
        $newNode = new Node($data, null);
        if ($this->node == null) {
            $this->node = $newNode;
        } else {
            $node = $this->node;
            while ($node->getNext() != null) {
                $node = $node->getNext();
            }
            $node->setNext($newNode);
        }

        return $this;
    }

    /**
     * 打印链表
     *
     * @param Node $node
     */
    public function printAll($node)
    {
        $rs = '';
        while ($node != null) {
            $rs .= sprintf("%s,", $node->getData());
            $node = $node->getNext();
        }

        echo rtrim($rs, ',') . "\n";
    }

    /**
     * 获得链表
     *
     * @return LRULinkedListNode|null
     */
    public function getNode()
    {
        return $this->node;
    }
}

class Node
{
    protected $data;
    protected $next;

    public function __construct($data = null, $next = null)
    {
        $this->data = $data;
        $this->next = $next;
    }

    public function setNext($node)
    {
        $this->next = $node;
        return $this;
    }

    public function getNext()
    {
        return $this->next;
    }

    public function getData()
    {
        return $this->data;
    }
}

// 链表反转
// ------------------------------------------------
$linkedListAlgo = new LinkedListAlgo();
$linkedListAlgo->insertTail(0)
    ->insertTail(1) // 插入数据
    ->insertTail(2)
    ->insertTail(3)
    ->insertTail(4)
    ->insertTail(5);

// 链表反转
$node = $linkedListAlgo->getNode();
$rs = $linkedListAlgo->reverse($node);

// 打印数据
echo sprintf("start>>----------------链表反转start--------------\n");
$linkedListAlgo->printAll($rs);
echo sprintf("end>>----------------链表反转end------------------\n");
// ------------------------------------------------

// 环形链表
// ------------------------------------------------

$linkedListAlgo = new LinkedListAlgo();
$linkedListAlgo->insertTail(0)
    ->insertTail(1) // 插入数据
    ->insertTail(2)
    ->insertTail(3)
    ->insertTail(4)
    ->insertTail(5);

$node = $linkedListAlgo->getNode();
// 环形链表
$linkedListAlgo->buildCircleLinkedList($node, 4);

$rs = $linkedListAlgo->checkCircleHash($linkedListAlgo->getNode());

echo sprintf("start>>----------------监测环形链表--------------\n");
var_dump($rs);
echo sprintf("end>>------------------监测环形链表--------------\n");

// ------------------------------------------------

// 合并两个有序链表
// -----------------------------------------------------------------------
$linkedListAlgo1 = new LinkedListAlgo();
$linkedListAlgo1->insertTail(1) // 插入数据
    ->insertTail(2)
    ->insertTail(4);

$list1 = $linkedListAlgo1->getNode();

$linkedListAlgo2 = new LinkedListAlgo();
$linkedListAlgo2->insertTail(1) // 插入数据
    ->insertTail(3)
    ->insertTail(4);

$list2 = $linkedListAlgo2->getNode();

$rs = $linkedListAlgo2->mergeLinkedListRecursion($list1, $list2);

echo sprintf("start>>----------------合并两个有序链表--------------\n");
$linkedListAlgo->printAll($rs);
echo sprintf("end>>------------------合并两个有序链表--------------\n");
// -----------------------------------------------------------------------

// 删除倒数第 n 个节点
// -----------------------------------------------------------------------
$linkedListAlgo1 = new LinkedListAlgo();
$linkedListAlgo1->insertTail(1); // 插入数据

$list1 = $linkedListAlgo1->getNode();
$rs = $linkedListAlgo1->delLastNth2($list1, 1);

echo sprintf("start>>----------------删除链表中倒数第n个节点--------------\n");
$linkedListAlgo->printAll($rs);
echo sprintf("end>>------------------删除链表中倒数第n个节点--------------\n");

// 查找链表的中间节点
// -----------------------------------------------------------------------
$linkedListAlgo1 = new LinkedListAlgo();
$linkedListAlgo1->insertTail(1)
    ->insertTail(2)
    ->insertTail(3)
    ->insertTail(4)
    ->insertTail(5);

$list1 = $linkedListAlgo1->getNode();
$rs = $linkedListAlgo1->getMiddleNode($list1);

echo sprintf("start>>----------------查找链表的中间节点--------------\n");
$linkedListAlgo->printAll($rs);
echo sprintf("end>>------------------查找链表的中间节点--------------\n");
