<?php
class QuickSort {

    public static function sort(&$arr) {
        $r = count($arr) - 1;
        static::recursion($arr, 0, $r);
    }

    public static function recursion(&$arr, $l, $r) {

        // 递归终止条件
        if ($l >= $r) {
            return ;
        }

        // 先治理，再分区
        $border = static::partition($arr, $l, $r);
        static::recursion($arr, $l, $border - 1);
        static::recursion($arr, $border + 1, $r);
    }

    public static function partition(&$arr, $l, $r) {

        $povit = $arr[$r];
        $border = $l;

        for ($i = $l; $i<$r; $i++) {
            if ($arr[$i] < $povit) {
                if ($border != $i) {
                    // 将比 povit 小得值放到左边
                    $tmp = $arr[$i];
                    $arr[$i] = $arr[$border]; 
                    $arr[$border] = $tmp;
                }

                // 指针偏移
                $border ++;
            }
        }

        // 将 povit 放到中间，border 放到最后
        $tmp = $arr[$r];
        $arr[$r] = $arr[$border];
        $arr[$border] = $tmp;

        return $border;
    }


}

$nums = [6, 11, 3, 9, 8];
QuickSort::sort($nums);

print_r($nums);