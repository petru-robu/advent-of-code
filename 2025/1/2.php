<?php
$lines = explode("\n", trim($input));

$cnt = 0;
$curr = 50;

foreach ($lines as $line) 
{
    $dir = $line[0];
    $val = (int)(substr($line, 1, strlen($line)-1));

    if($val === 0)
        continue;

    $no_clicks = 0;

    if($dir === 'L')
    {
        if($curr === 0)
            $no_clicks -= 1;

        $no_clicks += 1 + (int)(($curr - $val)*(-1) / 100);
        if($val < $curr)
            $no_clicks -= 1;

        
        while ($curr - $val < 0)
            $curr += 100;

        $endpos = ($curr - $val) % 100;
    }
    else
    {   
        $no_clicks += (int)(($curr + $val) / 100);
        $endpos = ($curr + $val) % 100;
    }

    $curr = $endpos;
    $cnt += $no_clicks;   
}
$result = $cnt;
