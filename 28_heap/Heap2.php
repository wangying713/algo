<?php
/**
 * 如何理解堆
 *  1. 堆是一个完全二叉树，除了最后一层，其他节点都是满的，并且最后一层的节点都要靠左排列。
 *  2. 堆中的每一个节点的值都需要大于等于（或小于等于）其子树中每个节点的值
 *
 * 如何存储
 *  数组中下标为i 的子节点，其左子节点的下标为i*2，又子节点的下标为 i*2+1
 *  如果当前节点的下标为 i，那么其父子节点的下标就是 i/2
 *
 * 如何删除
 *  第一种方式：
 *      1. 从堆顶向下查找到最大的元素替换到堆顶
 *      2. 第二大的元素需要继续补全
 *      3. 处理完成之后，最后形成一个空洞
 *  第二种方式：
 *      1. 将数组中最后一个元素替换到堆顶
 *      2. 进行堆交换数据，类似插入操作
 *
 */
class Heap
{
    /**
     * 操作的数组
     *
     * @var array
     */
    private $arr = [];

    /**
     * 堆的容量
     *
     * @var [int]
     */
    private $capacity;

    /**
     * 当前堆的数量
     *
     * @var int
     */
    public $count = 0;

    public function __construct($capacity)
    {

	}


	public function buildHeap(&$arr) {
		// 1. 获取最后一个非叶子节点，为开始上浮的节点
		// 2. 上浮到0的节点位置（根节点结束）
		// 3. 下沉操作
		$len = count($arr);
		$index = (int) ($len - 1); 
		for ($i=$index; $i>=0; $i--) {
			$this->sink($arr, $i, $len);
		}
	}

	// 下沉操作
	public function sink(&$arr, $index, $len) {
		while(true) {
			$maxPos = $index;
			// 左侧子节点的位置
			$l = $index * 2 + 1;
			
			if ($l < $len && $arr[$index] < $arr[$l]) {
				// 标记大顶堆
				$maxPos = $l;
			}

			// 右侧子节点的位置
			$r = $index * 2 + 2;

			if ($r < $len && $arr[$maxPos] < $arr[$r]) {
				// 标记新的大顶堆
				$maxPos = $r;
			}


			// 如果没有标记，跳出循环
			if ($maxPos == $index) {
				break;
			}

			// 交换
			$this->swap($arr, $maxPos, $index);
			$index = $maxPos;
		}
	}

	// 向堆中插入元素（上浮）
	// 时间复杂度：O(logn)
	public function insertToHeap(&$arr, $val) {
		// 先插入到数组末尾
		$arr[] = $val;
		$len = count($arr);

		// 新增元素的节点索引
		$childIndex = $len - 1;
		// 父级节点的索引
		$p = (int) ($childIndex / 2);
		while ($p >= 0 && $arr[$p] < $arr[$childIndex]) {
			// 父节点
			$this->swap($arr, $p, $childIndex);
			$childIndex = $p;
			$p = (int) ($childIndex / 2);
		}
	}

	// 堆的删除
	public function delete(&$arr) {
		$len = count($arr);
		// 将堆顶的元素替换为最后一个元素
		$arr[0] = $arr[$len-1];

		// 下沉
		$this->sink($arr, 0, $len);
	}

	// 元素交换
	public function swap(&$arr, $index1, $index2) {
		$tmp = $arr[$index1];
		$arr[$index1] = $arr[$index2];
		$arr[$index2] = $tmp;
	}

	public function sort(&$arr) {
		$len = count($arr);

		$k = $len;
        while ($k >= 1) {
			$this->swap($arr, 0, $k-1);

			//  下沉
			$k--;
			$this->sink($arr, 0, $k);
		}
	}
}

$rs = new Heap(10);
// $rs->insert(2);

// $rs->insert(7);
// $rs->insert(5);
// $rs->insert(6);
// $rs->insert(4);
// $rs->insert(1);

// 移出最大堆
// $rs->removeMax();

$arr = [null, 9, 6, 3, 1, 5];
$arr = [1, 2, 8, 4, 5];

$rs->buildHeap($arr);

// $rs->insertToHeap($arr, 11);
// $rs->delete($arr);

$rs->sort($arr);
print_r($arr);
