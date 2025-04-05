<?php
namespace App\Entities;

class MovieSchedule
{
    private array $theatreSessions = [];

    public function __construct(array $theatreSessions = [])
    {
        foreach ($theatreSessions as $session) {
            if (!$session instanceof TheatreSession) {
                throw new Exception("All elements must be instances of TheatreSession.");
            }
        }
        $this->theatreSessions = $theatreSessions;
    }

    // Add a single TheatreSession to the schedule
    public function addTheatreSession(TheatreSession $theatreSession): void
    {
        $this->theatreSessions[] = $theatreSession;
    }

    // Get all TheatreSessions
    public function getTheatreSessions(): array
    {
        return $this->theatreSessions;
    }

    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'theatre_sessions' => array_map(fn($session) => $session->toArray(), $this->theatreSessions),
        ];
    }




    public function getSessionsByMovieAndTheatre(Movie $givenMovie, Theatre $givenTheatre): array
    {
        return array_filter($this->theatreSessions, function (TheatreSession $session) use ($givenMovie, $givenTheatre) {
            $tempMovie      = $session->getMovie();
            $tempTheatre    = $session->getTheatre();
            
            return $tempMovie->getName === $givenMovie->getName && 
                $tempTheatre->getName === $givenTheatre->getName;
        });
    }


}