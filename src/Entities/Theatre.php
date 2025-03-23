<?php

class Theatre
{
    private string $name;
    private string $address;
    private array $sections = [];

    

    public function __construct(string $name, string $address, array $sections = [])
    {
        $this->name = $name;
        $this->address = $address;

        foreach ($sections as $section) {
            if (!$section instanceof Section) {
                throw new Exception("All elements must be instances of Section.");
            }
        }

        $this->sections = $sections;
    }





	// Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getSections(): array
    {
        return $this->sections;
    }

    
    // Convert object to an associative array
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'sections' => array_map(fn($section) => $section->toArray(), $this->sections),
        ];
    }

	
	public function getAvailableSections(): array
    {
        $availableSections = []; 
        foreach ($this->sections as $section) {
            if($section->haveSeats()){
                $availableSections[] = $section
            }
        }
        return $availableSections;         
    }
       
    public function getSectionByName(string $sectionName): ?Section
    {
        foreach ($this->sections as $section) {
            if($section->getName() === $sectionName){
                return $section;
            }
        }
        return null;
    }
    
}


