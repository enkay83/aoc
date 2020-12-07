<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input) {
    $sum = 2020;
    $firstAmount = 0;
    $secondAmount = 0;

    foreach ($input as $amount) {
        $firstKey = $sum - (int) $amount;
        if ($secondKey = array_search($firstKey, $input)) {
            $firstAmount = (int)$amount;
            $secondAmount = $input[$secondKey];
            break;
        }
    }

    return $firstAmount * $secondAmount;
}

function part02(array $input) {
    $sum = 2020;
    $a = 0;
    $b = 0;
    $c = 0;

    for($i=0, $iMax = count($input); $i<= $iMax; $i++) {
        $sum -= ($a1 = array_shift($input));
        foreach ($input as $amount) {
            $firstKey = $sum - (int) $amount;
            if ($secondKey = array_search($firstKey, $input)) {
                $a = (int) $amount;
                $b = $input[$secondKey];
                $c = $a1;
                break;
            }
        }

        $sum = 2020;

    }

    return $a * $b * $c;
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
