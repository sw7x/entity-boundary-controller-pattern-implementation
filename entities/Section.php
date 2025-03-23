<?php

class Section
{
    private string $name;
    private float $seatPrice;
    private array $seats = [];

    public function __construct(string $name, float $seatPrice, array $seats = [])
    {
        $this->name = $name;
        $this->seatPrice = $seatPrice;

        // Ensure all elements in the array are instances of Seat
        foreach ($seats as $seat) {
            if (!$seat instanceof Seat) {
                throw new Exception("All elements must be instances of Seat.");
            }
        }

        // If no seats are provided, generate default seats
        if (!empty($seats)) {
            $this->seats = $seats;
        }
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getSeatPrice(): float
    {
        return $this->seatPrice;
    }  

    public function getSeats(): array
    {
        return $this->seats;
    }


        

    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'seat_price' => $this->seatPrice,
            'available_seats' => $this->getAvailableSeatsCount(),
            'seats' => array_map(fn($seat) => $seat->toArray(), $this->seats),
        ];
    }





    public function totalSeats(): int
    {
        return count($this->seats);
    }


    public function getSeatbyId(string $seatId): ?Seat
    {
        foreach ($this->seats as $seat) {
            if ($seat->getSeatNo() === $seatId) {
                return $seat;
            }
        }
        return null; // Seat not found
    }





    // Get all available seats
    public function getAvailableSeats(): array
    {
        return array_filter($this->seats, fn($seat) => $seat->isAvailable());
    }

    public function getAvailableSeatsCount(): int
    {
        return count(array_filter($this->seats, fn($seat) => $seat->isAvailable()));
    }

	public function getBookedSeatsCount(): int
    {
        return $this->totalSeats() - $this->getAvailableSeatsCount();
    }

	// Check if a specific seat is available
    public function checkIsSeatAvailableById(string $seatId): bool
    {
        foreach ($this->seats as $seat) {
            if ($seat->getSeatNo() === $seatId) {
                return $seat->isAvailable();
            }
        }
        return false; // Seat not found
    }

   



    // Book a specific seat
    public function bookSeat(string $seatId): bool
    {
        foreach ($this->seats as $seat) {
            if ($seat->getSeatNo() === $seatId && $seat->isAvailable()) {
                $seat->setAvailability(false);
                return true; // Successfully booked
            }
        }
        return false; // Seat unavailable or not found
    }


    



    public function getAvailableSeatsByCount(int $count): array
    {
        $availableSeats = array_filter($this->seats, fn($seat) => $seat->isAvailable());
        
        if($count > count($availableSeats)){
            return [];
        }else{
            // Limit the results to the requested count
            return array_slice($availableSeats, 0, $count);
        }        
    }




    

}




