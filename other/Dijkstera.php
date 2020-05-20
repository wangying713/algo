<?php
class Dijkstra {

    public static function factory() {

        $vertex = ["A", "B", "C", "D", "E", "F", "G"];

        // 邻接矩阵
        $matrix = [];
        // 不可链接
        define("N", 65535);
        $matrix[0] = [N,5,7,N,N,N,2];  
        $matrix[1] = [5,N,N,9,N,N,3];  
        $matrix[2] = [7,N,N,N,8,N,N];  
        $matrix[3] = [N,9,N,N,N,4,N];  
        $matrix[4] = [N,N,8,N,N,5,4];  
        $matrix[5] = [N,N,N,4,5,N,6];  
        $matrix[6] = [2,3,N,N,4,6,N];


        $map = [
           //A B C D E F G
            [N,5,7,N,N,N,2], // A
            [5,N,N,9,N,N,3], // B
            [7,N,N,N,8,N,N], // C 
            [N,9,N,N,N,4,N], // D 
            [N,N,8,N,N,5,4], // E 
            [N,N,N,4,5,N,6], // F
            [2,3,N,N,4,6,N]  // G
        ];
        



        $graph = new Graph($vertex, $matrix);

        $graph->dijkstra(2);

        $graph->showDijkstra();

    }
}

class Graph {

    /**
     * 顶点数组
     *
     * @var array
     */
    private $vertex = [];

    /**
     * 邻接矩阵
     *
     * @var array
     */
    private $matrix = [];

    /**
     * 已经访问的顶点集合
     *
     * @var array
     */
    private $vv = [];

    public function Graph($vertex, $matrix) {
        $this->vertex = $vertex;
        $this->matrix = $matrix;
    }

    public function dijkstra($index) {

        $this->vv = new VisitedVertex(count($this->vertex), $index);
        $this->update($index);

        for($j = 1; $j < count($this->vertex); $j++) {
            $index = $this->vv->updateArr();

            echo "--------" . $index . "------\n";

            $this->update($index);
        } 
    }

    private function update($index) {

        // print_r($this->vv->dis);
        // print_r($this->vv->alreadyArr);

        // print_r($this->vv->preVisited);
        // // print_r($index);


        // die;
        $len = 0;
        // $matrix[2] = [7,N,N,N,8,N,N];  
        for($j = 0; $j < count($this->matrix[$index]); $j++) {
            $len = $this->vv->getDis($index) + $this->matrix[$index][$j];

           
            // die;
            if(!$this->vv->in($j) && $len < $this->vv->getDis($j)) {
                echo sprintf("getdis=%s, +this=%s\n", $this->vv->getDis($index), $this->matrix[$index][$j]);
                echo sprintf("len=%s, ", $len);
                echo 111;
                $this->vv->updatePre($j, $index);
                $this->vv->updateDis($j, $len);
            }



            
        }
    }

    public function showDijkstra() {
		$this->vv->show();
	}
}


class VisitedVertex {

    /**
     * 记录各个顶点是否访问过，1访问过，0未被访问，会动态更新
     *
     * @var array
     */
    public $alreadyArr = [];

    /**
     * 每个下标对应值为前一个顶点的下标
     *
     * @var array
     */
    public $preVisited = [];

    /**
     * 记录顶点到其他所有顶点的距离，比如 G 为出发顶点，就会记录 G 到其他顶点的距离，
     * 会动态更新, 求最短距离就会放入 dis 中
     *
     * @var array
     */
    public $dis = [];

    public function __construct($length, $index) {

        $this->alreadyArr = array_fill(0, $length, 0);
        $this->preVisited = array_fill(0, $length, 0);
        $this->dis = array_fill(0, $length, 65535);

        // 标记顶点被访问过
        $this->alreadyArr[$index] = 1;

        $this->dis[$index] = 0;
    }

    public function in($index) {
        return $this->alreadyArr[$index] == 1;
    }

    public function updateDis($index, $len) {
        $this->dis[$index] = $len;
    }

    public function updatePre($pre, $index) {
        $this->preVisited[$pre] = $index;
    }

    public function getDis($index) {
        return $this->dis[$index];
    }

    public function updateArr() {
        $min = 65535;
        $index = 0;
		for($i = 0; $i < count($this->alreadyArr); $i++) {
			if($this->alreadyArr[$i] == 0 && $this->dis[$i] < $min ) {
				$min = $this->dis[$i];
				$index = $i;
			}
		}
		$this->alreadyArr[$index] = 1;
		return $index;
    }


    public function show() {
		
		echo ("==========================\n");
        foreach($this->alreadyArr as $key=>$val) {
            echo $val . " ";
        }

		echo ("\n");
        foreach($this->preVisited as $key=>$val) {
            echo $val . " ";
        }
        
        echo ("\n");
        foreach($this->dis as $key=>$val) {
            echo $val . " ";
        }
	
		echo ("\n");
		$vertex = ['A', 'B', 'C', 'D', 'E', 'F', 'G' ];
        $count = 0;

        // print_r($this->dis);

        // die;

		foreach ($this->dis as $i=>$val) {
			if ($i != 65535) {
				echo ($vertex[$count] . "(" . $val. ") ");
			} else {
				echo ("N ");
			}
			$count++;
        }
        echo ("\n");

		
    }
    
}

Dijkstra::factory();