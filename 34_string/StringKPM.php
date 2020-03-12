<?php
/**
 * KPM 算法是由三位大佬发明的
 *  主要是在好前缀中，找到一种高效的偏移比较算法，思想与 RM 算法类似
 *  那怎样来找到一种高效的偏移方法呢？
 *  1. 在主串和模式串中对比第一个字符，直到发生匹配，main[i]==partten[1]
 *  2. 当主串第 i 个元素与模式串第一个元素发生匹配时，这就要引入好前缀的概念
 *     1. 拿好前缀本身，在它的后缀子串中，查找最长的那个可以跟好前缀的前缀子串匹配的
 *     2. 假设最长的可匹配的那部分前缀子串(最长可匹配前缀子串)是{v}，长度是 k。我们把模式串一次性往后滑动 j-k 位
 *     3. 好前缀分前缀和后缀，步骤2是为了查找前缀和后缀重合的不分
 *
 *  3. 最难理解的部分起始是 next 了，当最后不匹配，需要查找前一个 k=$next[k]，其实是向前查找一位，因为有下标对应的关系
 *
 *
 * 　　移动位数 = 已匹配的字符数 - 对应的部分匹配值
 *
 *
 * 参考链接：
 *  最终还是参考了阮一峰老师的文章简单易懂
 *  http: //www.ruanyifeng.com/blog/2013/05/Knuth%E2%80%93Morris%E2%80%93Pratt_algorithm.html
 */
class StringKPM
{
    public static function kpm($main, $partten)
    {
        $meln = strlen($main);
        $plen = strlen($partten);

        // 部分匹配表
        $next = static::getNexts($partten);
        $j = 0;
        for ($i = 0; $i < $meln; $i++) {
            // 有了好前缀后，当有坏字符的出现
            while ($j > 0 && $main[$i] != $partten[$j]) { // 一直找到 a[i]和 j[j]
                // 移动的位数 = 已经匹配的字符数 - 对应的那部分匹配值
                // $j = $j - ($j - ($next[$j - 1] + 1));
                // 经过简写
                $j = $next[$j - 1] + 1;
            }

            // 如果相等模式串偏移（主串与模式串一起偏移）
            if ($main[$i] == $partten[$j]) {
                $j++;
            }

            // 如果模式串偏移到最后，则说明匹配成功
            if ($j == $plen) {
                // 起始位置需要减去模式串的长度
                return $i - $plen + 1;
            }
        }

        return -1;
    }

    /**
     * 获得不分匹配表|失效函数
     *  最难理解的地方是
     *  k = next[k]
     *   因为前一个的最长串的下一个字符不与最后一个相等，需要找前一个的次长串，问题就变成了求0到next(k)的最长串，如果下个字符与*   最后一个不等，继续求次长串，也就是下一个next(k)，直到找到，或者完全没有
     *
     * @param [string] $partten
     *
     * @return int
     */
    public static function getNexts($partten)
    {
        $len = strlen($partten);
        $next = [
            0 => -1,
        ];

        $k = -1;
        for ($i = 1; $i < $len; $i++) {

            // 如果下一个字符不匹配
            while ($k != -1 && $partten[$k + 1] != $partten[$i]) {
                // 查看次长串是否匹配
                // 按道理来说，次上传应该就是 k，但是如果 k=k会形成死循环
                // 那怎样解决呢？起始 next[$k]对应的值就是次长串对应的值，不信你打印看一下
                $k = $next[$k];
            }

            // 如果匹配成功，那么标记匹配数量+1
            if ($partten[$k + 1] == $partten[$i]) {
                $k++;
            }

            // 记录当前字符的匹配数量
            $next[$i] = $k;
        }

        return $next;

    }

}

$main = 'BBC ABCDAB ABCDABCDABDE';
$parttenxxxxxxxxxxxxx = 'ABCDABD';
$xxxxxxx = '0123456';
$rs = StringKPM::kpm($main, $parttenxxxxxxxxxxxxx);
var_dump($rs);
