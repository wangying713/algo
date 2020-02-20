<?php

/**
 * 基于链表实现队列
 */
class QueueByLinkedList
{

    protected $tail;

    public function __construct()
    {
        $linkedList = new SplDoublyLinkedList();
        $this->tail = $linkedList;
    }

    public function enqueue($val)
    {
        $this->tail->push($val);
    }

    public function dequeue()
    {
        return $this->tail->shift();
    }
}

class Node
{
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
