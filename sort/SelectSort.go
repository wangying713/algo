package main
import "fmt"

func selectSort(arr []int) {
    var length =len(arr)
    for i := 0; i < length; i++ {
        var min = i;
        for j := i + 1; j < length; j++ {
            if arr[min] > arr[j] { // 最小的大于其中的任何一个
                min = j
            }
        }
        // 交换位置
        var tmp int = arr[i]
        arr[i] = arr[min]
        arr[min] = tmp
    }
}

func main()  {
	
	var arr []int = []int {6, 7, 1, 3, 2, 5, 4}
	selectSort(arr)
	fmt.Println(arr)

}