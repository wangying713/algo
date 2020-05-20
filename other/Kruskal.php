<?php
class Kruskal {

    /**
     * 边的个数
     *
     * @var integer
     */
    private $edgeNum = 0;

    /**
     * 顶点的数组
     *
     * @var array
     */
    private $vertexs = [];

    /**
     * 邻接矩阵
     *
     * @var array
     */
    private $matrix = [];    

    public static function factory(){
        //           0    1    2    3    4    5    6
        $vertexs = ["A", "B", "C", "D", "E", "F", "G"];
        $matrix = [
            //A   B   C   D   E   F    G
            [0,  12, -1, -1, -1, 16,  14], // A
            [12,  0, 10, -1, -1,  7,  -1], // B
            [-1, 10,  0,  3,  5,  6,  -1], // C
            [-1, -1,  3,  0,  4, -1,  -1], // D
            [-1, -1,  5,  4,  0,  2,   8], // E
            [16,  7,  6, -1,  2,  0,   9], // F
            [14, -1, -1, -1,  8,  9,   0]  // G
        ];

        $rs = new Kruskal($vertexs, $matrix);
    }

    public function __construct($vertexs, $matrix) {
        $vlen = count($vertexs);
        $this->vertexs = $vertexs;
        $this->matrix = $matrix;

        // 统计边的条数
        for ($i=0; $i<$vlen; $i++) {
            for($j=$i+1; $j<$vlen; $j++) {
                if ($this->matrix[$i][$j] != -1) {
                    $this->edgeNum++;
                }
            }
        }

        $this->kruskal1();
    }

    public function kruskal1() {
        $index = 0;
        $ends = array_fill(0, $this->edgeNum, 0);

        $rets = [];
        $edges = $this->getEdges();

        $sort = [];
        foreach($edges as $val) {
            $sort[] = $val->weight;
        }
        array_multisort($sort, SORT_ASC, $edges);


        for($i=0; $i<$this->edgeNum; $i++) {

            $p1 = $this->getPosition($edges[$i]->start);
            $p2 = $this->getPosition($edges[$i]->end);

            $m = $this->getEnd($ends, $p1);
            $n = $this->getEnd($ends, $p2);

            if ($m != $n) {
                $ends[$m] = $n;
                $rets[$index++] = $edges[$i];
            }
        }

        foreach($rets as $val) {
            echo sprintf("%s->%s=%s ", $val->start, $val->end, $val->weight);
        }

        echo "\n";
    }

    public function getEdges() {
        $index = 0;
        $edges = [];
        for($i = 0; $i < count($this->vertexs); $i++) {
            for($j=$i+1; $j < count($this->vertexs); $j++) {
                if($this->matrix[$i][$j] != -1) {
                    $edges[$index++] = new edata($this->vertexs[$i], $this->vertexs[$j], $this->matrix[$i][$j]);
                }
            }
        }
        return $edges;
    }

    public function getPosition($ch) {

        for($i=0; $i<count($this->vertexs); $i++) {
            if ($ch == $this->vertexs[$i]) {
                return $i;
            }
        }
        return -1;
    }

    public function getEnd($ends, $i) {
        while($ends[$i] != 0) {
            $i = $ends[$i];
        }
        return $i;
    }
}

class edata {

    public $start;
    public $end;
    public $weight;

    public function __construct($start, $end, $weight) {
        $this->start = $start;
        $this->end = $end;
        $this->weight = $weight;
    }

    public function toString() {
		return "EData [<" + $this->start + ", " + $this->end + ">= " + $this->weight + "]";
    }

}

$rs = Kruskal::factory();