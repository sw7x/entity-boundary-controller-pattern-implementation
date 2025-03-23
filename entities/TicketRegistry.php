<?php

class TicketRegistry
{
    private array $bookings;

    public function __construct(array $bookings = [])
    {
        foreach ($bookings as $booking) {
            if (!$booking instanceof MovieBooking) {
                throw new Exception("All elements must be instances of MovieBooking.");
            }

            if (!$booking->isPaid()) {
                throw new Exception("All MovieBooking needs to be paid ones");
            }

        }
        $this->bookings = $bookings;
    }

    // Add a single MovieBooking to the registry
    public function addBooking(MovieBooking $booking): void
    {
        $this->bookings[] = $booking;
    }

    // Get all bookings
    public function getAllBookings(): array
    {
        return $this->bookings;
    }



    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'total_bookings' => $this->getTotalBookings(),
            'bookings' => array_map(fn($booking) => $booking->toArray(), $this->bookings),
        ];
    }



    // Get total number of bookings  
    public function getTotalBookingCount(): int
    {
        return count($this->bookings);
    }

        

    /*
    // Get all bookings for a specific customer
    public function getBookingsByCustomer(string $customerName): array
    {
        return array_filter(
            $this->bookings,
            fn($booking) => $booking->getCustomer()->getName() === $customerName
        );
    }
    */


    // Get bookings within a specific date range
    public function getBookingsByDateRange(DateTime $startDate, DateTime $endDate): array
    {
        return array_filter(
            $this->bookings,
            fn($booking) => $booking->getBookedDate() >= $startDate && $booking->getBookedDate() <= $endDate
        );
    }




}


