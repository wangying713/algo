<?php
/**
在未排序的数组中找到第 k 个最大的元素。请注意，你需要找的是数组排序后的第 k 个最大的元素，而不是第 k 个不同的元素。
示例 1:

输入: [3,2,1,5,6,4] 和 k = 2
输出: 5
示例 2:

输入: [3,2,3,1,2,4,5,5,6] 和 k = 4
输出: 4
说明:

你可以假设 k 总是有效的，且 1 ≤ k ≤ 数组的长度。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/kth-largest-element-in-an-array
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

/**
 * 思路
 *  1. 第k大，一定就是第 target=n-k小
 *  2. 利用快速排序的思想，选一个pivot(枢纽值)。比pivot 小的在左侧，大的在右侧
 *  2. 经过一次处理，第 n 小的位置index，一定在应该出现的位置（例如第5小，key 一定等于4） 返回 index
 *  3. 这样比对 target 与 2中index 比较，如果相等，证明刚好是要查找的值，否则在左侧或者右侧继续查找
 *
 * 复杂度分析
 *  因为每次只需要遍历另一半例如：n, n/2 n/4 n/8 ... 1 因此，在最坏的情况下需要 n/2+n/4+n/8 ... +1次一定会找到
 *  根据等比数列求和公式 sn = a1(1-qn)/1-q 其实就约等于 n -1 了
 *  因此最坏 O(n)
 *
 */
class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    public function findKthLargest($nums, $k)
    {
        $n = count($nums);
        $l = 0;
        $r = $n - 1;

        // 第 n 大就是第 n-k 小
        $target = $n - $k;
        while (true) {
            $index = $this->partition($nums, $l, $r);
            if ($index == $target) {
                return $nums[$index];
            } else if ($target > $index) {
                $l = $index + 1;
            } else {
                $r = $index - 1;
            }
        }
    }

    /**
     * 分治
     *
     * @param array $nums
     * @param [ int] $l
     * @param [ int] $r
     *
     * @return void
     */
    public function partition(array &$nums, $l, $r)
    {
        $rand = rand($l, $r);
        // 交换位置
        $tmp = $nums[$r];
        $nums[$r] = $nums[$rand];
        $nums[$rand] = $tmp;

        $pivot = $nums[$r];
        $border = $l;
        for ($i = $l; $i < $r; $i++) {
            if ($nums[$i] < $pivot) {
                // 相同就不比交换，只有边界与处理的值不是一个位置菜交换
                if ($border != $i) {
                    $this->swap($nums, $i, $border);
                }
                $border++;
            }
        }

        // 将 povit 放到中间
        $tmp = $nums[$border];
        $nums[$border] = $nums[$r];
        $nums[$r] = $tmp;

        return $border;
    }

    public function swap(array &$nums, $index1, $index2)
    {
        $tmp = $nums[$index1];
        $nums[$index1] = $nums[$index2];
        $nums[$index2] = $tmp;
    }
}

$rs = new Solution();
$nums = [3, 2, 1, 5, 6, 4];
$val = $rs->findKthLargest($nums, 2);
var_dump($val);
