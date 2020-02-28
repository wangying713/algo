<?php
/**
 * 二茬查找树
 */
class BinarySearchTree
{
    public $tree;

    /**
     * 插入数据
     *
     * @param [int] $data
     *
     * @return void
     */
    public function insert($data)
    {
        if ($this->tree == null) {
            $this->tree = new Node($data);
            return;
        }

        $p = $this->tree;
        while ($p != null) {

            // 比该节点大，插入到右边
            if ($data > $p->data) {
                if ($p->right == null) {
                    $p->right = new Node($data);
                    return;
                }
                $p = $p->right;
            } else {
                if ($p->left == null) {
                    $p->left = new Node($data);
                    return;
                }
                $p = $p->left;
            }
        }
    }

    /**
     * 为二叉树查找数据
     *
     * @param [int] $data
     *
     * @return void
     */
    public function find($data)
    {
        $p = $this->tree;
        while ($p != null) {
            if ($p->data == $data) {
                return $p;
            } else if ($data > $p->data) { // 去右侧查找
                $p = $p->right;
            } else {
                $p = $p->left;
            }
        }

        return null;
    }

    /**
     * 二叉树的删除操作分3种情况
     *  1. 要删除的节点没有子节点，我们只需要直接将父节点中，指向要删除节点的指针置为 null
     *  2. 要删除的节点只有一个子节点（只有左子节点或者右子节点），我们只需要更新父节点中，指向要删除节点的指针，让它指向要删除节点的子节点就可以了。
     *  3. 要删除的节点有两个子节点。我们需要找到这个节点的右子树中的最小节点，把它替换到要删除的节点上。
     *     然后再删除掉这个最小节点，因为最小节点肯定没有左子节点（如果有左子结点，那就不是最小节点了），
     *     所以，我们可以应用上面两条规则来删除这个最小节点。
     *
     *
     * @param [int] $data
     *
     * @return void
     */
    public function delete($data)
    {
        $p = $this->tree;

        // 先找到数据
        while ($p != null && $p->data != $data) {
            $pp = $p;
            if ($data > $p->data) {
                $p = $p->right;
            } else {
                $p = $p->left;
            }
        }
        if ($p == null) {
            return;
        }

        // 情况1：要删除的节点有两个子节点，找到右侧的最小子节点，将其替换为当前要删除的节点
        // 然后再将最小节点删除
        if ($p->left != null && $p->right != null) {
            $minP = $p->right;
            while ($minP->left != null) {
                // 最小子节点的上一级
                $minPP = $minP;
                $minP = $minP->left;
            }
            // 当前节点等于最小节点
            $p->data = $minP->data;
            // 删除最小节点
            $minPP->left = null;
        } else if ($p->left != null || $p->right != null) { // 情况2：仅有一个子节点，子节点上移，删除当前节点
            // 右子节点
            if ($p->right != null) {
                // 当前节点等于子节点

                $p->data = $p->right;
                // 节点设置为空
                $p->right = null;
            } else { // 左子节点
                $p->data = $p->left;
                $p->left = null;
            }
        } else { // 没有子节点，当前节点删除，父节点指针为 null
            $pp->data = $p->data;
            $p->data = null;
            $pp->left = null;
            $pp->right = null;
        }
    }

    /**
     * 前序遍历
     *  对于树中的任意节点来说，先打印这个节点，然后再打印它的左子树，最后打印它的右子树。
     *
     * @return void
     */
    public function preEach($tree)
    {
        if ($tree == null) {
            return;
        }

        echo $tree->data . '>';

        $this->preEach($tree->left);
        $this->preEach($tree->right);
    }

    /**
     * 遍序遍历
     *
     * @param [int] $tree
     *
     * @return void
     */
    public function midEach($tree)
    {
        if ($tree == null) {
            return;
        }

        $this->midEach($tree->left);
        echo $tree->data . '>';
        $this->midEach($tree->right);
    }

    /**
     * 后续遍历
     *
     * @param [int] $tree
     *
     * @return void
     */
    public function rightEach($tree)
    {
        if ($tree == null) {
            return;
        }

        $this->rightEach($tree->left);

        $this->rightEach($tree->right);
        echo $tree->data . '>';
    }
}

class Node
{
    public $data;
    public $left;
    public $right;

    public function __construct($data)
    {
        $this->data = $data;
    }
}

$rs = new BinarySearchTree();
$rs->insert(33);
$rs->insert(16);
$rs->insert(50);
$rs->insert(13);
$rs->insert(18);
$rs->insert(34);
$rs->insert(58);
$rs->insert(15);
$rs->insert(17);
$rs->insert(25);
$rs->insert(19);
$rs->insert(27);
$rs->insert(51);
$rs->insert(66);
$rs->insert(55);

$rs->midEach($rs->tree);
