<?php
/**
 * 归并排序是一种分治的思想，先分解，在合并
 */
class MergeSrot
{

    public function mergeSort(&$nums)
    {
        $r = count($nums) - 1;
        $this->mergeSortInterally($nums, 0, $r);
    }

    protected function mergeSortInterally(&$nums, $l, $r)
    {
        // 终止条件
        if ($l >= $r) {
            return;
        }

        // 取p到r之间的中间位置q,防止（p+r）的和超过int类型最大值
        $p = $l + (int) (($r - $l) / 2);
        // 分治递归
        $this->mergeSortInterally($nums, $l, $p);
        $this->mergeSortInterally($nums, $p + 1, $r);

        // 将A[p...q]和A[q+1...r]合并为A[p...r]
        $this->merge($nums, $l, $p, $r);
    }

    protected function merge(&$nums, $l, $p, $r)
    {
        $i = $l;
        $j = $p + 1;
        // 合并
        $tmp = [];
        while ($i <= $p && $j <= $r) {
            if ($nums[$i] > $nums[$j]) {
                $tmp[] = $nums[$j];
                $j++;
            } else {
                $tmp[] = $nums[$i];
                $i++;
            }
        }

        // 如果右侧有数据
        if ($j <= $r) {
            $i = $j;
            $p = $r;
        }
        while ($i <= $p) {
            $tmp[] = $nums[$i];
            $i++;
        }

        // 将数据拷贝回去
        for ($i = 0; $i <= $r - $l; $i++) {
            $nums[$l + $i] = $tmp[$i];
        }
    }
}

$rs = new MergeSrot();
$nums = [11, 8, 3, 9, 7, 1, 2, 5];
$rs->mergeSort($nums);

print_r($nums);
