package main

import "fmt"

func bubbleSort(arr []int) {
	var length = len(arr)

	for i := 0; i < length; i++ {

		// 标记是否交换位置
		var isSwap = false
		for j := 1; j < length-i; j++ {
			if arr[j-1] > arr[j] {
				// 交换位置
				var tmp = arr[j]
				arr[j] = arr[j-1]
				arr[j-1] = tmp
				isSwap = true
			}
		}

		// 如果没有交换位置，那么跳出结束
		if isSwap == false {
			break
		}
	}
}

func main() {
	var arr []int = []int{6, 7, 1, 3, 2, 5, 4}
	bubbleSort(arr)
	fmt.Println(arr)
	fmt.Println("ok")
}
