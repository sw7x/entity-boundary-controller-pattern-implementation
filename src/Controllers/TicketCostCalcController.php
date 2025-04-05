<?php
namespace App\Controllers;


use App\Entities\TheatreSession;
use App\Entities\MovieBooking;
use App\Entities\Section;
use App\Entities\Movie;
use App\Entities\Theatre;






class TicketCostCalcController{
	
	
	public function calculate(array $seatsArr): int	
   	{
   		/*inputs*/
        $movieTxt          = "Inception";
        $theatreTxt        = "Grand Cinema";
        $startTimeTxt      = "10:00";
        $endTimeTxt        = "11:30";
        $movieViewDateTxt  = '2025/1/18';
        $sectionTxt        = 'IMAX';
        $seatCountTxt      = 7;



        //create Section entity   
		$sectionsData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/sections.json');
        //var_dump($sectionsData);
        $sectionDataItem = searchJsonData($sectionsData, 'section' ,$sectionTxt);
        if(empty($sectionDataItem)){
           throw new \Exception("Invalid section");
        }
        $sectionObj = new Section($sectionTxt,$sectionDataItem['price']);
		

        //format movie View Date
      	$movieViewDate  		= \DateTime::createFromFormat('Y/m/d', $movieViewDateTxt);


        //create Movie entity   
      	$moviesData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/movies.json');
		//var_dump($moviesData);
		$obj = searchJsonData($moviesData, 'name' , $movieTxt);
		$mvovieObj = new Movie($obj['name'], $obj['year'], $obj['rating'], $obj['duration'], $obj['price']);


		//create Theatre entity
		$theatresData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/theatres.json'); 
		//var_dump($theatresData);
		$obj2 = searchJsonData($theatresData, 'name' , $theatreTxt);
		$theatreObj = new Theatre($obj2['name'], $obj2['address']);

		
		//create TheatreSession entity
		$theatreSessionObj = new TheatreSession(
			$mvovieObj,
			$theatreObj,
			$startTimeTxt,
			$endTimeTxt
		);





		$booking = new MovieBooking(
			$theatreSessionObj,
			$sectionObj,
			$seatsArr,
			false,
			$movieViewDate
		);

		$cost = $booking->bookingCost();
		//dump($cost);
		return $cost;
	}   
    
}