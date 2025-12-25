<?php

function write($map)
{
    for ($i = 0; $i < count($map); $i++)
    {
        for ($j = 0; $j < count($map[$i]); $j++)
            echo $map[$i][$j] . " ";
        echo '<br/>';
    }
    echo '<br/>';
    echo '<br/>';
}

function calculate_paths(&$map, $n, $m)
{
    $start_pos = [0, (int)($n / 2) - 1];
    $active_beams = [];

    $cnt_split = 0;

    array_push($active_beams, $start_pos);

    while (count($active_beams) > 0)
    {
        $new_active_beams = [];
        while (count($active_beams) > 0)
        {
            $beam = array_shift($active_beams);
            $curr_x = $beam[0];
            $curr_y = $beam[1];

            if ($curr_x + 1 < $n)
            {
                if ($map[$curr_x + 1][$curr_y] == '^')
                {
                    $next_x = $curr_x + 1;
                    $next_y1 = $curr_y + 1;
                    $next_y2 = $curr_y - 1;

                    if ($next_y1 >= 0 && $next_y1 < $m)
                    {
                        array_push($new_active_beams, [$next_x, $next_y1]);
                        $map[$next_x][$next_y1] = '|';
                    }

                    if ($next_y2 >= 0 && $next_y2 < $m)
                    {
                        array_push($new_active_beams, [$next_x, $next_y2]);
                        $map[$next_x][$next_y2] = '|';
                    }

                    $cnt_split++;

                }
                elseif ($map[$curr_x + 1][$curr_y] == '.')
                {
                    $next_x = $curr_x + 1;
                    $next_y = $curr_y;
                    array_push($new_active_beams, [$next_x, $next_y]);
                    $map[$next_x][$next_y] = '|';
                }
                elseif ($map[$curr_x + 1][$curr_y] == '|')
                {
                    echo 'Beam over beam <br/>';
                }
                else
                    echo 'Error <br/>';
            }
        }
        $active_beams = $new_active_beams;
    }
    return $cnt_split;
}

function main($input)
{
    $lines = explode("\n", $input);
    $map = [];
    for ($i = 0; $i < count($lines); $i++)
    {
        $map[$i] = [];
        for ($j = 0; $j < strlen($lines[$i]); $j++)
            $map[$i][$j] = $lines[$i][$j];
    }
    $n = count($map);
    $m = count($map[0]);

    $cnt_split = calculate_paths($map, $n, $m);
    echo 'No. of splits: ' . $cnt_split . '<br/>';
    // write($map);

    $dp = [];
    for ($i = 0; $i < $n; $i++)
    {
        $dp[$i] = [];
        for ($j = 0; $j < $m; $j++)
            $dp[$i][$j] = 0;
    }

    for ($j = 0; $j < $m; $j++)
    {
        if ($map[$n - 1][$j] == '|')
            $dp[$n - 1][$j] = 1;
        else
            $dp[$n - 1][$j] = 0;
    }

    for ($i = $n - 2; $i >= 0; $i--)
    {
        for ($j = 0; $j < $m; $j++)
        {
            if ($map[$i][$j] == '|')
            {
                if ($i + 1 < $n && $map[$i + 1][$j] == '|')
                {
                    $dp[$i][$j] = $dp[$i + 1][$j];
                    continue;
                }

                if ($i + 1 < $n && $map[$i + 1][$j] == '^')
                {
                    if ($j - 1 >= 0)
                        $dp[$i][$j] += $dp[$i + 1][$j - 1];

                    if ($j + 1 < $m)
                        $dp[$i][$j] += $dp[$i + 1][$j + 1];
                }

            }
        }
    }
    // write($dp);

    echo $dp[1][(int)($n / 2) - 1];
    return $dp[1][(int)($n / 2) - 1];
}

$result = main($input);


// 1831<