<?php

class MovieBooking
{
    private TheatreSession $theatreSession;
    private Section $section;
    private array $seats = [];  // int[]
    private bool $paid;
    private DateTime $movieViewDate;

    private ?Customer $customer = null;
    private ?DateTime $paidDate = null;

    

    public function __construct(
        TheatreSession $theatreSession, 
        Section $section,
        array $seats, 
        bool $paid = false,
        DateTime $movieViewDate
    ) {
        $this->theatreSession = $theatreSession;
        $this->section = $section;
        $this->seats = $seats;        
        $this->paid = $paid;
        $this->movieViewDate = $movieViewDate;
    }

    // Getters
    public function getTheatreSession(): TheatreSession
    {
        return $this->theatreSession;
    }

    public function getSeat(): Seat
    {
        return $this->seat;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function getNumberOfTickets(): int
    {
        return count($this->seats);
    }

    public function getPaidDate(): ?DateTime
    {
        return $this->paidDate;
    }
    
    public function getMovieViewDate(): DateTime
    {
        return $this->movieViewDate;
    }
    
    public function isPaid(): bool
    {
        return $this->paid;
    }

    
    //Getters
    
    // Setter to update payment status
    public function setIsPaid(bool $paid): void
    {
        $this->paid = $paid;
    }

    public function setPaidDate(DateTime $paidDate): void
    {
        $this->paidDate = $paidDate;
    }


    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }




    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'theatre_session' => $this->theatreSession->toArray(),
            'section' => $this->section->toArray()
            'seats' => $this->seats,            
            'paid' => $this->paid,
            'movieViewDate' => $this->movieViewDate->format('Y-m-d'),

            'customer' => $this->customer ? $this->customer->toArray() : null,            
            'paid_date' => $this->paidDate ? $this->paidDate->format('Y-m-d') : null, // Format date
        ];
    }





    public function getMovie(): Movie
    {
        return $this->theatreSession->getMovie();
    }

    public function getTheatre(): Theatre
    {
        return $this->theatreSession->getTheatre();
    }

    public function getTimeSlot(): array
    {
        $session = $this->theatreSession;
        return [$session->getStartTime(), $session->getEndTime()];
    }


    //@return Seats[]
    public function getBookedSeats(): array
    {
        $seatNoArr = $this->seats;
        $bookedSeatsArr = [];
        foreach ($seatNoArr as $seatNo) {
            $bookedSeatsArr[] = $this->section->getSeatbyId($seatNo)
        }
        return $bookedSeatsArr;
    }


    public function ticketCount(): int
    {
        return count($seats);
    }


    public function perTicketCost(): int
    {
        $costForMovie   = $this->getMovie()->getPrice();
        $costForSeat    = $this->section->getSeatPrice();

        $singleTicketCost    = $costForMovie + $costForSeats;
        return $singleTicketCost;
    }




    public function bookingCost(): int
    {
        $ticketCount        = $this->ticketCount();
        $singleTicketCost   = $this->perTicketCost();

        $bookingCost    = $ticketCount * $singleTicketCost;
        return $bookingCost;
    }

}