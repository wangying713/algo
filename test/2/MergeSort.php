<?php
class MergeSort{

    public function sort(&$arr) {
        $r = count($arr) - 1;
        $this->sortRecursion($arr, 0, $r);
    } 

    public function sortRecursion(&$arr, $l, $r) {

        // 递归终止条件
        if ($l >= $r) {
            return ;
        }

        $mid = $l + (int) (($r - $l) / 2);
        
        $this->sortRecursion($arr, $l, $mid);
        $this->sortRecursion($arr, $mid+1, $r);

        $this->merge($arr, $l, $mid, $r);
    }   

    public function merge(&$arr, $l, $mid, $r) {

        $i = $l;
        $j = $mid + 1;

        $tmp = [];
        while($i <= $mid && $j <= $r) {
            if ($arr[$i] < $arr[$j]) {
                $tmp[] = $arr[$i];
                $i++;
            } else {
                $tmp[] = $arr[$j];
                $j++;
            }
        }

        if ( $j <= $r ) {
            $i = $j;
            $mid = $r;
        }
        // 还有剩余不分
        while( $i<=$mid ) {
            $tmp[] = $arr[$i];
            $i++;
        }

        foreach($tmp as $key => $val) {
            // key 加上 l
            $arr[$key+$l] = $val;
        }

        echo sprintf("l=%s, mid=%s, r=%s\n", $l, $mid, $r);
    }
}

$m = new MergeSort();
$arr = [5, 4, 3, 2, 1, 7];
$m->sort($arr);

print_r($arr);