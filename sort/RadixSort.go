package main

import (
	"fmt"
	"strconv"
)

func redixSort(nums []int) {
	var maxLen int = len(strconv.Itoa(nums[0]))
	// 获取最长的大数的长度
	for i := 1; i < len(nums); i++ {
		var val string = strconv.Itoa(nums[i])
		if maxLen < len(val) {
			maxLen = len(val)
		}
	}
	var exp = 1
	for i := 1; i <= maxLen; i++ {
		countSort(nums, exp)
		exp *= 10
	}
}

func countSort(nums []int, exp int) {
	// 定义一个二维数组桶
	var buckets [][]int = make([][]int, 10)
	for i := 0; i < len(nums); i++ {
		var index = nums[i] / exp % 10
		// 计数排序的思想
		buckets[index] = append(buckets[index], nums[i])
	}
	// 将桶内的数据，放入拷贝nums 中
	var k int = 0
	for _, bucket := range buckets {
		if len(bucket) > 0 {
			for _, val := range bucket {
				nums[k] = val
				k++
			}
		}
	}
}

func main() {
	var nums []int = []int{326, 453, 608, 835, 751, 435, 704, 690, 790}
	redixSort(nums)
	fmt.Println(nums)
}
