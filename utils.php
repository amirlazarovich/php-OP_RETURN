<?php
/**
 * Utilities
 */

/**
 * Get last BTC value in USD according to www.bitstamp.net
 * 
 * @return [float] price
 */
function getLastBTCValueInUSD() {
	$ticker_url = 'https://www.bitstamp.net/api/ticker/';
	
	$request = curl_init();
	curl_setopt($request, CURLOPT_URL, $ticker_url);
	curl_setopt($request, CURLOPT_RETURNTRANSFER, true);

	$response = curl_exec($request);

	// check for errors
	if($response === FALSE){
	    die(curl_error($request));
	}

	// decode the response
	$responseData = json_decode($response, TRUE);

	// close connection
	curl_close($request);

	return $responseData['last'];
}

function getBTCValueForUSD($value, $precision=8) {
	$USDtoBTC = getLastBTCValueInUSD();

	return round($value / $USDtoBTC, $precision);
}