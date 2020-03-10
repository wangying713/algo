<?php
/**
 * BF 算法中的 BF 是 Brute Force 的缩写，中文叫作暴力匹配算法，也叫朴素匹配算法。
 * 我们在字符串 A 中查找字符串 B，那字符串 A 就是主串，字符串 B 就是模式串
 *
 * BF 算法的时间复杂度很高，是 O(n*m)，但在实际的开发中，它却是一个比较常用的字符串匹配算法？ 这是为什么呢？
 *  第一，实际的软件开发中，大部分情况下，模式串和主串的长度都不会太长。
 *      而且每次模式串与主串中的子串匹配的时候，当中途遇到不能匹配的字符的时候，就可以就停止了，不需要把 m 个字符都比对一下。
 *      所以，尽管理论上的最坏情况时间复杂度是 O(n*m)，但是，统计意义上，大部分情况下，算法执行效率要比这个高很多。
 *  第二，朴素字符串匹配算法思想简单，代码实现也非常简单。简单意味着不容易出错，如果有 bug 也容易暴露和修复。在工程中，在满足性能要求的前提下，简单是首选。这也是我们常说的KISS（Keep it Simple and Stupid）设计原则。
 */
function bfSearch(string $main, string $pattern)
{
    $mlength = strlen($main);
    $plength = strlen($pattern);

    // 不可能找到
    if ($mlength == 0 || $plength == 0 || $mlength < $plength) {
        return -1;
    }

    // 只需要循环 main-pattern 的次数就可以了
    for ($i = 0; $i <= $mlength - $plength; $i++) {

        // 裁切 pattern 长度的字符串
        $substr = substr($main, $i, $plength);

        if ($substr == $pattern) {
            return $i;
        }

    }

    return -1;
}

$mstring = 'abcd227fac';
$pstring = 'ac';

$rs = bfSearch($mstring, $pstring);

var_dump($rs);
