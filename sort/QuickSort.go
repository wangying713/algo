package main

import "fmt"

// 快速排序
func quickSort(arr []int) {
    interally(arr, 0, len(arr)-1)
}

// 递归分区
func interally(arr []int , l int, r int) {
    if l >= r {
        return 
    }
    var border int = parttion(arr, l, r)
    interally(arr, l, border-1)
    interally(arr, border+1, r)
}

// 治理
func parttion(arr []int, l int, r int) int {
    // 定义数组的最后一个元素为临界点 pivot
    var povit = arr[r]
    var border = l
    for i := l; i < r; i++ {
        if arr[i] < povit { // 小于临界点（基准值）
            if border != i { // 这里比较难理解，参见下图
                // go 语言特性，其他语言需要 tmp 中间变量处理一下
                arr[i], arr[border] = arr[border], arr[i]
            }
            border ++ // 偏移指针
        } 
    }
    // 将 l 放入左边，r 放入右边，pivot 在中间
    arr[r], arr[border] = arr[border], arr[r]
    return border
}

// 这种情况说明 i 与 border 之间存在不是有序的数据
// 现在的状态是有序的，需要偏移指针(border),
// 为了保持指针的有效性那么交换他们，使指针前半部分依然是有序的

func main()  {
    var arr []int = []int{6, 7, 1, 3, 2, 5, 4}
    quickSort(arr)
	fmt.Println(arr)
}