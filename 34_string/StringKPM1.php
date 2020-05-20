<?php
/**
 * KMP 的另一种实现
 * KPM 算法是由三位大佬发明的
 *  主要是在好前缀中，找到一种高效的偏移比较算法，起始时 RK(32讲) 算法的升级。
 *  目的是怎样在好前缀的基础上多滑动几位，来提升效率呢？
 *  匹配的步骤
 *      1. 在主串与模式串之前逐一比较，如果不匹配则主串偏移，一直到第一个字符匹配成功，形成好前缀
 *      2. 我们用已经预先处理好的前缀表（或失败函数）来确定滑动位数，这样就可以多滑动几位了，提升匹配效率
 *      3. 移动位数=已匹配的字符数-对应的部分匹配值。或者将公共前缀放到公共后缀的位置
 *  如何计算部分匹配索引|失效函数表
 *      1. 暴力查找法
 *      2. 通过前一个已经计算的值来计算，如果匹配，加1，否则查找上一个是否匹配
 *
 * 参考链接：
 *  最终还是参考了阮一峰老师的文章简单易懂
 *  http://www.ruanyifeng.com/blog/2013/05/Knuth%E2%80%93Morris%E2%80%93Pratt_algorithm.html
 */
class StringKPM
{

    /**
     * 获得不分匹配表|失效函数
     *  最难理解的地方是
     *  k = next[k]
     *   因为前一个的最长串的下一个字符不与最后一个相等，需要找前一个的次长串，
     *   问题就变成了求0到next(k)的最长串，如果下个字符与*   
     *   最后一个不等，继续求次长串，也就是下一个next(k)，直到找到，或者完全没有
     *
     * @param [string] $partten
     *
     * @return int
     */
    public static function getPrefix1(string $partten)
    {
        $prefix = [
            0 => 0,
        ];
        $plen = strlen($partten);

        $i = 1;
        $len = 0;
        $t = 0;
        while ($i < $plen) {
            if ($partten[$len] == $partten[$i]) {
                $len++;
                // 利用上一个最长前缀+1
                $prefix[$i] = $len;
                $i++;
            } else {
                // 边界限定
                if ($len > 0) {
                    // 无需 i++
                    $len = $prefix[$len - 1];
                } else {
                    $prefix[$i] = $len;
                    $i++;
                }
            }
        }
        return $prefix;
    }

    /**
     * 获得前缀表
     *
     * @param [string] $partten
     *
     * @return array
     */
    public static function getPrefix(string $partten)
    {
        $prefix = [
            0 => 0,
        ];
        $plen = strlen($partten);

        $len = 0;
        for ($i = 1; $i < $plen; $i++) {
            while ($len > 0 && $partten[$len] != $partten[$i]) {
                // 缩小范围
                $len = $prefix[$len - 1];
                // $len = 0;
            }

            if ($partten[$len] == $partten[$i]) {
                $len++;
            }
            $prefix[$i] = $len;
        }

        return $prefix;
    }

    /**
     * kpm
     *
     * @param string $main
     * @param string $partten
     *
     * @return int
     */
    public static function kmp(string $main, string $partten)
    {
        $mlen = strlen($main);
        $plen = strlen($partten);

        if ($mlen == 0 || $plen == 0 || $mlen < $plen) {
            return false;
        }

        $prefix = static::getPrefix($partten);
        $j = 0;
        for ($i = 0; $i < $mlen; $i++) {
            // 一直偏移，直到相等
            while ($j > 0 && $main[$i] != $partten[$j]) {
                // 偏移
                $j = $prefix[$j - 1];
            }

            // 相等，j 偏移
            if ($main[$i] == $partten[$j]) {
                $j++;
            }

            // j 已经匹配到最右侧了
            if ($j == $plen - 1) {
                return $i - ($plen - 1);
            }
        }

        return -1;
    }
}

$main = 'BBC ABCDAB ABCDABCDABSDE';
$parttenxxxxxxxxxxxxx = 'ababaa';
$xxxxxxx = '0123456';
$rs = StringKPM::getPrefix($parttenxxxxxxxxxxxxx);
// var_dump($rs);
    
print_r($rs);