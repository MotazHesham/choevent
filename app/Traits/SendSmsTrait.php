<?php

namespace App\Traits;

trait SendSmsTrait
{


    function sendSMS($number, $msg){

		try{
			$ch = curl_init();
		$url="https://www.qyadat.com/sms/api/sendsms.php?username=966591111024&password=1762020&message=".$msg."&numbers=".$number."&sender=CHOICES&unicode=e&return=json";
	
		curl_setopt($ch, CURLOPT_URL, $url);
	
		//return the transfer as a string
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
		// $output contains the output string
		$output = curl_exec($ch);
	
		// close curl resource to free up system resources
		curl_close($ch); 
		}catch(\Exception $e){
			dd($e->getMessage());
		}
		return $output;
}
	

}