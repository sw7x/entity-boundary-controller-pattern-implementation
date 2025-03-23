<?php

class Seat
{
    private string $seatNo;
    private bool $availability;

    public function __construct(string $seatNo, bool $availability)
    {
        $this->seatNo = $seatNo;
        $this->availability = $availability;
    }

    // Getters
    public function getSeatNo(): string
    {
        return $this->seatNo;
    }

    public function isAvailable(): bool
    {
        return $this->availability;
    }

    // Setters
    public function setAvailability(bool $availability): void
    {
        $this->availability = $availability;
    }

    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'seat_no' => $this->seatNo,
            'availability' => $this->availability,
        ];
    }
}

?>
