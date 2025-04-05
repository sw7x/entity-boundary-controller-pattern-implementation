<?php
namespace App\Controllers;

use App\DomainFactories\MovieBookingDomainFactory;
use App\Entities\Seat;
use App\Entities\Section;


class SeatAvailabilityCheckController{	
	
	
    public function __invoke(): array
    {
        
        /*inputs*/
        $movieTxt          = "Inception";
        $theatreTxt        = "Grand Cinema";
        $startTimeTxt      = "10:00";
        $endTimeTxt        = "11:30";
        $movieViewDateTxt  = '2025/1/18';
        $sectionTxt        = 'IMAX';
        $seatCountTxt      = 7;



        $movieBookingData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] . '/src/Data/ticket-booking.json');
        //dump($movieBookingData);

        // FILTER relevant BOOKINGS accirding to user request
        $filteredMovieBookings   = [];
        $reservedSeatsNoArr      = [];
        foreach ($movieBookingData as $movieBookingDataItem) {

           if(
                $movieBookingDataItem['movieName'] == $movieTxt &&
                $movieBookingDataItem['theatre']['name'] == $theatreTxt &&
                $movieBookingDataItem['theatre']['session']['startTime'] == $startTimeTxt &&
                $movieBookingDataItem['theatre']['session']['endTime'] == $endTimeTxt &&
                $movieBookingDataItem['theatre']['section'] == $sectionTxt &&
                $movieBookingDataItem['movieViewDate'] == $movieViewDateTxt
           ){
                $filteredMovieBookings[] =  $movieBookingDataItem;
                $reservedSeatsNoArr = array_merge($reservedSeatsNoArr, $movieBookingDataItem['theatre']['seats']);
           }
        }

        //dump($filteredMovieBookings);
        //dump($reservedSeatsNoArr);



        $theatresData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/theatres.json'); 
        //var_dump($theatresData);
        $theatreDataItem = searchJsonData($theatresData, 'name' ,$theatreTxt);
        //dump($theatreDataItem);

        $totSeatCount = null;
        foreach ($theatreDataItem['sections'] as $sectionArrItem) {
          if ($sectionArrItem['sectionName'] === $sectionTxt) {
              $totSeatCount = $sectionArrItem['seatCount'];
              break; // Stop searching once found
          }
        }
        //dump($totSeatCount);
        //dump('totSeatCount');

        // create seats for the section
        $seatsObjArr = [];
        for ($i=1; $i <= $totSeatCount; $i++) { 
           $availability  = in_array($i, $reservedSeatsNoArr) ? false : true;
           $seatsObjArr[] = new Seat($i, $availability);
        }

        //dump($seatsObjArr);


        // create seaction entity
        $sectionsData = jsonDataLoad($_SERVER['DOCUMENT_ROOT'] .'/src/Data/sections.json');
        //var_dump($sectionsData);
        $sectionDataItem = searchJsonData($sectionsData, 'section' ,$sectionTxt);
        if(empty($sectionDataItem))
           throw new \Exception("Invalid section");

        $sectionObj = new Section(
           $sectionTxt,
           $sectionDataItem['price'],
           $seatsObjArr
        );
        //dump($sectionObj);

        // check seat availability according to user request seat count
        $availableSeatsArr = $sectionObj->getAvailableSeatsByCount($seatCountTxt);
        return $availableSeatsArr;
        
    }
  
}