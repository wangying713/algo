<?php
/**
 * 赫夫曼树
 *  给定N个权值作为N个叶子结点，构造一棵二叉树，若该树的带权路径长度达到最小，称这样的二叉树为最优二叉树
 *  也称为哈夫曼树(Huffman Tree)。哈夫曼树是带权路径长度最短的树，权值较大的结点离根较近。
 *
 * 实现步骤
 *   1. 将数据排序放入队列（从小到大）
 *   2. 从队列中取出两个数据（从小到大）生成一个新的二叉树
 *   3. 新的二叉树的权值是前面两个数据的和
 *   4. 在将新的二叉树产生的权值进行排序，持续1，2，3，4的操作，直到队列中没有数据
 */

class HuffmanTree
{

    /**
     * 获得霍夫曼树
     *
     * @param array $arr
     *
     * @return HuffmanNode
     */
    public function getHuffmanTree(array $arr)
    {

        // 先将数据放入队列
        $queue = [];
        foreach ($arr as $val) {
            array_push($queue, new HuffmanNode($val));
        }

        while (count($queue) > 1) {

            // 队列排序
            sort($queue);
            $leftNode = array_shift($queue);
            $rightNode = array_shift($queue);

            // 生成新的权值
            $newNode = new HuffmanNode($leftNode->val + $rightNode->val);
            $newNode->left = $leftNode;
            $newNode->right = $rightNode;

            // 将新的树压入队列
            array_push($queue, $newNode);
        }

        return $queue[0];
    }
}

/**
 * HuffmanNode
 */
class HuffmanNode
{
    public $val;
    public $left;
    public $right;
    public function __construct($val)
    {
        $this->val = $val;
    }
}

$arr = [3, 1, 6, 7, 8, 13, 29];

$rs = new HuffmanTree();
$rs->getHuffmanTree($arr);
