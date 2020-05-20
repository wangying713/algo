<?php
class HeapSort {

    public function sort(&$arr) {

        $len = count($arr);
        $this->buildHeap($arr, $len);

        for($i=$len-1; $i > 0; $i--) {
            $this->swap($arr, 0, $i);
            $this->sink($arr, 0, $i);

        }

        print_r($arr);
    }

    public function insert() {

    }

    public function delete() {

    }

    public function buildHeap(&$arr, $len) {

        $mid = (int) ($len / 2);

        for ($i = $mid; $i >= 0; $i--) {
            $this->sink($arr, $i, $len);
        }
    }

    public function sink(&$arr, $index, $len) {
        while(true) {
            
            $l = $index * 2 + 1;
            $r = $index * 2 + 2;

            $pos = $index;

            // 比左子树小，标记左子树
            if ($l < $len && $arr[$pos] < $arr[$l]) {
                $pos = $l;
            }

            // 标记右子树
            if ($r < $len && $arr[$pos] < $arr[$r]) {
                $pos = $r;
            }

            // 下沉完成
            if ($pos == $index) {
                break;
            }

            // 下沉操作
            $this->swap($arr, $index, $pos);
            
            $index = $pos;
        }
    }

    public function swim() {

    }

    public function swap(&$arr, $l, $r) {
        $tmp = $arr[$l];
        $arr[$l] = $arr[$r];
        $arr[$r] = $tmp;
    }
}


$arr = [null, 9, 6, 3, 1, 5];
$arr = [1, 2, 3, 4, 5];

$rs = new HeapSort(); 
// $rs->buildHeap($arr);
$rs->sort($arr);
print_r($arr);