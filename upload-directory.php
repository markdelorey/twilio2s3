<?php

$ex_time_start	=	microtime(true);

require 'vendor/autoload.php';
require 'config.php';

use Aws\S3\S3Client;

// Instantiate the S3 client with your AWS credentials
$s3 = S3Client::factory(array(
	'key'    => AWS_ACCESS_KEY,
	'secret' => AWS_SECRET_KEY,
));

$s3->registerStreamWrapper();

$s3->uploadDirectory('/Applications/MAMP/htdocs/twilio2s3/audio',S3_BUCKET_NAME);

$ex_time_end	=	microtime(true);
$execution_time = round($ex_time_end - $ex_time_start,2) . 's';

echo "Execution time: $execution_time\n"; // 44s

?>