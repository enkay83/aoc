<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input)
{
    $depth = 0;
    $horizontal = 0;

    for($i = 0; $i <= count($input) -1; $i++ ){
        $data = explode(' ', $input[$i]);
        $type = trim($data[0]);
        $value = (int)$data[1];

        if ($type === 'forward'){
            $depth += $value;
        }

        if ($type === 'down'){
            $horizontal += $value;
        }

        if ($type === 'up'){
            $horizontal -= $value;
        }
    }

    return $depth * $horizontal;
}

function part02(array $input)
{
    $depth = 0;
    $horizontal = 0;
    $aim = 0;

    for($i = 0; $i <= count($input) -1; $i++ ){
        $data = explode(' ', $input[$i]);
        $type = trim($data[0]);
        $value = (int)$data[1];

        if ($type === 'forward'){
            $horizontal += $value;
            $depth += $aim * $value;
        }

        if ($type === 'down'){
            $aim += $value;
        }

        if ($type === 'up'){
            $aim -= $value;
        }
    }

    return $depth * $horizontal;
}

// Execute
calcExecutionTime();
$result01 = part01($input);
$result02 = part02($input);
$executionTime = calcExecutionTime();

writeln('Solution Part 1: ' . $result01);
writeln('Solution Part 2: ' . $result02);
writeln('Execution time: ' . $executionTime);

saveBenchmarkTime($executionTime, __DIR__);

// Task test
testResults(
    [], // Expected
    [$result01, $result02], // Result
);
