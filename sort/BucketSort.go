package main

import "fmt"

func bucketSort(arr []int, bucketSize int) {

	var minVal int = arr[0]
	var maxVal int = arr[0]
	for i := 1; i < len(arr); i++ {
		if arr[i] < minVal {
			minVal = arr[i]
		} else {
			maxVal = arr[i]
		}
	}

	// 桶的数量
	var bucketNum = (maxVal-minVal)/bucketSize + 1
	// 桶数据
	var buckets [][]int = make([][]int, bucketNum)

	// 将数据放入桶中
	for _, val := range arr {
		var index = (val - minVal) / (bucketSize)
		buckets[index] = append(buckets[index], val)
	}

	var k int = 0
	// 桶内的数据排序并合并
	for i := 0; i <= bucketNum; i++ {
		sort(buckets[i]) // 伪代码调用快速排序
		for _, val := range buckets[i] {
			arr[k] = val
			k++
		}
	}
}

func main() {
	var nums []int = []int{15, 16, 17, 18, 19, 7, 8, 9, 10, 11, 1, 2, 3, 4, 5, 6, 12, 13, 14, 20}

	bucketSort(nums, 5)

	fmt.Println(nums)
}
