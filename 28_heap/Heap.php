<?php
/**
 * 如何理解堆
 *  1. 堆是一个完全二叉树，除了最后一层，其他节点都是满的，并且最后一层的节点都要靠左排列。
 *  2. 堆中的每一个节点的值都需要大于等于（或小于等于）其子树中每个节点的值
 *
 * 如何存储
 *  数组中下标为i 的子节点，其左子节点的下标为i*2，又子节点的下标为 i*2+1
 *  如果当前节点的下标为 i，那么其父子节点的下标就是 i/2
 *
 * 如何删除
 *  第一种方式：
 *      1. 从堆顶向下查找到最大的元素替换到堆顶
 *      2. 第二大的元素需要继续补全
 *      3. 处理完成之后，最后形成一个空洞
 *  第二种方式：
 *      1. 将数组中最后一个元素替换到堆顶
 *      2. 进行堆交换数据，类似插入操作
 *
 */
class Heap
{
    /**
     * 操作的数组
     *
     * @var array
     */
    private $arr = [];

    /**
     * 堆的容量
     *
     * @var [int]
     */
    private $capacity;

    /**
     * 当前堆的数量
     *
     * @var int
     */
    public $count = 0;

    public function __construct($capacity)
    {
        $this->capacity = $capacity;

        // 第0个节点占位
        $this->arr[] = null;
    }

    /**
     * 堆排序
     *  1. 每一次建堆操作之后，那么堆顶的元素一定是最大的
     *  2. 将堆顶的元素与堆末尾的元素进行交换，进行堆化
     *  3. 重复上面的操作
     *
     * @param [type] $arr
     *
     * @return void
     */
    public function sort(&$arr)
    {
        $count = count($arr) - 1;
        // 建堆
        $this->buildHeap($arr, $count);
        $k = $count;
        while ($k > 1) {
            $this->swap($arr, 1, $k);
            $k--;
            $this->heapify($arr, 1, $k);
        }
    }

    /**
     * 数据插入
     *
     * @param [int] $val
     *
     * @return void
     */
    public function insert($val)
    {
        if ($this->count >= $this->capacity) {
            // 堆满了
            return;
        }

        $this->arr[] = $val;

        $this->count++;

        // 当前要操作的节点
        $i = $this->count;
        // 父节点的 key
        $p = (int) ($i / 2);

        // 子节点的值比父节点大
        while ($p > 0 && $this->arr[$i] > $this->arr[$p]) {

            // 数据交换
            $this->swap($this->arr, $i, $p);

            // 继续比对上一级
            $i = $p;
            $p = (int) ($i / 2);
        }
    }

    // 删除堆中最大的元素
    public function removeMax()
    {
        // 堆中没有元素
        if ($this->count == 0) {
            return;
        }

        // 将最后一个元素替换到堆顶
        $this->arr[1] = $this->arr[$this->count];
        $this->arr[$this->count] = null;
        // 堆的长度
        $this->count--;
        $this->heapify($this->arr, 1);
    }

    /**
     * 堆化 从下到上
     *
     * @param [array] $arr
     *
     * @return void
     */
    public function buildHeap(&$arr, $count = null)
    {
        if ($count == null) {
            $count = count($arr) - 1;
        }

        // 重 i/2开始堆化
        $i = (int) ($count / 2);
        for ($i; $i >= 1; $i--) {
            $this->heapify($arr, $i, $count);
        }
    }

    /**
     * 处理堆
     *
     * @param [arr] $arr
     * @param [int] $index 堆化比较的索引
     * @param [int] $n     堆比较的长度
     *
     * @return void
     */
    public function heapify(&$arr, $index, $n = null)
    {
        if ($n == null) {
            $n = count($arr) - 1;
        }

        while (true) {
            // 大顶堆
            $maxPos = $index;

            // 如果当前的值比左子树小，那么标记左子树
            $l = $index * 2;
            if ($l <= $n && $arr[$index] < $arr[$l]) {
                $maxPos = $l;
            }

            // 如果左子树比又子树的值小，那么直接标记又子树，以免再一次替换
            $r = $index * 2 + 1;
            if ($r <= $n && $arr[$maxPos] < $arr[$r]) {
                $maxPos = $r;
            }

            // 没有数据交换
            if ($maxPos == $index) {
                break;
            }

            // 数据交换
            $this->swap($arr, $index, $maxPos);

            // 需要处理新的节点
            $index = $maxPos;
        }

    }

    /**
     * 分区交换
     *
     * @param [array] $arr
     * @param [int] $l
     * @param [int] $r
     *
     * @return void
     */
    private function swap(&$arr, $l, $r)
    {
        $tmp = $arr[$l];
        $arr[$l] = $arr[$r];
        $arr[$r] = $tmp;
    }
}

$rs = new Heap(10);
// $rs->insert(2);

// $rs->insert(7);
// $rs->insert(5);
// $rs->insert(6);
// $rs->insert(4);
// $rs->insert(1);

// 移出最大堆
// $rs->removeMax();

$arr = [null, 9, 6, 3, 1, 5];
$rs->sort($arr);
print_r($arr);
