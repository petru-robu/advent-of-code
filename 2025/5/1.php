<?php

function cmp($a, $b)
{
    if ($a[0] == $b[0])
    {
        if ($a[1] == $b[1])
            return 0;
        return ($a[1] < $b[1]) ? -1 : 1;
    }

    return ($a[0] < $b[0]) ? -1 : 1;
}


function merge(&$intv)
{
    // sort the intervals
    usort($intv, "cmp");

    $new_intv = [];
    foreach ($intv as $curr)
    {
        if (count($new_intv) == 0)
        {
            array_push($new_intv, $curr);
            continue;
        }
        $last = end($new_intv);

        if ($last[1] >= $curr[0])
        {
            array_pop($new_intv);
            $new = [];
            $new[0] = min($curr[0], $last[0]);
            $new[1] = max($curr[1], $last[1]);
            array_push($new_intv, $new);
        }
        else
            array_push($new_intv, $curr);
    }

    $intv = $new_intv;
}


function parse($input, &$intv, &$queries)
{
    $lines = explode("\n", trim($input));

    foreach ($lines as $line)
    {
        $line = trim($line);
        if (strpos($line, "-"))
        {
            // interval
            $tok = explode("-", $line);
            array_push($intv, [(int)$tok[0], (int)$tok[1]]);
        }
        else if ($line)
            array_push($queries, (int)$line);
    }
}

function main($input)
{
    $intv = [];
    $queries = [];
    parse($input, $intv, $queries);
    merge($intv);

    // foreach ($intv as $x)
    //     echo '(' . $x[0] . ',' . $x[1] . ")<br/>";

    // foreach ($queries as $q)
    //     echo $q . '<br/>';


    $cnt = 0;
    foreach ($queries as $q)
    {
        foreach ($intv as $x)
        {
            if($q >= $x[0] && $q <= $x[1])
            {
                $cnt += 1;
                break;
            }  
        }
    }

    return $cnt;
}

$result = main($input);
