<?php
class Prim {
    public function __construct() {
        $data = ["A", "B", "C", "D", "E", "F", "G"];
        $verxs = count($data);
        $weight = [
            [0, 5, 7, 0, 0, 0, 2],
            [5, 0, 0, 9, 0, 0, 3],
            [7, 0, 0, 0, 8, 0, 0],
            [0, 9, 0, 0, 0, 4, 0],
            [0, 0, 8, 0, 0, 5, 4],
            [0, 0, 0, 4, 5, 0, 6],
            [2, 3, 0, 0, 4, 6, 0]
        ];

        $graph = new MGraph($verxs);
        $minTree = new MinTree();
        $minTree->createGraph($graph, $verxs, $data, $weight);
        // 输出
        $minTree->showGraph($graph);

        // 测试普里姆方法
        $minTree->prim($graph, 0);
    }
}

class MinTree {
    public function createGraph($graph, $verxs, $data, $weight) {

        for($i=0; $i<$verxs; $i++) {
            $graph->data[$i] = $data[$i];
            for($j=0; $j<$verxs; $j++) {
                $graph->weight[$i][$j] = $weight[$i][$j];
            }
        }
    }

    public function showGraph($graph) {
        print_r($graph->weight);
    }

    public function prim($graph, $v) {

        $visited = array_fill(0, $graph->verxs, 0);

        // 把当前这个节点标记为已经访问
        $visited[$v] = 1;

        // 记录两个顶点的下标
        $h1 = -1;
        $h2 = -1;

        // 初始化一个大数，在后面的遍历过程中会被替换
        $minWeight = 10000;

        for($k=1; $k<$graph->verxs; $k++) {
            for($i=0; $i<$graph->verxs; $i++) {
                for($j=0; $j<$graph->verxs; $j++) {
                    if($visited[$i] == 1 && $visited[$j] == 0 && $graph->weight[$i][$j] > 0 && $graph->weight[$i][$j] < $minWeight) {
                        $minWeight = $graph->weight[$i][$j];
                        $h1 = $i;
                        $h2 = $j;
                    }
                }
            }
            // 找到一条边最小
            echo sprintf("边[%s + %s ] = %s", $graph->data[$h1], $graph->data[$h2], $minWeight) . "\n";
            // 讲当前这和节点标记为已经访问
            $visited[$h2] = 1;
            // 重置，标记为最大值
            $minWeight = 10000;
        }
    }

    public function prim2($graph, $v) {

        $visited = array_fill(0, $graph->verxs, 0);

        // 把当前这个节点标记为已经访问
        $visited[$v] = 1;

        // 记录两个顶点的下标
        $h1 = -1;
        $h2 = -1;

        // 初始化一个大数，在后面的遍历过程中会被替换
        $minWeight = 10000;

        for($k=1; $k<$graph->verxs; $k++) {
            for($i=0; $i<$graph->verxs; $i++) {
                for($j=0; $j<$graph->verxs; $j++) {
                    if($visited[$i] == 1 && $visited[$j] == 0 && $graph->weight[$i][$j] > 0 && $graph->weight[$i][$j] < $minWeight) {
                        $minWeight = $graph->weight[$i][$j];
                        $h1 = $i;
                        $h2 = $j;
                    }
                }
            }
            // 找到一条边最小
            echo sprintf("边[%s + %s ] = %s", $graph->data[$h1], $graph->data[$h2], $minWeight) . "\n";
            // 讲当前这和节点标记为已经访问
            $visited[$h2] = 1;
            // 重置，标记为最大值
            $minWeight = 10000;
        }
    }


}

class MGraph {
    public $verxs = 0;
    public $data = [];
    public $weight = [];

    public function __construct($verxs) {
        $this->verxs = $verxs;
        for ($i=0; $i<$verxs; $i++) {
            $this->weight[] = array_fill(0, $verxs, 0);
        }
    }
}


$rs = new Prim();