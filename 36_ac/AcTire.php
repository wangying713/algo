<?php
class AcTire
{

    public $root;

    public function __construct()
    {
        $this->root = new AcTireNode('/');
    }

    /**
     * 向 trie 树中插入一个字符串
     *
     * @param [type] $text
     *
     * @return void
     */
    public function insert($data)
    {
        $node = $this->root;
        $len = strlen($data);
        for ($i = 0; $i < $len; $i++) {
            // 假设不包括中文
            $k = ($data[$i]);
            if (!isset($node->children[$k])) {
                $newNode = new AcTireNode($data[$i]);
                $node->children[$k] = $newNode;
            }

            $node = $node->children[$k];
        }

        // 标记完全匹配的位置
        $node->isEndingChar = true;
    }

    public function buildFailurePointer()
    {
        $root = $this->root;
        $queue = new SplDoublyLinkedList();
        $queue->push($this->root);
        while (!$queue->isEmpty()) {
            $p = $queue->shift();

            echo "--------{$p->data}--------\n";
            foreach ($p->children as $k => &$pc) {

                echo sprintf("k=%s\n", $k);

                if ($pc == null) {
                    continue;
                }
                if ($p == $root) {
                    $pc->fail = $root;
                } else {
                    $q = $p->fail;
                    while ($q != null) {
                        $qc = isset($q->children[($pc->data)]) ? $q->children[($pc->data)] : null;
                        if ($qc != null) {
                            $pc->fail = $qc;
                            $pc->pcfkey = $qc->data;
                            break;
                        }

                        $q = $q->fail;
                    }

                    if ($q == null) {
                        $pc->fail = $root;
                    }
                }

                $queue->push($pc);
            }

        }

    }

}

class AcTireNode
{
    public $data;
    public $acNode = [];
    public $pcfkey = '/';

    // 失败指针
    public $fail;
    // 结尾字符为 true
    public $isEndingChar = false;

    // 当 isEndinghar=true 时，记录模式串的长度
    public $length = -1;

    public $children = [];

    public function __construct($data)
    {
        $this->data = $data;
    }
}
$rs = new AcTire();

$rs->insert('abcd');
$rs->insert('bcd');
$rs->insert('c');
$rs->buildFailurePointer();

print_r($rs);

die;
