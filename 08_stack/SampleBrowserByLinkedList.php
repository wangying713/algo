<?php

/**
 * 如何实现浏览器的前进、后退功能？
 * 其实，用两个栈就可以非常完美地解决这个问题。
 * 我们使用两个栈，X 和 Y，我们把首次浏览的页面依次压入栈 X，当点击后退按钮时，再依次从栈 X 中出栈，
 * 并将出栈的数据依次放入栈 Y。当我们点击前进按钮时，我们依次从栈 Y 中取出数据，放入栈 X 中。当栈 X 中没有数据时，那就说明没有页面可以继续后退浏览了。
 * 当栈 Y 中没有数据，那就说明没有页面可以点击前进按钮浏览了。
 */

/**
 * 基于链表实现
 *
 * Class Brower
 */
class Brower
{

    /**
     * 后退栈
     *
     * @var Stack
     */
    public $backStack;

    /**
     * 前进栈
     *
     * @var Stack
     */
    public $forwardStack;

    public function __construct()
    {
        $this->backStack = new Stack();
        $this->forwardStack = new Stack();
    }

    /**
     * 打开
     *
     * @param $url
     */
    public function open($url)
    {
        $this->backStack->push($url);
    }

    /**
     * 前进
     */
    public function forward()
    {
        // 压栈
        $popVal = $this->forwardStack->pop();
        if ($popVal != null) {
            // 入栈
            $this->backStack->push($popVal);
        }
    }

    /**
     * 后退
     */
    public function goBack()
    {
        // 压栈
        $popVal = $this->backStack->pop();
        if ($popVal != null) {
            // 入栈
            $this->forwardStack->push($popVal);
        }
    }

    /**
     * 能否前进
     *
     * @return bool
     */
    public function canForward()
    {
        return $this->forwardStack->getSize() > 0 ? true : false;
    }

    /**
     * 能否后退
     *
     * @return bool
     */
    public function canBack()
    {
        return $this->backStack->getSize() > 0 ? true : false;
    }

    /**
     * 清空
     */
    public function clear()
    {
        $this->backStack->clear();
        $this->forwardStack->clear();
    }
}

/**
 * 链表
 *
 * Class Node
 */
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

class Stack
{

    private $stack;
    private $size = 0;

    public function __construct()
    {
        // 哨兵 简化代码复杂度
        $this->stack =  new Node();
    }

    /**
     * 压栈
     *
     * @return val|null
     */
    public function pop()
    {
        if ($this->stack->next == null) {
            echo "stack is empty! \n";
            return null;
        }

        if ($this->size > 0) {
            $this->size--;
        }

        $val = $this->stack->val;
        $this->stack = $this->stack->next;
        return $val;
    }

    /**
     * 入栈
     *
     * @param $data
     * @return $this
     */
    public function push($data)
    {
        $node = new Node($data);
        $node->next = $this->stack;
        $this->stack = $node;
        $this->size++;
        return $this;
    }

    /**
     * 清空栈
     */
    public function clear()
    {
        $this->stack = new Node();
    }

    /**
     * 获得栈
     *
     * @return Node
     */
    public function getStack()
    {
        return $this->stack;
    }

    /**
     * 获得栈大小
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }
}

$brower = new Brower();
$brower->open("https://www.baidu.com");
$brower->open("https://www.google.com");
$brower->open("https://www.qq.com");

$brower->goBack();
$brower->forward();

$brower->clear();
print_r($brower);
