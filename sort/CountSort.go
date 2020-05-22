package main

import "fmt"

func countSort(nums []int) {

	// 获得数组中最大的值的长度
	var maxVal = nums[0]
	for i := 1; i < len(nums); i++ {
		if maxVal < nums[i] {
			maxVal = nums[i]
		}
	}

	// 生成一个数组 C，用来记录重复次数
	var c []int = make([]int, maxVal+1)

	// 计算数组中值的重复次数
	for _, val := range nums {
		c[val]++
	}

	// 将数组中的重复次数进行求和
	for i := 1; i <= maxVal; i++ {
		c[i] = c[i-1] + c[i]
	}

	// 将数据放入临时数组中
	var tmp []int = make([]int, len(nums))
	for i := len(nums) - 1; i >= 0; i-- {
		// 计算并获得应该放入 tmp 中的位置
		var index int = c[nums[i]] - 1

		// 将数据存储到 tmp 中
		tmp[index] = nums[i]

		// 既然已经处理完了，那么就需要将重复次数-1，以便下一次应用
		c[nums[i]]--
	}

	// 将数据拷贝回 nums 中
	for index, val := range tmp {
		nums[index] = val
	}
}

func main() {
	var nums []int = []int{2, 5, 3, 0, 2, 3, 0, 3}
	countSort(nums)

	fmt.Println(nums)
}
