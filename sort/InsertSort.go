package main
import "fmt"

func insertSort(arr []int) {
    var length =len(arr)
    for i := 1; i < length; i++ {
        // 用来记录当前的数值
        var tmp int = arr[i]
        var j int = i-1;
        for ;j >= 0; j-- {
            if tmp > arr[j] { // 当前已经是有序的
                break
            }
            arr[j+1] = arr[j] // 交换位置
        }
        // 放入合适的位置，如果循环完整的完成，那么 j 一定是-1，所以这里要+1
        arr[j+1] = tmp
    }
}

func main()  {
	
	var arr []int = []int {6, 7, 1, 3, 2, 5, 4}
	insertSort(arr)
	fmt.Println(arr)

}