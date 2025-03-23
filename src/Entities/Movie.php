<?php

class Movie
{
    private string $name;
    private int $year;
    private float $rating;
    private string $duration;
    private float $price;

    public function __construct(string $name, int $year, float $rating, string $duration, float $price)
    {
        $this->name = $name;
        $this->year = $year;
        $this->rating = $rating;
        $this->duration = $duration;
        $this->price = $price;
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getRating(): float
    {
        return $this->rating;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    
    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'year' => $this->year,
            'rating' => $this->rating,
            'duration' => $this->duration,
            'price' => $this->price,
        ];
    }
}