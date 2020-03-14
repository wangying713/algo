<?php
/**
 * AC 自动机算法，全称是 Aho-Corasick 算法。其实，Trie 树跟 AC 自动机之间的关系，就像单串匹配中朴素的串匹配算法，跟 KMP 算法之间的关系一样，只不过前者针对的是多模式串而已。所以，AC 自动机实际上就是在 Trie 树之上，加了类似 KMP 的 next 数组，只不过此处的 next 数组是构建在树上罢了
 *
 * 核心思想
 *  1. 利用 tire 树的高效查询和 kmp 的思想（公共前缀/后缀）尽可能的移动多的位数
 *  2. 假设模式串为 her和 hers，在查找完 hers，不要回到 h 不分重新查找，在 r 的后面继续查找就好了
 *  3. 如果要实现2的思想，那么就需要实现 fail 指针，her 中的 r 的 fail 指针指向 s 从而实现高效查找
 *
 * 算法执行步骤
 *  1. 构建 tire 树，并标记位置
 *  2. 利用队列 BFS（广度优先策略或层级优先）构建 fail 树
 *  3. 利用 tire 树的查找策略，查找模式串
 *
 * 树的时间复杂度分析
 *  构建Tire树的复杂度
 *      O(m*len)，其中 len 表示敏感词的平均长度，m 表示敏感词的个数
 *  构建 fail 的指针
 *      假设 Trie 树中总的节点个数是 k，每个节点构建失败指针的时候，（你可以看下代码）
 *      最耗时的环节是 while 循环中的 q=q->fail，每运行一次这个语句，q 指向节点的深度都会减少 1，
 *      而树的高度最高也不会超过 len，所以每个节点构建失败指针的时间复杂度是 O(len)。整个失败指针的构建过程就是 O(k*len)。
 *
 *  ac 查找的复杂度：
 *      而这一部分的时间复杂度也是 O(len)，所以总的匹配的时间复杂度就是 O(n*len)。因为敏感词并不会很长，而且这个时间复杂度只是一个非常宽泛的上限，实际情况下，可能近似于 O(n)，所以 AC 自动机做敏感词过滤，性能非常高。
 * 本包不支持中文，不支持中文...
 */
class AcTire
{
    private $node;

    public function __construct()
    {
        $this->node = new AcTireNode('/');
    }

    /**
     * 构建 tire 树
     *
     * @param string $val
     *
     * @return void
     */
    public function insert($val)
    {
        $length = strlen($val);
        if ($length == 0) {
            false;
        }
        $node = $this->node;
        for ($i = 0; $i < $length; $i++) {
            $key = ord($val[$i]);
            if (!isset($node->children[$key])) {
                $newNode = new AcTireNode($val[$i]);
                $node->children[$key] = $newNode;
            }
            $node = $node->children[$key];

        }
        array_push($node->lengths, $length);
        $node->ending = true;
    }

    /**
     * 构建失败指针
     *
     * @return void
     */
    public function buildFailPointer()
    {
        // bfs 需要借助队列
        $queue = new SplQueue();
        $root = $this->node;

        // 先把最外层的 节点的fail指针都指向 root
        foreach ($root->children as &$val) {
            $val->fail = $root;
            $queue->enqueue($val);
        }

        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            if (is_null($node)) {
                continue;
            }

            // parent 指针
            $pfail = $node->fail;
            foreach ($node->children as &$val) {
                $index = ord($val->val);
                if (isset($pfail->children[$index])) {
                    $val->fail = $pfail->children[$index];
                    // 如果是结尾，追加 lengths
                    if ($val->fail->ending) {
                        foreach ($val->fail->lengths as $length) {
                            array_push($val->lengths, $length);
                        }
                    }
                } else {
                    $val->fail = $pfail;
                }

                $queue->push($val);
            }
        }
    }

    /**
     * 匹配
     *
     * @param [string] $text
     *
     * @return array
     */
    public function match($text)
    {
        $len = strlen($text);
        if ($len == 0) {
            return [];
        }
        $words = [];
        $node = $this->node;

        for ($i = 0; $i < $len; $i++) {
            $index = ord($text[$i]);

            if ($node->fail == null && !isset($node->children[$index])) {
                continue;
            }

            while ($node->fail != null && !isset($node->children[$index])) {
                $node = $node->fail;
            }

            $node = $node->children[$index];

            if (count($node->lengths) > 0) {

                foreach ($node->lengths as $wordlen) {
                    // 回退1位开始裁切
                    $word = substr($text, ($i + 1 - $wordlen), $wordlen);
                    array_push($words, $word);
                }
            }
        }
        return $words;
    }

    /**
     * 打印链表
     *
     * @param Node $node
     */
    function print() {
        $node = $this->node;
        $queue = new SplQueue();
        $queue->enqueue($node);

        $rs = '';
        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            $fail = $node->fail;
            if ($fail != null) {
                $fail = $node->fail->val;
            }
            $rs .= sprintf("val=%s, fail=%s\n", $node->val, $fail);

            foreach ($node->children as $val) {
                $queue->enqueue($val);
            }
        }
        echo rtrim($rs, ',') . "\n";
    }

}

class AcTireNode
{
    /**
     * val
     *
     * @var [string]
     */
    public $val;

    /**
     * 子节点hashmap
     *
     * @var array
     */
    public $children = [];

    /**
     * 失败指针
     *
     * @var [object]
     */
    public $fail;

    /**
     * 字符串是否结束或是节点
     *
     * @var bool
     */
    public $ending = false;

    /**
     * 当前匹配字符串的长度
     *
     * @var array
     */
    public $lengths = [];

    /**
     * 实例化
     *
     * @param [string] $val
     */
    public function __construct(string $val)
    {
        $this->val = $val;
    }
}

$rs = new AcTire();
$rs->insert('he');
$rs->insert('hers');
$rs->insert('his');
$rs->insert('she');

$rs->buildFailPointer();

$rs->print();
$words = $rs->match('ahishers');

var_dump($words);
