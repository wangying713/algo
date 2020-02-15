<?php
/**
 * 基于数组实现队列
 */
class QueueByArray {

    /**
     * 头指针
     *
     * @var int
     */
    protected $head;

    /**
     * 尾指针
     *
     * @var int
     */
    protected $tail;

    /**
     * 队列
     *
     * @var array
     */
    protected $queue;

    /**
     * 队列最大的存储个数
     *
     * @var int
     */
    protected $maxNum = 5;

    public function __construct()
    {
        $this->head = 0;
        $this->tail = 0;
        $this->items = [];
    }

    public function enqueue($val)
    {
        if ($this->tail >= $this->maxNum) {
            if (($this->tail + 1) % $this->maxNum == $this->head) {
                echo "队列已满\n";
                return NULL;
            }
        }

        $this->items[$this->tail] = $val;
        $key = ($this->tail + 1) % $this->maxNum;
        $this->tail = $key;
    }

    public function dequeue()
    {
        if ($this->head == $this->tail) return null;
        $ret = $this->items[$this->head];

        $this->head = ($this->head+1) % $this->maxNum;

        return $ret;
    }
}

$queue = new QueueByArray();
$queue->enqueue(1);
$queue->enqueue(2);
$queue->enqueue(3);
$queue->enqueue(4);
$queue->enqueue(5);
$queue->dequeue();
$queue->dequeue();
$queue->enqueue(6);
$queue->enqueue(7);
$queue->enqueue(8);

print_r($queue);