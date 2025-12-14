<?php
$lines = explode("\n", trim($input));

$cnt = 0;
$curr = 50;
foreach ($lines as $line) 
{
    $dir = $line[0];
    $val = (int)(substr($line, 1, strlen($line)-1));

    if($dir === 'L')
        $val *= -1;

    $curr  = (100 + $curr + $val) % 100;

    if($curr === 0)
        $cnt += 1;
}

$result = $cnt;
