<?php
/**
 * 堆排序
 *  堆是利用数组实现的
 *  堆排序其实是围绕着建堆完成的，当组数据建堆完成，利用堆的特性，将大顶堆放入元素的末尾，实现排序
 *
 * 时间复杂度
 *
 * 空间复杂度
 */
class HeapSort
{

    public function sort(&$arr)
    {
        $count = count($arr) - 1;
        // 1 堆化
        $this->buildHeap($arr, $count);

        // 将大顶堆与末尾元素交换位置
        $k = $count;
        while ($k > 1) {
            $this->swap($arr, 1, $k);
            $k--;
            $this->heapify($arr, 1, $k);
        }
    }

    /**
     * 建堆
     *
     * @param [array] $arr
     * @param [int] $count
     *
     * @return void
     */
    public function buildHeap(&$arr, $count = null)
    {
        if ($count == null) {
            $count = count($arr) - 1;
        }

        // 叶子节点不需要处理，在父节点开始处理 count/2
        $i = (int) ($count / 2);

        for (; $i >= 1; $i--) {
            $this->heapify($arr, $i, $count);
        }
    }

    /**
     * 堆化
     *
     * @param [array] $arr
     * @param [int] $index
     * @param [int] $count
     *
     * @return void
     */
    private function heapify(&$arr, $index, $count)
    {
        while (true) {
            // 大顶堆
            $maxpos = $index;

            // 如果左子节点比节点大，那么将最子节点标记为大顶堆
            $l = $index * 2;
            if ($l <= $count && $arr[$index] < $arr[$l]) {
                $maxpos = $l;
            }

            $r = $l + 1;
            if ($r <= $count && $arr[$maxpos] < $arr[$r]) {
                $maxpos = $r;
            }

            if ($index == $maxpos) {
                break;
            }

            // 数据交换
            $this->swap($arr, $index, $maxpos);

            $index = $maxpos;
        }
    }

    /**
     * 交换
     *
     * @param [array] $arr
     * @param [int] $index1
     * @param [int] $index2
     *
     * @return void
     */
    private function swap(&$arr, $index1, $index2)
    {
        $tmp = $arr[$index1];
        $arr[$index1] = $arr[$index2];
        $arr[$index2] = $tmp;
    }

}

$arr = [null, 7, 5, 19, 8, 4, 1, 20, 13, 16];

$rs = new HeapSort();
$rs->sort($arr);

print_r($arr);
