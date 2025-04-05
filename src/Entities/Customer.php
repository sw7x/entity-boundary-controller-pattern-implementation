<?php
namespace App\Entities;

class Customer
{
    private string $name;
    private string $contactNumber;

    public function __construct(string $name, string $contactNumber)
    {
        $this->name = $name;
        $this->contactNumber = $contactNumber;
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getContactNumber(): string
    {
        return $this->contactNumber;
    }

    
    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'contact_number' => $this->contactNumber,
        ];
    }
}