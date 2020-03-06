<?php
/**
 * BFS (Breadth-Fist-Search) 广度优先策略
 *  1. BFS 需要借助队列，先进先出，后进后出的特性
 *  2. 先把要查找开始位置的元素放入队列
 *  3. 从队列中获得元素。查找临近元素，并放入队列
 *  3. 继续上述操作，直到队列为空
 *
 * 复杂度分析：
 *  时间复杂度：
 *      我们用V 表示顶点的个数，E 表示边的个数
 *      最坏的情况是每个顶点(V)和每个边(E)都会被访问到 复杂度就是 O(V+E)
 *      又因为对于一个连通图来说，也就是说一个图中的所有顶点都是连通的，E 肯定要大于等于 V-1，所以，广度优先搜索的时间复杂度也可以简写为 O(E)。
 *  空间复杂度：
 *      广度优先搜索的空间消耗主要在几个辅助变量 visited 数组、queue 队列、prev 数组上。
 *      这三个存储空间的大小都不会超过顶点的个数，所以空间复杂度是 O(V)。
 *
 * DFS (Depth-First-Search) 深度优先策略
 *  1. 深度优先策略需要用到栈，我们可以直接使用递归，因为递归就是栈的特性，后进先出
 *  2. 也需要像 BFS 一样，标记访问记录与访问轨迹
 *  3. 终止条件 无法继续找到下一个节点，返回
 *  4. a 问 b 和 c，你们能存储了 x 吗？a 去找 a 相邻的节点，b 去找 b 相邻的节点，依次类推
 *
 * 复杂度分析：
 *  时间复杂度：
 *      每条边最多会被访问两次，一次是遍历，一次是回退。所以，图上的深度优先搜索算法的时间复杂度是 O(E)，E 表示边的个数。
 *  空间复杂度分析：
 *      深度优先搜索算法的消耗内存主要是 visited、prev 数组和递归调用栈。visited、prev 数组的大小跟顶点的个数 V 成正比，递归调用栈的最大深度不会超过顶点的个数，所以总的空间复杂度就是 O(V)。
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
