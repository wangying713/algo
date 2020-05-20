<?php
/**
 * 我们有一个 8x8 的棋盘，希望往里放 8 个棋子（皇后），每个棋子所在的行、列、对角线都不能有另一个棋子。
 * 我们把这个问题划分成 8 个阶段，依次将 8 个棋子放到第一行、第二行、第三行……第八行。在放置的过程中
 *  我们不停地检查当前放法，是否满足要求。如果满足，则跳到下一行继续放置棋子；如果不满足，那就再换一种放法，继续尝试。
 *
 */
class Cal8Queens
{
    /**
     * 结果集
     *
     * @var array
     */
    public $result = [];

    public function __construct()
    {

    }

    /**
     * cal8Queens
     *
     * @param int $row
     *
     * @return void
     */
    public function cal8Queens(int $row = 0)
    {
        if ($row == 8) {
            $this->printQueens($this->result);
            die;
        }

        for ($column = 0; $column < 8; $column++) {
            if ($this->isOk($row, $column)) {
                $this->result[$row] = $column;
                $this->cal8Queens($row + 1);
            }
        }

    }

    /**
     * 这行的这列能放皇后？
     *
     * @param int $row
     * @param int $column
     *
     * @return bool
     */
    public function isOk(int $row, int $column)
    {
        // 左上角
        $leftUp = $column - 1;
        // 右上角
        $rightUp = $column + 1;

        for ($i = $row - 1; $i >= 0; $i--) {
            // 第i行的column列有棋子吗？
            if ($this->result[$i] == $column) {
                return false;
            }

            // 第i行的column列有棋子吗？
            if ($leftUp >= 0) {
                if ($this->result[$i] == $leftUp) {
                    return false;
                }
            }

            // 考察右上对角线：第i行rightup列有棋子吗？
            if ($rightUp < 8) {
                if ($this->result[$i] == $rightUp) {
                    return false;
                }
            }

            $leftUp--;
            $rightUp++;

        }

        return true;
    }

    /**
     *  打印8皇后
     *
     * @param array $result
     *
     * @return void
     */
    private function printQueens(array $result)
    {
        for ($row = 0; $row < 8; $row++) {
            for ($column = 0; $column < 8; $column++) {
                if ($result[$row] == $column) {
                    echo "Q ";
                } else {
                    echo "* ";
                }
            }
            echo "\n";
        }
        echo "\n";
    }
}

$rs = new Cal8Queens();
$rs->cal8Queens();

// Q * * * * * * *
// * * * * Q * * *
// * * * * * * * Q
// * * * * * Q * *
// * * Q * * * * *
// * * * * * * Q *
// * Q * * * * * *
// * * * Q * * * *
