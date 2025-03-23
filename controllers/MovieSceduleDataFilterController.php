<?php


include '../../utils/json.php';




class MovieSceduleDataFilterController{
	
   public function aaa()
   {
      echo '%***************&&&';
   }

   public function loadAllData()
   {

      $movieScheduleData = jsonDataLoad('../../data/movie-schedule.json');
      var_dump($movieScheduleData);
      
      $moviesData = jsonDataLoad('../../data/movies.json');
      var_dump($moviesData);

      $theatresData = jsonDataLoad('../../data/theatres.json'); 
      var_dump($theatresData);
      
      $theatreSectionsData = jsonDataLoad('../../data/theatre-sections.json');
      var_dump($theatreSectionsData);
      die();



      //movie data retrive from movies.json
      //theatre data retrive from theatres.json



/*    
"theatre": "Grand Cinema",
"movie": "Inception",
"startTime": "8:00",
"endTime": "9:30",
"fromDate": "2015/1/1",
"toDate": "2021/1/31"
*/

      

   }





	/*
   public function loadAllMovies(): void
   {
   
   }

   public function loadAllTheatres(): void
   {
   
   }


   public function loadTheatresByScreeningMovie(Movie): void
   {
   
      // load theatre with fromDate, toDate
   }
   
   public function loadMoviePlayingAtTheatre(Theatre): void
   {
      // load Movie with fromDate, toDate
   }





   

   public function loadTimeSlotsByMovie(): void
   {
   
   }

   public function loadTimeSlotsByTheatre(): void
   {
   
   }

   */



}