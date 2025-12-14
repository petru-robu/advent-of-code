<?php

function invalid($num)
{
    $str = (string)$num;
    for ($i = 1; $i < strlen($str); $i++)
    {
        $part = substr($str, 0, $i);
        $n = strlen($part);

        if (strlen($str) % $n != 0)
            continue;

        $ok = 1;
        for ($j = 0; $j < strlen($str); $j += $n)
        {
            if (substr($str, $j, $n) != $part)
            {
                $ok = 0;
                break;
            }
        }

        if ($ok)
        {
            // echo $num . " " . $part . "<br/>";
            return true;
        }

    }

    // echo $str . " " . $min_freq . "<br/>";
    return false;
}


$sum = 0;
$intervals = explode(",", trim($input));
foreach ($intervals as $intv)
{
    $tokens = explode("-", $intv);
    $st = $tokens[0];
    $dr = $tokens[1];

    for ($x = $st; $x <= $dr; $x++)
    {
        if (invalid($x))
            $sum += $x;
    }
}

$result = $sum;