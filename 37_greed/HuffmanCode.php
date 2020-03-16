<?php
class HuffmanCode
{
    /**
     * 霍夫曼 code
     *
     * @var array
     */
    public $huffManCode = [];

    /**
     * 压缩
     *
     * @param string $str
     *
     * @return void
     */
    public function encode(string $str)
    {

        // 构建统计字符串
        $arr = $this->GetCountStringBuilder($str);

        // 获得霍夫曼树
        $huffManTree = $this->getHuffManTree($arr);

        // 获得霍夫曼编码对照表
        $this->huffManCode = $this->getHuffManCode($huffManTree);

        // 将字符串转为霍夫曼二进制
        $code = '';
        for ($i = 0; $i < strlen($str); $i++) {
            $index = ord($str[$i]);
            $code .= $this->huffManCode[$index];
        }

        /**
         * 将二进制转为8位
         */
        $byte = [];
        for ($i = 0; $i < strlen($code); $i += 8) {
            if ($i + 8 > strlen($code)) {
                $byte[] = base_convert(substr($code, $i), 2, 8);
            } else {
                $byte[] = base_convert(substr($code, $i, 8), 2, 8);
            }
        }

        return implode($byte);
    }

    public function decode($bcode)
    {
        // 待完善
    }

    /**
     * 统计字符出现的次数，放入数组中
     *
     * @param string $str
     *
     * @return array
     */
    public function GetCountStringBuilder(string $str)
    {
        $len = strlen($str);
        $arr = [];
        for ($i = 0; $i < $len; $i++) {
            $index = ord($str[$i]);
            if (!isset($arr[$index])) {
                $arr[$index] = 1;
            } else {
                $arr[$index]++;
            }
        }
        return $arr;
    }

    /**
     * 获得赫夫曼 tree
     *
     * @param [array] $arr
     *
     * @return HuffmanCodeNode
     */
    public function getHuffManTree(array $arr)
    {
        $queue = [];
        foreach ($arr as $k => $val) {
            $node = new HuffmanCodeNode($k, $val);
            array_push($queue, $node);
        }
        while (count($queue) > 1) {
            sort($queue);
            $leftNode = array_shift($queue);
            $rightNode = array_shift($queue);

            $newNode = new HuffmanCodeNode(null, $leftNode->weight + $rightNode->weight);
            $newNode->left = $leftNode;
            $newNode->right = $rightNode;

            array_push($queue, $newNode);
        }
        return array_pop($queue);
    }

    /**
     * 生成赫夫曼编码
     *
     * @param HuffManCodeNode $node
     *
     * @return array
     */
    private function getHuffManCode(HuffManCodeNode $node)
    {
        $codes = [];
        $this->getHuffManCodeRecursion($node->left, 0, '', $codes);
        $this->getHuffManCodeRecursion($node->right, 1, '', $codes);

        return $codes;
    }

    /**
     * 递归的生成赫夫曼 code
     *
     * @param HuffManCodeNode $node
     * @param string $code
     * @param string $str
     * @param array $codes
     *
     * @return void
     */
    private function getHuffManCodeRecursion(HuffManCodeNode $node, string $code, $str = '', array &$codes)
    {
        $str = $str . $code;
        if (!is_null($node)) {
            if (is_null($node->val)) {
                $this->getHuffManCodeRecursion($node->left, 0, $str, $codes);
                $this->getHuffManCodeRecursion($node->right, 1, $str, $codes);
            } else {
                // 已经到达叶子节点
                $codes[$node->val] = $str;
            }
        }
    }

}

class HuffmanCodeNode
{

    /**
     * 权重
     *
     * @var int
     */
    public $weight = 0;

    /**
     * 值
     *
     * @var string
     */
    public $val = null;

    /**
     * 左子树
     *
     * @var HuffmanCodeNode
     */
    public $left = null;

    /**
     * 又子树
     *
     * @var HuffmanCodeNode
     */
    public $right = null;

    public function __construct($val, $weight)
    {
        $this->val = $val;
        $this->weight = $weight;
    }

    /**
     * 输出
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("Node [val=%s, weight=%s]\n", $this->val, $this->weight);
    }

    /**
     * 前序遍历
     *
     * @return void
     */
    public function preOrder()
    {
        echo $this;
        if ($this->left != null) {
            $this->left->preOrder();
        }

        if ($this->right != null) {
            $this->right->preOrder();
        }
    }

}

$rs = new HuffmanCode();
$bcode = $rs->encode("iiiiiinihao123");
echo $bcode;
