<?php

/**
 * 快速排序
 * 
 * 选中一个数当做比较点，将比比较点小的放左边，比比较点大的放右边。比较点放中间，不断的分解。直到不能再继续分解。
 */
class Sort
{
    /**
     * 排序
     */
    public function quickSort(&$nums)
    {
        $count = count($nums);
        $this->quickSortInterally($nums, 0, $count - 1);
    }

    /**
     * 递归分治
     */
    protected function quickSortInterally(&$nums, $l, $r)
    {
        // 终止条件 如果没有元素未处理的元素，停止递归
        if ($l >= $r) return;

        $border = $this->partition($nums, $l, $r);

        // 处理左侧
        $this->quickSortInterally($nums, $l, $border - 1);
        $this->quickSortInterally($nums, $border + 1, $r);
    }

    /**
     * 排序，处理临界点
     */
    protected function partition(&$nums, $l, $r)
    {
        // 对比值
        $pivot = $nums[$r];
        // 边界
        $border = $l;
        for ($i = $l; $i < $r; $i++) {
            // 比 pivot小，放左边
            if ($nums[$i] < $pivot) {
                // 如果边界值与操作$i相等，互换的效果是一样的，直接偏移
                if ($border != $i) {
                    $tmp = $nums[$i];
                    $nums[$i] = $nums[$border];
                    $nums[$border] = $tmp;
                }
                // 边界值向右便宜
                $border++;
            }
        }

        // 将对比值放中间
        $tmp = $nums[$border];
        $nums[$border] = $nums[$i];
        $nums[$i] = $tmp;

        // 返回临界点
        return $border;
    }
}

$rs = new Sort();
$nums = [6, 11, 3, 9, 8];
$rs->quickSort($nums);

print_r($nums);
