<?php

function can_fork($matrix, $i, $j)
{
    $n = count($matrix);

    $dirs = [
        [0, 1], [0, -1], [1, 0], [-1, 0],
        [1, 1], [1, -1], [-1, 1], [-1, -1]
    ];

    if ($matrix[$i][$j] === '@')
    {
        $adj_rolls_cnt = 0;

        for ($k = 0; $k < count($dirs); $k++)
        {
            $dir = $dirs[$k];

            $next_i = $i + $dir[0];
            $next_j = $j + $dir[1];

            if (
            $next_i >= 0 && $next_i < $n &&
            $next_j >= 0 && $next_j < $n &&
            $matrix[$next_i][$next_j] === '@'
            )
            {
                $adj_rolls_cnt++;
            }
        }

        if ($adj_rolls_cnt < 4)
            return true;
    }
}

function fork_and_del(&$matrix, &$cnt)
{
    $ok = false;
    $n = count($matrix);

    $to_del = [];
    for ($i = 0; $i < $n; $i++)
    {
        for ($j = 0; $j < $n; $j++)
        {
            if(can_fork($matrix, $i, $j))
                array_push($to_del, [$i, $j]);
        }
    }

    foreach($to_del as $pos)
    {
        $i = $pos[0];
        $j = $pos[1];

        $matrix[$i][$j] = '.';

        $ok = true;
        $cnt += 1;
    }

    return $ok;
}



function main($input)
{
    $lines = explode("\n", trim($input));
    $n = count($lines);
    $matrix = [];

    // build matrix
    for ($i = 0; $i < $n; $i++)
    {
        for ($j = 0; $j < $n; $j++)
        {
            $matrix[$i][$j] = $lines[$i][$j];
        }
    }

    $cnt = 0;
    while(fork_and_del($matrix, $cnt));
    return $cnt;
}

$result = main($input);