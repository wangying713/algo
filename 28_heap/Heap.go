package main

import "fmt"

type Heap struct {
	Val   []int
	Cap   int
	Count int
}

// 工厂实例化
func Factory(capacity int) *Heap {
	var heap *Heap = &Heap{
		Val:   make([]int, capacity),
		Cap:   capacity,
		Count: 0,
	}
	return heap
}

func (heap *Heap) BuildHeap(slice []int) {

	// 找到第一个非叶子节点 len/2
	// p = len(slice) / 2
	// for i = p; i >= 0; i-- {
	// public function buildHeap(&$arr) {
	//     // 1. 获取最后一个非叶子节点，为开始上浮的节点
	//     // 2. 上浮到0的节点位置（根节点结束）
	//     // 3. 下沉操作
	//     $len = count($arr);
	//     $index = (int) ($len - 1);
	//     for ($i=$index; $i>=0; $i--) {
	//         $this->sink($arr, $i, $len);
	//     }
	// }
	// }
}

// 插入数据
func (heap *Heap) Insert(val int) {
	// 特判
	if heap.Count == heap.Cap {
		return
	}
	heap.Val[heap.Count] = val
	// 将新数据插入到最后一个位置，然后上浮处理
	heap.swim(heap.Count)
	heap.Count++
}

// 删除
func (heap *Heap) Delete() {
	// 1. 将数组末尾的元素放到堆顶
	// 2. 将堆末尾的元素设置为nil
	heap.Val[0] = heap.Val[heap.Count]
	heap.Val[heap.Count] = 0
	heap.Count--
	// 下沉
	heap.sink(0)
}

// 上浮 (小顶堆)将小元素上浮到顶部
func (heap *Heap) swim(index int) {
	var p int = (index - 1) / 2 // 找到父节点的位置
	for p >= 0 && heap.Val[p] > heap.Val[index] {
		// 交换
		heap.Swap(p, index)
		index = p
		// 重新计算父节点的 index
		p = (index - 1) / 2
	}
}

// 下沉（小顶堆）将大元素下沉到底部
func (heap *Heap) sink(p int) {
	var smallPos int
	for {
		smallPos = p
		var l int = p*2 + 1
		if l < heap.Count && heap.Val[p] > heap.Val[l] {
			smallPos = l
		}

		var r int = l + 1
		if r < heap.Count && heap.Val[smallPos] > heap.Val[r] {
			smallPos = r
		}

		// 下沉终止
		if smallPos == p {
			break
		}

		// 数据交换
		heap.Swap(smallPos, p)

		p = smallPos
	}
}

// 自顶向下下沉，将最小(或最大下沉到最后)这样就会形成一个有序的数组
func (heap *Heap) Sort() {
	var length = heap.Count
	for i := length - 1; i >= 0; i-- {
		heap.Swap(0, i)
		heap.Count--
		heap.sink(0)
	}
}

// 数据交换
func (heap *Heap) Swap(index1 int, index2 int) {
	heap.Val[index1], heap.Val[index2] = heap.Val[index2], heap.Val[index1]
}

func main() {
	var heap *Heap = Factory(10)
	heap.Insert(10)
	heap.Insert(7)
	heap.Insert(1)
	heap.Insert(8)
	heap.Insert(4)

	fmt.Println(heap.Val)
	// heap.Delete()
	// fmt.Println(heap.Val)
	heap.Sort()
}
