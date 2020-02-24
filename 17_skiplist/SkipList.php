<?php
class SkipList
{
    /**
     * 链表
     */
    protected $node;

    public function __construct()
    {
        // 带头链表
        $this->node = new Node(-1);
    }

    public function find($val)
    {
        $node = $this->node;
        $rs = "-1";
        $count = count($node->next);
        for ($i = $count - 1; $i >= 0; $i--) {
            while (isset($node->next[$i]) && $node->next[$i]->val < $val) {
                $node = $node->next[$i];
                $rs .= sprintf("------>%s", $node->val);
            }
        }
        echo $rs;
        if (isset($node->next[0]) && $node->next[0]->val == $val) {
            echo "------>" . $val . "------>找到了" . PHP_EOL;
            return $node->next[0];
        } else {
            echo "------>未找到" . PHP_EOL;
            return null;
        }
    }

    /**
     * 删除某个值的节点
     * @param int $value
     */
    public function delete(int $value)
    {
        $p = $this->node;

        /**
         * 保存每一层离 value 最近的skipNode的对象
         */
        $update = [];

        $count = count($p->next);

        for ($i = $count - 1; $i >= 0; $i--) {
            while (isset($p->next[$i]) && $p->next[$i]->val < $value) {
                $p = $p->next[$i];
            }

            if (isset($p->next[$i]) && $p->next[$i]->val == $value) {
                $update[$i] = $p;
            }
        }

        /**
         * 循环update 数组 将节点的 向前指针 指向(-->) 向前向前 对象的指针
         */

        for ($i = $count - 1; $i >= 0; $i--) {
            if (isset($update[$i])) {

                $update[$i]->next[$i] = isset($update[$i]->next[$i]) ? $update[$i]->next[$i]->next[$i] : null;
            }
        }

    }

    public function insert($val)
    {
        // 获得索引层级
        $level = $this->getRandLevel();
        $node = $this->node;

        // 索引
        $indexs = [];
        for ($i = $level - 1; $i >= 0; $i--) {
            // 查找新节点应该插入的节点位置
            while (isset($node->next[$i]) && !is_null($node->next[$i]) && $node->next[$i]->val < $val) {
                // 指针下沉
                $node = $node->next[$i];
            }

            $indexs[$i] = $node;
        }

        $newNode = new Node($val);
        for ($i = 0; $i < $level; $i++) {
            // 新节点的指针指向上一个节点指针的位置
            $newNode->next[$i] = isset($indexs[$i]->next[$i]) ? $indexs[$i]->next[$i] : null;

            // 上一个节点的指针指向新节点
            $indexs[$i]->next[$i] = $newNode;
        }
    }

    public function printAll()
    {
        $node = $this->node->next;
        $count = count($node);
        for ($i = $count - 1; $i >= 0; $i--) {

            echo sprintf("-1------>%s------>", $node[$i]->val);

            $p = $node[$i]->next[$i];
            if (isset($p)) {
                while (isset($p)) {
                    echo $p->val;
                    echo "------>";
                    $p = isset($p->next[$i]) ? $p->next[$i] : null;
                }
            }

            echo 'NULL';
            echo PHP_EOL;
        }
    }

    /**
     * 随机获得插入新节点的层级
     *
     * @return int
     */
    public function getRandLevel()
    {
        $level = 1;

        //  mt_rand()返回1-10的随机数
        //  随机数 < 5的概率为 1/2 所以 level=2 的概率为 50%
        //  一直循环 每次 < 5的概率都为 1/2 所以 每一次的概率为 上一次的 50% eg.level=3 为 50% * 1/2 = 25%
        while (mt_rand(1, 10) < 5 && $level < 16) {
            $level += 1;
        }

        return $level;
    }

}

class Node
{

    public $val;

    public $next;

    public function __construct($val = null, $next = null)
    {
        $this->val = $val;
        $this->next = $next;
    }

    public function setNext($next)
    {
        $this->next = $next;
    }
}

$rs = new SkipList();
for ($i = 0; $i < 20; $i++) {
    $rs->insert($i);
}

$rs->printAll();
$rs->find(11);

$rs->delete(10);
$rs->printAll();
