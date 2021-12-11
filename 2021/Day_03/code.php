<?php

require_once __DIR__ . '/../../lib/php/utils.php';

$input = readInput(__DIR__);

// Task code
function part01(array $input)
{
    $positionBucket = buildBuckets($input);

    $gammaRate = getGammaRate($positionBucket);
    $epsilonRate = getEpsilonRate($positionBucket);

    return $gammaRate * $epsilonRate;
}

function part02(array $input)
{
    $oxigenGeneratorRating = getRating($input);
    $co2ScrubberRating = getRating($input, false);

    return $oxigenGeneratorRating * $co2ScrubberRating;
}

function getRating(array $input, $mostCommon = true): int
{
    $position = 0;
    while(count($input) !== 1) {
        $input = filter($input, $position, $mostCommon);
        $position++;
    }

    return bindec($input[0]);
}

function filter(array $input, int $position = 0, $mostCommon = true): array
{
    $itemList = [];
    $buckets = buildBuckets($input);
    $buckOfBitAtPosition = $buckets[$position];
    $numbersCount = count($buckOfBitAtPosition);
    $sum = array_sum($buckOfBitAtPosition);
    $half = ($numbersCount/2);

    if ($mostCommon) {
        $bitToKeep = 1;
        if ($sum < $half) {
            $bitToKeep = 0;
        }
    } else {
        $bitToKeep = 0;
        if ($sum < $half) {
            $bitToKeep = 1;
        }
    }

    for($i=0; $i<= count($input)-1; $i++) {
        $charAtPosition = (int)substr($input[$i], $position, 1);
        if($charAtPosition === $bitToKeep) {
            $itemList[] = $input[$i];
        }
    }

    return $itemList;
}

function buildBuckets(array $input): array
{
    $positionBucket = [];
    for ($i = 0; $i <= count($input) - 1; $i++) {
        for ($j = 0; $j < strlen($input[$i]); $j++) {
            $position = $input[$i];
            $positionBucket[$j][] = $position[$j];
        }
    }

    return $positionBucket;
}

function getGammaRate(array $values)
{
    $rate = null;
    for ($i = 0; $i <= count($values) - 1; $i++) {
        $rate .= isLowCommon($values[$i]) ? 1 : 0;
    }

    return bindec($rate);
}

function getEpsilonRate(array $values)
{
    $rate = null;
    for ($i = 0; $i <= count($values) - 1; $i++) {
        $rate .= isLowCommon($values[$i]) ? 0 : 1;
    }

    return bindec($rate);
}

function isLowCommon($value): bool
{
    $valueSum = array_sum($value);
    $half = count($value) / 2;

    return ($valueSum < $half);
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
