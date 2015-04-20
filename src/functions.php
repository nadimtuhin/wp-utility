<?php

// view("test.php", ['first_name'=>'Tuhin']);
function view($file, $data){
	
	extract($data);

	ob_start();
	require $file;
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}



if(!function_exists('dd')){
	function dd($var){
		echo "<pre>";
		var_dump($var);
		die();
	}
}
if(!function_exists('pd')){
	function pd($var){
		echo "<pre>";
		print_r($var);
		die();
	}
}