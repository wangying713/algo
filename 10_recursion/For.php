<?php

$gcIndex = 0;
function test($index)
{
    global $gcIndex;
    $gcIndex++;
    if ($index >= 2) {
        return;
    }
    for ($i = $index; $i <= 2; $i++) {
        echo sprintf("i=%s, index=%s\n", $i, $index);
        test($i + 1);
    }

}

test(0);
