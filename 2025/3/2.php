<?php
$banks = explode("\n", trim($input));;
$sum = 0;

foreach ($banks as $bank)
{   
    $bank = trim($bank);   
    $stack = new \Ds\Stack();   

    $k = strlen($bank) - 12;
    $st_size = 0;
    for($i = 0; $i < strlen($bank); $i++)
    {
        $curr = (int)$bank[$i];
        while($k > 0 && !$stack->isEmpty() && $curr > $stack->peek())
        {
            $stack->pop();
            $k -= 1;
        }

        $stack->push($curr);
    }

    $nums = $stack->toArray();
    $val = '';
    for($i=count($nums)-1; $i>=0; $i--)
        $val = $val . $nums[$i];

    $val = substr($val, 0, 12);
    // echo $val . '<br />';

    $sum += (int)$val;
}


$result = $sum;