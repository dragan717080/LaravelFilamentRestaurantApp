<?php

namespace App\Data;

$namesPath = __DIR__ . '\\' . 'names.json';
$surnamesPath = __DIR__ . '\\' . 'surnames.json';

// Read JSON file content
$jsonContent = file_get_contents($namesPath);

// Parse JSON content
$data = json_decode($jsonContent, true);

print_r(array_slice($data, 0, 100));
