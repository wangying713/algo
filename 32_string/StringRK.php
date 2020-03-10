<?php
/**
 * RK 算法的全称叫 Rabin-Karp 算法，是由它的两位发明者 Rabin 和 Karp 的名字来命名的
 *
 * 算法步骤
 *  1. hash 计算，假设要处理的字符串都是 a-z 的小写字母，我们可以处理成26进制 a=0, b=1, c=2 ... z=25
 *  2. 对 string[1, len]计算出哈希值，这里不是每次都需要计算。
 *     只需要减去第一个，加上最后一个哈希值就可以了。这样不需要每次都对字符串进行哈希值计算
 *  3. 如果匹配的值相等，那么可以认定值是相等的，如果有哈希冲突，那么再次比较一下值
 *  4. 在此，我们直接调用 ord 就好了，英文字符都可以应付了
 */
class Rk
{

    /**
     * bsearch
     *
     * @param string $main
     * @param string $pattern
     *
     * @return int
     */
    public function rkSearch(string $main, string $pattern)
    {
        $mlength = strlen($main);
        $plength = strlen($pattern);

        if ($mlength == 0 || $plength == 0 || $mlength < $plength) {
            return -1;
        }

        // 先计算出 targethash
        $targetHash = $this->hash($pattern, 0, $plength);

        $hash = $this->hash($main, 0, $plength);
        // 计算 hash
        $length = $mlength - $plength;

        for ($i = $plength; $i < $mlength; $i++) {
            // 减去字符串的首code值
            $hash -= $this->hashChar($main[$i - $plength]);
            // 加上新的 code 值
            $hash += $this->hashChar($main[$i]);
            if ($hash == $targetHash) {
                return $i - $plength;
            }
        }

        return -1;
    }

    /**
     * 计算一个字符串的 hash
     *
     * @param [string] $str
     * @param [int] $s
     * @param [int] $e
     *
     * @return void
     */
    public function hash($str, $s, $e)
    {
        $hash = 0;
        for ($i = $s; $i < $e; $i++) {
            $hash += $this->hashChar($str[$i]);
        }

        return $hash;
    }

    /**
     * 计算单个字符的 hash
     *
     * @param [string] $char
     *
     * @return int
     */
    public function hashChar($char)
    {
        return ord($char);
    }

}

$rs = new Rk();

$main = 'nihao123';
$pattern = '123';
$rs = $rs->rkSearch($main, $pattern);

var_dump($rs);
