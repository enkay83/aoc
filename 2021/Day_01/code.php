<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input)
{
    $previous = null;
    $largerMeasurements = 0;
    $maxInput = count($input);

    for ($i = 0; $i + 1 <= $maxInput; $i++) {
        $current = (int)$input[$i];

        if ($previous === null) {
            $previous = $current;
            continue;
        }

        if ($current > $previous) {
            $largerMeasurements++;
        }

        $previous = $current;
    }

    return $largerMeasurements;
}

function part02(array $input)
{
    $previous = null;
    $largerMeasurements = 0;
    $maxInput = count($input);

    for ($i = 0; $i + 1 <= $maxInput; $i++) {
        $current = (int)$input[$i];
        if (isset($input[$i+1])) {
            $current += (int) $input[$i+1];
        }

        if (isset($input[$i+2])) {
            $current += (int) $input[$i+2];
        }

        if ($previous === null) {
            $previous = $current;
            continue;
        }

        if ($current > $previous) {
            $largerMeasurements++;
        }

        $previous = $current;
    }

    return $largerMeasurements;
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
