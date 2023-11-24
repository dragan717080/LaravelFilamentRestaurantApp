<?php

namespace App\Data;

$jsonFilePath = __DIR__ . '\\' . 'ingredients.json';

// Read JSON file content
echo $jsonFilePath;
$jsonContent = file_get_contents($jsonFilePath);

// Parse JSON content
$data = json_decode($jsonContent, true);


print_r(array_slice($data, 0, 100));
