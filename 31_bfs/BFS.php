<?php
/**
 * adj
 */
class Graph
{
    /**
     * 图的长度
     *
     * @var int
     */
    private $v = 0;

    /**
     * 图数据
     *
     * @var array
     */
    private $adj = [];

    private $dfsFound = false;

    public function __construct($v)
    {
        $this->v = $v;

        // 生成空链表 邻接表
        for ($i = 0; $i < $v; $i++) {
            $this->adj[$i] = new SplDoublyLinkedList();
        }
    }

    /**
     * 临链表，向矩阵中添加数据
     *
     * @param [int] $s
     * @param [int] $t
     *
     * @return void
     */
    public function addEdge($s, $t)
    {
        $this->adj[$s]->push($t);
        $this->adj[$t]->push($s);
    }

    /**
     * 广度优先搜索最短路径
     *
     * @param [int] $s
     * @param [int] $t
     *
     * @return void
     */
    public function bfs($s, $t)
    {
        $queue = new SplQueue();
        $queue->push($s);

        // 标记是否被访问过
        $visited = [
            $s => true,
        ];

        // 标记访问轨迹，没有记录为-1
        $prev = [];
        for ($i = 0; $i < $this->v; $i++) {
            $prev[$i] = -1;
        }

        // 从队列中读取数据对比
        while ($queue->count() > 0) {
            $w = $queue->shift();
            foreach ($this->adj[$w] as $key => $val) {
                if (!isset($visited[$val])) {
                    // 标记访问轨迹，被 w 来源的数据访问
                    $prev[$val] = $w;

                    // 找到了就不需要入队了
                    if ($val == $t) {

                        $this->print($prev, $s, $t);
                        return;
                    }
                    // 标记被访问过
                    $visited[$key] = true;

                    // 新的数据入队
                    $queue->push($val);
                }
            }
        }
    }

    /**
     * 深度优先策略
     *
     * @param [int] $s
     * @param [int] $t
     *
     * @return void
     */
    public function dfs($s, $t)
    {
        $this->dfsFound = false;

        // 访问记录
        $visited = [];
        // 访问轨迹
        $prev = [];
        for ($i = 0; $i < $this->v; $i++) {
            $prev[$i] = -1;
        }

        $this->recurDfs($s, $t, $visited, $prev);
        $this->print($prev, $s, $t);

    }

    /**
     * 递归回硕查找
     *
     * @param [int] $w
     * @param [int] $t
     * @param [array] $visited
     * @param [array] $prev
     *
     * @return void
     */
    private function recurDfs($w, $t, $visited, &$prev)
    {
        // 终止条件
        if ($this->dfsFound == true) {
            return;
        }

        // 标记顶点被访问过
        $visited[$w] = true;

        if ($w == $t) {
            // 找到了
            $this->dfsFound = true;
            return;
        }

        // 循环每个顶点处理
        foreach ($this->adj[$w] as $key => $val) {
            if (!isset($visited[$val])) {
                // 标记访问轨迹
                $prev[$val] = $w;
                // 递归深度查找
                $this->recurDfs($val, $t, $visited, $prev);
            }
        }
    }

    /**
     * 打印访问记录
     *
     * @param [int] $prev
     * @param [int] $s
     * @param [int] $t
     *
     * @return void
     */
    function print($prev, $s, $t) {

        // 终止条件
        if ($prev[$t] != -1) {
            $this->print($prev, $s, $prev[$t]);
        }

        // 利用递归的特性，先进后出倒序打印
        echo $t . " ";
    }
}

$rs = new Graph(13);
$rs->addEdge(1, 2);
$rs->addEdge(1, 4);
$rs->addEdge(2, 1);
$rs->addEdge(2, 3);
$rs->addEdge(3, 2);
$rs->addEdge(3, 6);
$rs->addEdge(6, 5);
$rs->addEdge(6, 8);
$rs->addEdge(4, 1);
$rs->addEdge(4, 5);
$rs->addEdge(5, 2);
$rs->addEdge(5, 6);
$rs->addEdge(5, 7);

$rs->dfs(1, 6);
