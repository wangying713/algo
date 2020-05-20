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
}

// 数组转换二叉树

$tree = new Tree();
// $tree->insert(1)
//     ->insert(2)
//     ->insert(3);

$arr = [1, 2, 3];
$tree->createBinaryByArray($arr);
