<?php
/**
 * 基于链表实现队列
 */
class QueueByLinkedList {

    protected $head;
    protected $tail;

    public function __construct()
    {
    }

    public function enqueue($val)
    {
        if ($this->tail == null) {
            $linkedList = new Node($val, null);
            $this->head = $linkedList;
            $this->tail = $linkedList;
        } else {
            $this->tail->next = new Node($val, null);
            $this->tail = $this->tail->next;
        }
    }

    public function dequeue()
    {
        if ($this->head == null) return null;
        $val = $this->head->val;
        $this->head = $this->head->next;
        if ($this->head == null) {
            $this->tail = $this->head;
        }

        return $val;
    }
}

class Node {
    public $val;
    public $next;
    public function __construct($val = null, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }
}

$rs = new QueueByLinkedList();
$rs->enqueue(1);
$rs->enqueue(2);
$rs->enqueue(3);
$rs->enqueue(4);
$rs->enqueue(5);

var_dump($rs->dequeue());
var_dump($rs->dequeue());
var_dump($rs->dequeue());
var_dump($rs->dequeue());

//print_r($rs);
