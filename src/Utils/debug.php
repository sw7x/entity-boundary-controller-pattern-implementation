<?php

function dump($data){
	/*ini_set('xdebug.var_display_max_depth', 100);
	ini_set('xdebug.var_display_max_children', 512);
	ini_set('xdebug.var_display_max_data', 1024);*/

	ini_set("xdebug.var_display_max_children", -1);
	ini_set("xdebug.var_display_max_data", -1);
	ini_set("xdebug.var_display_max_depth", -1);

	var_dump($data);
}

function dd($data=null){
	/*ini_set('xdebug.var_display_max_depth', 100);
	ini_set('xdebug.var_display_max_children', 512);
	ini_set('xdebug.var_display_max_data', 1024);*/
	ini_set("xdebug.var_display_max_children", -1);
	ini_set("xdebug.var_display_max_data", -1);
	ini_set("xdebug.var_display_max_depth", -1);

	if(!is_null($data)){
		var_dump($data);
	}
	
	die();
}


function prettyPrint($data){	
    //echo "<pre>";
    //print_r($data,true);
    //echo "</pre>";
    //echo("<pre>".print_r($data,true)."</pre>");
    echo '<pre>' . json_encode($data, JSON_PRETTY_PRINT) . '</pre>';


}


