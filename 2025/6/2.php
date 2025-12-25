<?php
function main($input)
{
    $problems = [];
    $lines = explode("\n", $input);

    for ($i = 0; $i < count($lines); $i++) {
        $problems[$i] = str_split($lines[$i]);
    }

    $columns = [];

    for ($j = 0; $j < count($problems[0]); $j++) {
        $col = '';
        for ($i = 0; $i < count($problems); $i++) {
            $col .= $problems[$i][$j];
        }
        $columns[] = $col;
    }

    $total = 0;
    $op = null;
    $values = [];

    foreach (array_reverse($columns) as $line) {
        $line = trim($line);

        if ($line === '') {
            if ($op !== null) {
                $total += ($op === '*')
                    ? array_product($values)
                    : array_sum($values);
            }
            $op = null;
            $values = [];
            continue;
        }

        if ($line === '*' || $line === '+') {
            $op = $line;
        } else {
            $values[] = (int)$line;
        }
    }


    if ($op !== null) {
        $total += ($op === '*')
            ? array_product($values)
            : array_sum($values);
    }

    return $total;
}




$result = main($input);