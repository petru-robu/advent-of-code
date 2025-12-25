<?php

function main($input)
{
    $problems = [];
    $lines = explode("\n", $input);

    for ($i = 0; $i < count($lines) - 1; $i++)
    {
        $line = trim($lines[$i]);
        $nums = explode(" ", $line);

        $problems[$i] = [];
        foreach ($nums as $num)
            if(is_numeric($num))
                array_push($problems[$i], (int)$num);
    }
    

    $operations = explode(" ", trim(end($lines)));
    $new_op = [];
    for($i = 0; $i < count($operations); $i++)
    {
        if($operations[$i] == '*' || $operations[$i] == '+')
            array_push($new_op, $operations[$i]);
    }
    $operations = $new_op;

    // var_dump($operations);

    $res = 0;
    for ($j = 0; $j < count($problems[0]); $j++)
    {
        $curr_op = $operations[$j];

        $ans_pb = 0;
        if ($curr_op == '*')
            $ans_pb = 1;
        // echo $curr_op . ' ';
        for ($i = 0; $i < count($problems); $i++)
        {
            echo $problems[$i][$j] . ' ';
            if ($curr_op == '+')
                $ans_pb += $problems[$i][$j];
            else if ($curr_op == '*')
                $ans_pb *= $problems[$i][$j];
        }
        $res += $ans_pb;

        // echo $ans_pb . '<br />';
    }

    return $res;
}


$result = main($input);