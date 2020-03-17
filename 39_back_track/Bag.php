<?php
/**
 * 回溯背包问题
 *
 * 题目：
 *  给定一组物品，他们的重量分别为[2, 2, 4, 6, 3]，背包的最大承重为9，写一个方法，如何才能最大限度的装满背包
 *
 */
class Bag
{

    public $maxW = 0;
    // 物品重量
    public $weight = [2, 2, 4, 6, 3];

    // 物品的个数
    public $n = 5;
    // 背包最大承重
    public $w = 9;

    public function f($i, $cw)
    {

        if ($cw == $this->w || $i == $this->n) {

            if ($cw > $this->maxW) {
                $this->maxW = $cw;
            }
            return;
        }

        $this->f($i + 1, $cw);

        if ($cw + $this->weight[$i] < $this->w) {
            $this->f($i + 1, $this->weight[$i] + $cw);
        }

        echo sprintf("i=%s, cw=%s\n", $i, $cw);
    }
}

$rs = new Bag();
$rs->f(0, 0);

var_dump($rs->maxW);
