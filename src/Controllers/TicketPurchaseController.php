<?php
namespace App\Controllers;

use App\Boundaries\BankPaymentService;
use App\Boundaries\PrinterService;
use App\Boundaries\TicketBookingDBGateway;

class TicketPurchaseController{
	

	public function purchase(string $customerName, string $customerPhone, array $seatsArray): void
   	{

	   	$bankPaymentService = new BankPaymentService();

	    if(!$bankPaymentService->checkCardAvailability()){
	        die('Inavalid card details');
	    }

	    if(!$bankPaymentService->checkout()){
	        die('Insufficient fund or Error');
	    }
	    
	    
		/*inputs*/
	    $movieTxt          = "Inception";
	    $theatreTxt        = "Grand Cinema";
	    $startTimeTxt      = "10:00";
	    $endTimeTxt        = "11:30";
	    $movieViewDateTxt  = '2025/1/18';
	    $sectionTxt        = 'IMAX';
	    $seatCountTxt      = 7;

	    $data = [
	        "movieName" => $movieTxt,
	        "customer" => [
	            "name"          => $customerName,//////////
	            "contactNumber" => $customerPhone//////////////
	        ],
	        "theatre" => [
	            "name"      => $theatreTxt,
	            "session"   => [
	                "startTime" => $startTimeTxt,
	                "endTime"   => $endTimeTxt
	            ],
	            //"seats"     => $seatsAvailable,
	            "seats"     => $seatsArray,////////////////////////
	            "section"   => $sectionTxt
	        ],
	        "paidDate"      => date("Y/m/d"),
	        "movieViewDate" => $movieViewDateTxt
	    ];



	    // Convert PHP array to JSON
	    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
	    dump($json);

	    // Save JSON to file
	    file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/src/Data/new-ticket-booking.json', $json);


	    $ticketBookingDBGateway = new TicketBookingDBGateway();
	    $ticketBookingDBGateway->insertData();


	    $printerService = new PrinterService();
	    $printerService->printTicket();


	    dump('OK');

   	}
  
    
}