<?php

$ex_time_start	=	microtime(true);

require 'vendor/autoload.php';
require 'config.php';

// Instantiate the twilio client
$twilio	=	new Services_Twilio(TW_ACCOUNT_SID, TW_SECRET_KEY);

// Create an array to hold the recordings map
$recordings	=	array();

// Get all the audio recordings for an account
if( count($twilio->account->recordings->getPage(0,50)) > 0 ) {

	foreach( $twilio->account->recordings->getPage(0,50)->getIterator() as $r ) {
	
		// Map the recording SID to the existing audio URL
		$recordings[]	=	array( 'sid' => $r->sid, 'old' => 'http://api.twilio.com'. $r->uri .'.mp3' );
		
		$filename	=	'audio/'. $r->sid .'.mp3';
		
		file_put_contents('audio/'. $r->sid .'.mp3', fopen("http://api.twilio.com". $r->uri, 'r'));
		
	}
	
}

$ex_time_end	=	microtime(true);
$execution_time = round($ex_time_end - $ex_time_start,2) . 's';

echo "Execution time: $execution_time\n"; // 116s

?>