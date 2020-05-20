<?php
class Node
{
    public $val;
    public $left;
    public $right;

    public function __construct($val)
    {
        $this->val = $val;
    }
}

class Tree
{
    public $node = null;

    /**
     * 根据 val 插入数据
     *
     * @param integer $val
     *
     * @return void
     */
    public function insert($val)
    {
        // 不要带头
        if ($this->node == null) {
            $this->node = new Node($val);
            return $this;
        }

        $tmp = $this->node;
        // 大的插入到右边，小的插入到左边
        while ($tmp != null) {
            if ($val >= $tmp->val) {
                if ($tmp->right == null) {
                    $tmp->right = new Node($val);
                    break;
                }
                $tmp = $tmp->right;
            } else {
                if ($tmp->left == null) {
                    $tmp->left = new Node($val);
                    break;
                }
                $tmp = $tmp->left;
            }
        }
        return $this;
    }

    public function createBinaryByArray($arr, $node = null)
    {
        $i = 0;
        // 不要带头
        if ($node == null) {
            $node = new Node($arr[0]);
            $i = 1;
        }

        for ($i; $i < count($arr); $i++) {
            $childNode = $this->getNode($node, $i);

            if ($i % 2 == 0) {
                $childNode->right = new Node($arr[$i]);
            } else {
                $childNode->left = new Node($arr[$i]);
            }
        }
    }

    public function getNode($pnode, $k)
    {
        $node = $pnode;
        if ($k % 2 == 0) {
            // right
            $pk = ($k - 2) / 2;
        } else {
            // left
            $pk = ($k - 1) / 2;
        }

        $k = 0;
        while ($node != null) {

            if ($pk == $k) {
                break;
            }

            if ($k % 2 == 0) {
                $node = $node->right;
            } else {
                $node = $node->left;
            }

            $k++;
        }

        return $node;
    }

    public function insertLeft($node, $val)
    {
        $node->left = $val;
    }

    public function insertRight()
    {

    }

}

// 数组转换二叉树

$tree = new Tree();
// $tree->insert(1)
//     ->insert(2)
//     ->insert(3);

$arr = [1, 2, 3];
$tree->createBinaryByArray($arr);
