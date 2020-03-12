<?php
/**
 * 字符串匹配的Boyer-Moore算法
 * 王争老师的写法总感觉太过复杂，要不是刻意翻代码看，还是不好理解。
 * 参考了阮一峰老师的博客，简单易懂，感觉用这种方法就刻意
 *  参考地址：http: //www.ruanyifeng.com/blog/2013/05/boyer-moore_string_search_algorithm.html
 *
 * 时间复杂度分析：
 *  实际上，BM 算法的时间复杂度分析起来是非常复杂，这篇论文“A new proof of the linearity of the Boyer-Moore string *
 *  searching algorithm”证明了在最坏情况下，BM 算法的比较次数上限是 5n。这篇论文“Tight bounds on the complexity of the
 *  Boyer-Moore string matching algorithm”证明了在最坏情况下，BM 算法的比较次数上限是 3n。你可以自己阅读看看。
 */
class StringBM
{
    /**
     * 生成模式串对应的 key
     *
     * @param [type] $b
     *
     * @return void
     */
    private function generateBC($pattern)
    {
        // ascii 个数
        $size = 256;
        $rs = [];
        for ($i = 0; $i < $size; $i++) {
            // 不存在默认-1
            $rs[$i] = -1;
        }

        // 标记模式串在字符串中出现的位置
        for ($i = 0; $i < strlen($pattern); $i++) {
            $k = ord($pattern[$i]);
            $rs[$k] = $i;
        }

        return $rs;
    }

    /**
     * 坏字符的处理方式
     *  1. 生成模式串在字符串中对应的位置
     *  2. 查找坏字符在模式串中对应的位置（匹配最后一个出现的位置）
     *
     * @param string $main
     * @param string $pattern
     *
     * @return void
     */
    public function bmBadShuuix(string $main, string $pattern)
    {
        $mlen = strlen($main);
        $plen = strlen($pattern);

        // 查找不合法，找不到
        if ($mlen == 0 || $plen == 0 || $mlen < $pattern) {
            return -1;
        }

        // 生成模式串对应的 key
        $bc = $this->generateBC($pattern);

        // 起始位置
        // $mlen = $i + $plen
        $i = 0;
        while ($i <= $mlen - $plen) {

            for ($j = $plen - 1; $j >= 0; $j--) {
                // 遇见坏字符
                if ($main[$i + $j] != $pattern[$j]) {
                    break;
                }
            }

            // 如果一直没有遇见坏字符，那么代表匹配成功，j 一定是=-1的
            if ($j < 0) {
                return $i;
            }

            // 遇见了坏字符，查找最后一次出现坏字符的位置
            $lastIndex = $bc[ord($main[$i + $j])];

            // 偏移的位置
            $i = $i + ($j - $lastIndex);
        }

        return -1;
    }

    private function generateGS($pattern, $length, &$suffix, &$prefix)
    {
        for ($i = 0; $i < $length; $i++) {
            $suffix[$i] = -1;
            $prefix[$i] = false;
        }

        for ($i = 0; $i < $length - 1; $i++) {
            $j = $i;
            // 公共后缀子串的长度
            $k = 0;

            // 与 b[0, m-1]求公共后缀子串
            while ($j >= 0 && $pattern[$j] == $pattern[$length - 1 - $k]) {
                $j--;
                $k++;
                // j+1 表示公共后缀子串在 b[0, 1]中的起始下标
                $suffix[$k] = $j + 1;
            }

            // 如果公共后缀子串也是模式串的前缀子串
            if ($j == -1) {
                $prefix[$k] = true;
            }

        }
    }

    /**
     * 我的思路，简单的偏移方法
     *
     * @param [string] $main
     * @param [string] $pattern
     *
     * @return void
     */
    public function bmMy(string $main, string $pattern)
    {
        $mlen = strlen($main);
        $plen = strlen($pattern);

        if ($mlen == 0 || $plen == 0 || $mlen < $plen) {
            return -1;
        }

        // 生成模式串对应的 key
        $bc = $this->generateBC($pattern);

        // 生成好后缀 index
        $suffix = $this->generateGSMy($pattern);

        $i = 0;
        // 起始的位置小于等于结束的位置-plen
        while ($i <= $mlen - $plen) {

            // 开始匹配的位置
            $j = $j = $plen - 1;

            for ($j = $plen - 1; $j >= 0; $j--) {
                // 遇见坏字符
                if ($main[$i + $j] != $pattern[$j]) {
                    break;
                }
            }

            // 如果一直没有遇见坏字符，那么代表匹配成功
            // j 一定是=-1的。 那么返回起始位置
            if ($j == -1) {
                return $i;
            }

            // 获得坏字符的 index
            $x = $bc[ord($main[$i + $j])];
            // 坏字符的偏移数量
            $x = $j - $x;

            // 获得好后缀的偏移位树
            $y = 0;
            if ($main[$i + $plen - 1] == $pattern[$plen - 1]) {
                $y = $plen - 1 - $suffix[$main[$i + $plen - 1]];
            }

            // 偏移位置
            $i = $i + max($x, $y);
        }

    }

    /**
     * 我的偏移方法，生成对应的位置
     *
     * @param [type] $pattern
     *
     * @return void
     */
    private function generateGSMy($pattern)
    {
        $length = strlen($pattern);

        // 记录第一次出现的位置
        $target = $pattern[$length - 1];

        $suffix = [];
        for ($i = $length - 2; $i >= 0; $i--) {
            $suffix[$pattern[$i]] = $i;
        }

        return $suffix;
    }

    /**
     * 王争老师的偏移方法，总感觉太复杂了
     *
     * @param [string] $main
     * @param [string] $pattern
     *
     * @return void
     */
    public function bm(string $main, string $pattern)
    {

        $mlength = strlen($main);
        $plength = strlen($pattern);

        // 获得模式串对应的位置
        $bc = $this->generateBC($pattern);

        $suffix = [];
        $prefix = [];
        // 计算前缀和后缀
        $this->generateGS($pattern, $plength, $suffix, $prefix);
        $i = 0;

        while ($i <= $mlength - $plength) {

            // 坏字符处理规则
            for ($j = $plength - 1; $j >= 0; $j--) {
                if ($main[$i + $j] != $pattern[$j]) {
                    break;
                }
            }

            if ($j < 0) {
                return $i;
            }

            // 好后缀处理规则
            $x = $j - $bc[ord($main[$i + $j])];
            $y = 0;
            if ($j < $plength - 1) {
                $y = $this->moveByGS($j, $plength, $suffix, $prefix);
            }

            $i = $i + max($x, $y);
        }

        return -1;
    }

    /**
     * 生成移动位数
     *
     * @param [string] $j
     * @param [string] $m
     * @param [array] $suffix
     * @param [array] $prefix
     *
     * @return void
     */
    private function moveByGS($j, $m, $suffix, $prefix)
    {

        // 好后缀的长度
        $k = $m - 1 - $j;
        if ($suffix[$k] != -1) {
            return $j - $suffix[$k] + 1;
        }

        for ($r = $j + 2; $r < $m - 1; $r++) {
            if ($prefix[$m - $r] == true) {
                return $r;
            }
        }

        return $m;
    }

}

$rs = new StringBM();

// $main = "abcacabdc";
// $pattern = "abd";

$mainaaa = "HERE IS A SIMPLE PLEMPLE";
$pattern = "PLEMPLE";

$rs = $rs->bm($mainaaa, $pattern);

var_dump($rs);
