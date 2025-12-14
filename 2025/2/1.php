<?php

function invalid($str)
{
    if(strlen($str) %  2 == 1)
        return false;

    $left_half = substr($str, 0, (int)(strlen($str) / 2));
    $right_half = substr($str, (int)(strlen($str) / 2), (int)(strlen($str) / 2));

    // echo $left_half . " " . $right_half . "<br />";

    return ($left_half === $right_half);
}

$sum = 0;
$intervals= explode(",", trim($input));
foreach ($intervals as $intv)
{
    $tokens = explode("-", $intv);
    $st = $tokens[0];
    $dr = $tokens[1];

    for ($x = $st; $x <= $dr; $x++)
    {   
        if(invalid($x))
            $sum += $x;
    }   
}

$result = $sum;