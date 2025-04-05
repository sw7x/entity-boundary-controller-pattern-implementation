<?php
namespace App\Entities;

class Seat
{
    private int $seatNo;
    private ?bool $availability;

    public function __construct(int $seatNo, bool $availability=true)
    {
        $this->seatNo = $seatNo;
        $this->availability = $availability;
    }

    // Getters
    public function getSeatNo(): int
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
