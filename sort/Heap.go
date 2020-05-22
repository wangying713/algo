package main

import "fmt"

type Heap struct {
	Val    []int // 值
	Cap    int   // 当前容量
	MaxCap int   // 最大容量
}

// 工厂实例化
func Factory(maxCap int) *Heap {
	var heap *Heap = &Heap{
		Val:    make([]int, maxCap),
		MaxCap: maxCap,
		Cap:    0,
	}
	return heap
}

func (heap *Heap) Insert(val int) {

	if heap.Cap >= heap.MaxCap {
		return
	}

	// 首先将数据插入到数组的末端
	heap.Cap++
	heap.Val[heap.Cap] = val

	// 对新增加的数据进行上浮操作
	heap.swim(heap.Cap)
}

func (heap *Heap) Delete() {
	if heap.Cap <= 0 {
		return
	}
	// 首先将堆顶低的元素替换到堆顶，并删除堆低的元素
	heap.Val[1] = heap.Val[heap.Cap]
	heap.Val[heap.Cap] = 0
	heap.Cap--
	heap.skin(1)
}

// 创建堆
func (heap *Heap) BuildHeap(nums []int) {
	for i, val := range nums {
		if heap.Cap >= heap.MaxCap { // 超过容量跳出
			break
		}
		i++
		heap.Val[i] = val
		heap.Cap++
	}

	var skinIndex = len(nums) / 2
	for i := skinIndex; i >= 1; i-- {
		heap.skin(i) // 下沉
	}
}

// 堆排序，这里是倒序，如果想正序排序，需要构建大顶堆
func (heap *Heap) Sort() {
	for i := heap.Cap; i >= 1; i-- {
		heap.swap(0, i)
		heap.Cap--
		heap.skin(0)
	}
}

// 上浮 (小顶堆)将小元素上浮到顶部
func (heap *Heap) swim(index int) {
	// 找到父节点的位置
	var p = index / 2
	// 当前上浮的节点要比父节点的值小，才能进行上浮操作
	for p >= 1 && heap.Val[index] < heap.Val[p] {
		heap.swap(p, index)
		index = p     // 新的子节点的位置
		p = index / 2 // 新的父节点的位置
	}
}

// 下沉（小顶堆）将大元素下沉到底部
func (heap *Heap) skin(p int) {
	for {
		var pos = p       // 当前堆顶的位置
		var l int = p * 2 // 左子节点的位置
		if heap.Val[pos] > heap.Val[l] && l <= heap.Cap {
			pos = l // 标记当前小顶堆的位置
		}
		var r int = l + 1 // 右子节点的位置
		if heap.Val[pos] > heap.Val[r] && r <= heap.Cap {
			pos = r // 覆盖左子节点上次标记的位置
		}
		if pos == p { // 无操作退出
			break
		}
		heap.swap(p, pos) // 交换位置
		p = pos           // 标记新的堆顶的位置
	}
}

// 交换位置
func (heap *Heap) swap(i, j int) {
	heap.Val[i], heap.Val[j] = heap.Val[j], heap.Val[i]
}

func main() {
	var heap *Heap = Factory(10)
	var nums []int = []int{3, 7, 8, 4, 5}
	heap.BuildHeap(nums)
	heap.Sort()
	fmt.Println(heap)
	// heap.Insert(1)
	// heap.Insert(2)
	// heap.Insert(3)
	// heap.Insert(4)
	// heap.Insert(5)
	// fmt.Println(heap)
	// heap.Delete()
	// fmt.Println(heap)
}
