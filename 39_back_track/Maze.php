<?php
/**
 * 迷宫道路探测，回溯方法
 */
class Maze
{
    /**
     * 探测
     *
     * @return void
     */
    public function go()
    {

        // 先生成一个7*8的网格
        $rs = [];
        for ($i = 0; $i < 7; $i++) {
            for ($j = 0; $j < 8; $j++) {
                $rs[$i][$j] = 0;
            }
        }

        // 制造障碍 将第3行第0,1,2,3作为障碍
        $rs[4][0] = 1;
        $rs[4][1] = 1;
        $rs[4][2] = 1;
        $rs[4][3] = 1;

        $rs[5][3] = 1;

        $this->_go($rs, 0, 0);
        $this->print($rs, 0, 0);
    }

    /**
     * 0-没有走过，1-墙不可以走，2走过，路通，3走过，路不通
     *
     * @return void
     */
    public function _go(&$arr, $i, $j)
    {
        // 越界
        if (!isset($arr[$i][$i])) {
            return false;
        }

        $target = $arr[6][7];
        if ($target == 2) {
            return true;
        }

        if ($arr[$i][$j] == 0) {
            // 标识当前节点走过可以走通
            $arr[$i][$j] = 2;

            // 探测左侧 回溯
            if ($this->_go($arr, $i + 1, $j)) {
                return true;
            }

            // 右
            if ($this->_go($arr, $i, $j + 1)) {
                return true;
            }

            // 上
            if ($this->_go($arr, $i - 1, $j)) {
                return true;
            }

            if ($this->_go($arr, $i, $j - 1)) {
                return true;
            }
        } else {
            return false;
        }

    }

    function print($arr) {
        foreach ($arr as $value) {
            foreach ($value as $val) {
                echo $val . " ";
            }
            echo "\n";
        }
    }

}

$rs = new Maze();
$rs->go();
