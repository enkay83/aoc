<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input)
{
    $valid =0;
    foreach ($input as $passwordData) {
        $pwParts = explode(' ', $passwordData);
        $rule = explode( '-', $pwParts[0]);
        $needle = $pwParts[1][0];
        $password = $pwParts[2];
        $count = substr_count($password, $needle);

        if ($count >= $rule[0] && $count <= $rule[1]) {
            $valid++;
        }
    }

    return $valid;
}

function part02(array $input)
{
    $valid =0;
    foreach ($input as $passwordData) {
        $pwParts = explode(' ', $passwordData);
        $rule = explode( '-', $pwParts[0]);
        $needle = $pwParts[1][0];
        $password = $pwParts[2];
        $count = substr_count($password, $needle);

        $pos1 = (int)$rule[0] -1;
        $pos2 = (int)$rule[1] -1;
        $value1 = $password[$pos1];
        $value2 = $password[$pos2];

        if (($count > 1) && ($value1 === $needle && $value2 === $needle)) {
            continue;
        }

        if ($value1 === $needle || $value2 === $needle) {
            $valid++;
        }
    }

    return $valid;
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
