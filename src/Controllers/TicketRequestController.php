<?php
namespace App\Controllers;

use App\Controllers\SeatAvailabilityCheckController;
use App\Controllers\TicketCostCalcController;





class TicketRequestController{
	
	
    
    public function requestTicket(): void
    {
        
        $checkSeatAvailability  = new SeatAvailabilityCheckController();
        $seatsAvailable         = $checkSeatAvailability();
        dump($seatsAvailable);
        $seatsAvailableString = implode(",", $seatsAvailable);

        if(!empty($seatsAvailable)){
            dump('Seats are available');
            $ticketCostCalc  = new TicketCostCalcController();
            $ticketCost      = $ticketCostCalc->calculate($seatsAvailable);
            dump('ticket Cost = '.$ticketCost);

            echo '
            <br>
            <form style="margin-left:100px" method="POST" action="">
                <label for="html">Ticket Cost</label>
                <input type="text" name="ticket_cost" readonly value="'.$ticketCost.'"><br><br> 


                <label for="html">Customer Name</label>
                <input type="text" name="customer_name" value=""><br><br> 


                <label for="html">Customer Phone</label>
                <input type="text" name="customer_phone" value=""><br><br> 

                <input type="hidden" name="seats" value="'.htmlspecialchars($seatsAvailableString).'" />

                <button type="submit" style="padding:2px 10px">Confirm Buy</button>
            </form>
            <br>
            ';

        }else{
            dump('Seat count is not available !');
        }   
    }
}