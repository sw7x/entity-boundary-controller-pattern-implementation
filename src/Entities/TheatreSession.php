<?php
namespace App\Entities;

class TheatreSession
{
    private Movie $movie;
    private Theatre $theatre;
    private string $startTime;
    private string $endTime;
    private ?string $fromDate;
    private ?string $toDate;

    public function __construct(
    	Movie $movie, 
    	Theatre $theatre, 
    	string $startTime, 
    	string $endTime, 
    	string $fromDate = null, 
    	string $toDate = null
    ){
        $this->movie = $movie;
        $this->theatre = $theatre;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    // Getters
    public function getMovie(): Movie
    {
        return $this->movie;
    }

    public function getTheatre(): Theatre
    {
        return $this->theatre;
    }

    public function getStartTime(): string
    {
        return $this->startTime;
    }

    public function getEndTime(): string
    {
        return $this->endTime;
    }

    public function getFromDate(): ?string
    {
        return $this->fromDate;
    }

    public function getToDate(): ?string
    {
        return $this->toDate;
    }

    // Setters
    public function setFromDate(string $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    public function setToDate(string $toDate): void
    {
        $this->toDate = $toDate;
    }



    // Check if a session is running on a given date
    public function isSessionRunningOn(string $date): bool
    {
        if(is_null($this->fromDate))
            throw new \Exception("no value is assign to fromDate !");            

        if(is_null($this->toDate))
            throw new \Exception("no value is assign to toDate !");


        // Convert strings to DateTime objects
        $dateObj        = new \DateTime($date);
        $fromDateObj    = new \DateTime($this->fromDate);
        $toDateObj      = new \DateTime($this->toDate);

        return $dateObj >= $fromDateObj && $dateObj <= $toDateObj;
    }

    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'movie' => $this->movie->toArray(),
            'theatre' => $this->theatre->toArray(),
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'from_date' => $this->fromDate,
            'to_date' => $this->toDate,
        ];
    }
}