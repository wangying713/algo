<?php
class Bm {

    public function __construct() {

    }


    public function search($main, $patten) {

        $mLen = strlen($main);
        $pLen = strlen($patten);

        // 首先根据 parten 生成位置字典
        $suffix = $this->generate($patten, $pLen);

        // 还需要比较 mLen-pLen 次就可以了
        // 例如 abc 匹配 bc 只需要两次 3 - 2 + 1 = 1
        // 例如 abcdef 匹配 def 需要匹配 6 - 3 + 1 = 4次
        $i = 0;
        while($i <= $mLen - $pLen) {

            // 首部对齐，比较尾部
            for($j = $pLen - 1; $j >= 0; $j--) {
                $k = $i + $j;
                // 遇到坏字符
                if($main[$k] != $patten[$j]) {
                    break;
                }
            }

            // 没有坏字符，已经匹配到了，直接返回
            if ($j == -1) {
                return $i;
            }


            // 计算坏字符偏移的数量
            // 坏字符偏移的数量 = 坏字符出现的位置 - 上一次出现的位置
            // ----------------------------------------------
            // 如果模式串中不存在，那么上一次出现的位置为-1
            $mainIndex = $i+$j;
            if (!isset($suffix[$main[$mainIndex]])) {
                $x = $j;
            } else {
                $x = $j - $suffix[$main[$mainIndex]];
            }
            // ----------------------------------------------

            // 好后缀的偏移数量
            // 好后缀偏移的数量 = 好后缀最后一次出现的位置 - 好后缀上一次出现的位置（如果多次，取第一次）
            // ---------------------------------------------------------------------------
            $y = 0;
            if (isset($suffix[$main[$j]])) {

                if ($suffix[$main[$j]] == $patten[$j]) {
                    $y = $j - $suffix[$main[$j]];
                }

            }
            // ---------------------------------------------------------------------------
            $i += max($x, $y);
        }
        return -1;
    }
    
    public function generate($patten, $pLen) {
        $suffix = [];
        // 从大到小排序,前面相同的会被覆盖
        // 用来计出现的位置
        for($i=$pLen-1; $i>=0; $i--) {
            // 前面的 key 覆盖后面的
            $suffix[$patten[$i]] = $i;
        }

        return $suffix;
    }

}


$rs = new Bm();
// $main = "abcacabdc";
// $pattern = "abd";

$mainaaa = "HERE IS A SIMPLE PLEMPLE";
$pattern = "PLEMPLE";

$rs = $rs->search($mainaaa, $pattern);

var_dump($rs);
