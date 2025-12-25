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


    for ($i = 0; $i < $n; $i++)
    {
        for ($j = 0; $j < $n; $j++)
        {
            if(can_fork($matrix, $i, $j))
                $cnt += 1;
        }
    }
    return $cnt;
}


$result = main($input);