<?php


function jsonDataLoad(string $filePath){
	$jsonData = file_get_contents($filePath);

	if ($jsonData === false) {
		die("Error: Unable to read JSON file.");
	}

	$data = json_decode($jsonData, true);

	if (json_last_error() !== JSON_ERROR_NONE) {
		die("Error decoding JSON: " . json_last_error_msg());
	}

	return($data);
}
