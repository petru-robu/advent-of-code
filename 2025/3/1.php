<?php
$banks = explode("\n", trim($input));
//var_dump($banks);

$sum = 0;
foreach ($banks as $bank)
{   
    $bank = trim($bank);

    $maxVal1 = -1;
    $maxPos1 = -1;
    for($i = 0; $i < strlen($bank); $i++)
    { 
        // find max value
        if((int)$bank[$i] > $maxVal1)
        {
            $maxVal1 = (int)$bank[$i];
            $maxPos1 = $i;
        }
    }   
    if($maxPos1 === strlen($bank) - 1)
    {
        // echo 'Here';
        // if maxVal is last, find maxVal again excluding last
        $maxVal1 = -1;
        $maxPos1 = -1;
        for($i = 0; $i < strlen($bank)-1; $i++)
        { 
            if((int)$bank[$i] > $maxVal1)
            {
                $maxVal1 = (int)$bank[$i];
                $maxPos1 = $i;
            }
        }   
    }

    // find second digit
    $maxVal2 = -1;
    $maxPos2 = -1;
    for($i = $maxPos1 + 1; $i < strlen($bank); $i++)
    { 
        // find max value
        if((int)$bank[$i] > $maxVal2)
        {
            $maxVal2 = (int)$bank[$i];
            $maxPos2 = $i;
        }
    }

    $val = (int)($bank[$maxPos1] . $bank[$maxPos2]);
    $sum += $val;
}


$result = $sum;