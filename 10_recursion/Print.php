<?php
/**
 * 打印问题
 */
function print1($n)
{
    if ($n > 1) {
        print1($n - 1);
    }
    echo $n . "\n";
}

function factorial($n)
{
    if ($n == 1) {
        return 1;
    }

    return factorial($n - 1) * $n;
}

var_dump(factorial(9));

die;

print1(10);
