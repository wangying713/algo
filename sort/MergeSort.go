package main
import "fmt"

func sort(arr []int) {
    interally(arr, 0, len(arr)-1)
}

// 递归分解
func interally(arr []int, l int, r int) {
    // 递归终止条件
    if l >= r {
        return 
    }
    var mid int = l + (r-l) / 2 // 这样写最大地好处就是可以处理大数溢出地概率会减小
    interally(arr, l, mid)
    interally(arr, mid+1, r)
    merge(arr, l, mid, r)
}

// 合并治理
func merge(arr []int, l int, m int, r int) {
    var i = l; // 左侧起始位置
    var j = m + 1; // 右侧起始位置
    var tmp []int
    for i <= m && j <= r {
        if arr[i] < arr [j] {
            tmp = append(tmp, arr[i])
            i++
        } else {
            tmp = append(tmp, arr[j])
            j++
        }
    }

    // 如果右侧还没有处理完
    if j <= r {
        // 右侧没有处理完成，说明左侧一定处理完了
        i = j 
        m = r
    }
    for ; i <= m; i++ {
        tmp = append(tmp, arr[i])
    }
    // 将数据复制到 arr 中
    for i := 0; i < len(tmp); i++ {
        arr[l+i] = tmp[i]
    }
}

func main()  {
	
	var arr []int = []int{6, 7, 1, 3, 2, 5, 4}

    sort(arr)
    
    fmt.Println(arr)

}