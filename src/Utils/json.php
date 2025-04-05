<?php


function jsonDataLoad(string $filePath){
	
	$jsonData = file_get_contents($filePath);
	//$jsonData = file_get_contents('./src/data/movie-schedule.json');

	if ($jsonData === false) {
		die("Error: Unable to read JSON file.");
	}

	$data = json_decode($jsonData, true);

	if (json_last_error() !== JSON_ERROR_NONE) {
		die("Error decoding JSON: " . json_last_error_msg());
	}

	return($data);
}



function searchJsonData($dataArr, $searchKey='name', $searchTerm) {
    $arr =  array_filter($dataArr, function ($dataItem) use ($searchKey, $searchTerm) {
        return stripos($dataItem[$searchKey], $searchTerm) !== false;
    });

    return !reset($arr)?[]:reset($arr);
}