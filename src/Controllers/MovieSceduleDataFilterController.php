<?php

namespace App\Controllers;

/*
use App\Entities\Movie;
use App\Entities\Theatre;
use App\Entities\Section;
use App\Entities\Seat;
use App\Entities\TheatreSession;
use App\Entities\MovieSchedule;
*/


use App\DomainFactories\MovieScheduleDomainFactory;


class MovieSceduleDataFilterController{
	
   public function test()
   {
      echo '%***************&&&';
   }

   public function loadAllData():array
   {

      $MovieScheduleObj = (new MovieScheduleDomainFactory())->execute();
      $MovieScheduleObjArr = $MovieScheduleObj->toArray();
      $theatreSessions = reset($MovieScheduleObjArr);
      return $theatreSessions;
   }


   public function loadAllMovies(): array
   {
      $MovieScheduleObj = (new MovieScheduleDomainFactory())->execute();      
      $MovieScheduleArr = $MovieScheduleObj->toArray();
      $theatreSessions  = reset($MovieScheduleArr);

      $arr = [];
      foreach ($theatreSessions as $value) {
         $arr[] = $value['movie']['name'];
      }

      $uniqueMovies = array_values(array_unique($arr));
      return $uniqueMovies;
   }	
   

   public function loadAllTheatres(): array
   {
      $MovieScheduleObj = (new MovieScheduleDomainFactory())->execute();      
      $MovieScheduleArr = $MovieScheduleObj->toArray();
      $theatreSessions  = reset($MovieScheduleArr);
      
      $arr = [];
      foreach ($theatreSessions as $value) {
         $arr[] = $value['theatre']['name'];
      }

      $uniqueTheatres = array_values(array_unique($arr));
      return $uniqueTheatres;
   }






  
   public function loadTheatresByScreeningMovie(string $movieName): array
   {   
      $MovieScheduleObj = (new MovieScheduleDomainFactory())->execute();
      $MovieScheduleObjArr = $MovieScheduleObj->toArray();
      $theatreSessions = reset($MovieScheduleObjArr);

      $arr = [];
      foreach ($theatreSessions as $value) {
         if($value['movie']['name'] == $movieName){
            $arr[] = array(
               'theatre_name' => $value['theatre']['name'],
               'start_time'   => $value['start_time'],
               'end_time'     => $value['end_time'],
               'from_date'    => $value['from_date'],
               'to_date'      => $value['to_date']
            );
         }
      }
      
      $uniqueTheatres = array_values(array_unique($arr));
      return $uniqueTheatres;
   }


   public function loadMoviesPlayingAtTheatre(string $theatreName): array
   {
      $MovieScheduleObj = (new MovieScheduleDomainFactory())->execute();
      $MovieScheduleObjArr = $MovieScheduleObj->toArray();
      $theatreSessions = reset($MovieScheduleObjArr);

      $arr = [];
      foreach ($theatreSessions as $value) {
         if($value['theatre']['name'] == $theatreName){
            $arr[] = array(
               'movie_name' => $value['movie']['name'],
               'start_time' => $value['start_time'],
               'end_time'   => $value['end_time'],
               'from_date'  => $value['from_date'],
               'to_date'    => $value['to_date']
            );
         }
      }
      
      $uniqueMovies = array_values(array_unique($arr));
      return $uniqueMovies;
   }
   
}