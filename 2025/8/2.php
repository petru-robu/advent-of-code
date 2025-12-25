<?php

class Node
{
    public int $idx;
    public int $x;
    public int $y;
    public int $z;

    public function __construct(int $idx, int $x, int $y, int $z)
    {
        $this->idx = $idx;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }
}

class Edge
{
    public int $from;
    public int $to;
    public float $weight;

    public function __construct(int $from, int $to, float $weight)
    {
        $this->from = $from;
        $this->to = $to;
        $this->weight = $weight;
    }
}

function readInput($input)
{
    $lines = array_filter(array_map('trim', explode("\n", $input)));
    $nodes = [];
    $edges = [];
    $n = 0;

    foreach ($lines as $line)
    {
        $vals = explode(",", $line);
        $nodes[] = new Node($n, (int)$vals[0], (int)$vals[1], (int)$vals[2]);
        $n++;
    }

    for ($i = 0; $i < $n - 1; $i++)
    {
        for ($j = $i + 1; $j < $n; $j++)
        {
            $n1 = $nodes[$i];
            $n2 = $nodes[$j];

            $dx = $n2->x - $n1->x;
            $dy = $n2->y - $n1->y;
            $dz = $n2->z - $n1->z;

            $weight = sqrt($dx * $dx + $dy * $dy + $dz * $dz);
            $edges[] = new Edge($i, $j, $weight);
        }
    }

    return [$nodes, $edges];
}

function kruskal($nodes, $edges)
{
    $n = count($nodes);
    $parent = [];
    $rank = [];

    for ($i = 0; $i < $n; $i++) {
        $parent[$i] = $i;
        $rank[$i] = 0;
    }

    $find = function ($x) use (&$parent, &$find) {
        if ($parent[$x] !== $x) {
            $parent[$x] = $find($parent[$x]);
        }
        return $parent[$x];
    };

    $union = function ($a, $b) use (&$parent, &$rank, $find) {
        $ra = $find($a);
        $rb = $find($b);

        if ($ra === $rb) return false;

        if ($rank[$ra] < $rank[$rb]) {
            $parent[$ra] = $rb;
        } elseif ($rank[$ra] > $rank[$rb]) {
            $parent[$rb] = $ra;
        } else {
            $parent[$rb] = $ra;
            $rank[$ra]++;
        }
        return true;
    };

    // sort edges by distance
    usort($edges, function ($a, $b) {
        return $a->weight <=> $b->weight;
    });

    $components = $n;
    $lastFrom = null;
    $lastTo = null;

    foreach ($edges as $e) {
        if ($union($e->from, $e->to)) {
            $components--;
            $lastFrom = $e->from;
            $lastTo = $e->to;

            if ($components === 1) {
                break; // fully connected
            }
        }
    }

    $x1 = $nodes[$lastFrom]->x;
    $x2 = $nodes[$lastTo]->x;

    echo "Last connection: {$x1} and {$x2}<br/>";
    return $x1 * $x2;
}



function main($input)
{
    [$nodes, $edges] = readInput($input);
    return kruskal($nodes, $edges);
}

$result = main($input);