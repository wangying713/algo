<?php
class HashTable
{

    private $table;

    private $size;

    private $use;

    public function __construct()
    {
        $this->table = new LinkedList();
    }

}

class LinkedList
{
    public $key;
    public $val;
    public $next;

    public function __construct($key, $val, $next)
    {
        $this->key = $key;
        $this->val = $val;
        $this->next = $next;
    }
}
