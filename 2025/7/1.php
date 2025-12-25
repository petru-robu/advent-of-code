<?php

function write($map)
{
    for ($i = 0; $i < count($map); $i++)
    {
        for ($j = 0; $j < count($map[$i]); $j++)
            echo $map[$i][$j] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"; 
        echo '<br/>';
    }   
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

    // write($map);

    $n = count($map);

    // echo $map[0][(int)($n/2)-1];

    $start_pos = [0, (int)($n/2)-1];
    $active_beams = [];

    $cnt_split = 0;

    array_push($active_beams, $start_pos);

    while(count($active_beams) > 0)
    {
        $new_active_beams = [];
        while(count($active_beams) > 0)
        {
            $beam = array_shift($active_beams);
            $curr_x = $beam[0];
            $curr_y = $beam[1];

            if($curr_x + 1 < $n)
            {
                if($map[$curr_x + 1][$curr_y] == '^')
                {
                    $next_x = $curr_x + 1;
                    $next_y1 = $curr_y + 1;
                    $next_y2 = $curr_y - 1;
                    
                    $cols = count($map[0]);

                    if($next_y1 >= 0 && $next_y1 < $cols)
                    {
                        array_push($new_active_beams, [$next_x, $next_y1]);
                        $map[$next_x][$next_y1] = '|';
                    }
                        

                    if($next_y2 >= 0 && $next_y2 < $cols)
                    {
                        array_push($new_active_beams, [$next_x, $next_y2]);
                        $map[$next_x][$next_y2] = '|';
                    }
                        
                    $cnt_split ++;

                }
                elseif($map[$curr_x + 1][$curr_y] == '.')
                {
                    $next_x = $curr_x + 1;
                    $next_y = $curr_y;
                    array_push($new_active_beams, [$next_x, $next_y]);
                    $map[$next_x][$next_y] = '|';
                }
                elseif($map[$curr_x + 1][$curr_y] == '|')
                {
                    echo 'Beam over beam <br/>';
                }
                else
                {
                    echo 'Error <br/>';
                }
                
            }
        }
        $active_beams = $new_active_beams;
        // write($map);
        // echo $cnt_split;
        // echo "<br/><br/><br/><br/>";   
    }

    
    return $cnt_split;

}

$result = main($input);


// 1831<