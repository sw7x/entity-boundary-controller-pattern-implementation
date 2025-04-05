<?php
namespace App\DomainFactories;


use App\Entities\Movie;
use App\Entities\Theatre;
use App\Entities\Section;
use App\Entities\Seat;
use App\Entities\TheatreSession;
use App\Entities\MovieSchedule;



class MovieScheduleDomainFactory
{

	public function execute():MovieSchedule
   	{


      	$movieScheduleData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] . '/src/Data/movie-schedule.json');
      	//$movieScheduleData = jsonDataLoad('../../../src/Data/movie-schedule.json');
      	//var_dump($movieScheduleData);

      	$moviesData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/movies.json');
      	//var_dump($moviesData);

      	$theatresData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/theatres.json'); 
      	//var_dump($theatresData);

      	$sectionsData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/sections.json');
      	//var_dump($sectionsData);


      	$theatreSessionObjArr = [];
      	foreach ($movieScheduleData as $movieSchedule) {
			//var_dump($movieSchedule);

			//$today   = new \DateTime(); // Gets today's date
			//$today  = \DateTime::createFromFormat('Y/m/d', '2025/1/1');
      		$today   = \DateTime::createFromFormat('Y/m/d', '2025/1/17');
      		$toDate  = \DateTime::createFromFormat('Y/m/d', $movieSchedule['toDate']);

      		if ($today <= $toDate) {

      			$obj = searchJsonData($moviesData, 'name' ,$movieSchedule['movie']);
      			$mvovieObj = new Movie($obj['name'],$obj['year'],$obj['rating'],$obj['duration'],$obj['price']);

      			$obj2 = searchJsonData($theatresData, 'name' ,$movieSchedule['theatre']);
      			$theatreObj = new Theatre($obj2['name'],$obj2['address']);

      			$theatreSessionObjArr[] = new TheatreSession(
      				$mvovieObj, 
      				$theatreObj, 
      				$movieSchedule['startTime'], 
      				$movieSchedule['endTime'], 
      				$movieSchedule['fromDate'], 
      				$movieSchedule['toDate']
      			);

				/*
				foreach ($obj2['sections'] as $value) {
				$obj4 = searchJsonData($sectionsData, 'name' ,$value['sectionName']);
				$sectionObj = new Section($value['sectionName'],$obj4['price']);
				}
				*/
			}
		}


      	//var_dump($theatreSessionObjArr);

      	$movieSchedule = new MovieSchedule($theatreSessionObjArr);
      
		return $movieSchedule;
   

      

   }
}