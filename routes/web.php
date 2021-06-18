<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FileUploadController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $dir    = 'C:/xampp/htdocs/bobb/storage/app/public/uploads/';
    $files1 = preg_grep('~\.(dwg)$~', scandir($dir,1));
    return view('fileUpload', ['dir' => $dir], ['files1' => $files1]);
});

Route::get('file-upload', [FileUploadController::class, 'fileUpload'])->name('file.upload');
Route::post('file-upload', [FileUploadController::class, 'fileUploadPost'])->name('file.upload.post');

Route::get('/cos',function(){
	$token='eyJhbGciOiJSUzI1NiIsImtpZCI6IlU3c0dGRldUTzlBekNhSzBqZURRM2dQZXBURVdWN2VhIn0.eyJzY29wZSI6WyJidWNrZXQ6Y3JlYXRlIiwiZGF0YTp3cml0ZSIsImRhdGE6cmVhZCJdLCJjbGllbnRfaWQiOiJXc08xeXVLTnNHWDhQSjZTcUV0UGZJRzhTNDl6bWdCTiIsImF1ZCI6Imh0dHBzOi8vYXV0b2Rlc2suY29tL2F1ZC9hand0ZXhwNjAiLCJqdGkiOiJtUmR4YTUxb3QyRm1Fb1RnMlFONnFuOENWejZ0V0lnaTBnMmt2cWVpS3RSM2tGREF1cEo4SXV5eFZLalZNTTZRIiwiZXhwIjoxNjI0MDIxOTk0fQ.VnSNHdVGdthOrVaBNmLOWkfDp438FR8ERyCU-q6DKXl6E4bTNuks9MJIRNl3Xyq-szAKnstA4R_WKKY4HBfeISY9GYfVmmbqwTQFn8Fm6UcPfCByG5tm6cm1_IWiKRXq1tQMOqoxbN2wdM2DNvn0wcracNgYHjUaTFFAfg3EYlXIy3vvafvTX57X-f3Y_P5OtXg2tRYTepcOOuRYnteDbAbnVE5Qf5XBiJRpWYKWCODFPZ6wQ9Wa2iHGb3ETIQ1drws45u3-znzKQH4p-0__XyyDvDK1mYE8K78tPJt2beIP91thsaZlCUPcwE6TSMZeCmTfcmI2X83rEihau54fZQ';
	$urn='dXJuOmFkc2sub2JqZWN0czpvcy5vYmplY3Q6MTYyMzg0MjM4My5kd2cvMTYyMzg0MjM4My5kd2c';
	return view('welcome', ['token' => $token, 'urn' => $urn]);
});

Route::get('/ForgeConnect', function(){
	$dir    = 'C:/xampp/htdocs/bobb/storage/app/public/uploads/';

    $myfilename = $_GET['choosefile'];


///////////////////////////////////////////////////////////////////
	    \Autodesk\Auth\Configuration::getDefaultConfiguration()
	   ->setClientId(env('FORGE_CLIENT_ID'))
	   ->setClientSecret(env('FORGE_CLIENT_SECRET'));
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
	$twoLeggedAuth = new \Autodesk\Auth\OAuth2\TwoLeggedAuth();
	$twoLeggedAuth->setScopes( [ 'bucket:create', 'data:write', 'data:read' ] );    //!<< This is dependent on what API you want to call.

	$twoLeggedAuth->fetchToken();
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
	$tokenInfo = [
	   'accessToken' => $twoLeggedAuth->getAccessToken(),
	   'expiry'           => time() + $twoLeggedAuth->getExpiresIn(),
	];

	print_r($tokenInfo);
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
	$apiInstance = new \Autodesk\Forge\Client\Api\BucketsApi($twoLeggedAuth);
	$bucket_key = $myfilename;
	$bucket_info = array(
	  'bucket_key' => $bucket_key,  //!<< Your bucket name which should be unique globally on the Forge Server
	  'policy_key' => 'transient'  //!<< Bucket type that affects when stored files will be deleted from the bucket.
	);
	$post_buckets = new \Autodesk\Forge\Client\Model\PostBucketsPayload( $bucket_info );
	$x_ads_region = "US"; // string | The region where the bucket resides Acceptable values: `US`, `EMEA` Default is `US`
	try {
		$result = $apiInstance->createBucket($post_buckets, $x_ads_region);
		/*echo "CREATE BUCKET RESULT";
		echo "<br/>";
		print_r($result);
		echo "<br/>";
		echo "<br/>";*/
	} catch (Exception $e) {
		error_log($e);
		echo 'Exception when calling BucketsApi->createBucket: ', $e->getMessage(), PHP_EOL;
	}

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

	$obj_api_instance = new \Autodesk\Forge\Client\Api\ObjectsApi($twoLeggedAuth);
	$filename = '../storage/app/public/uploads/'.$myfilename; //!<< File/Object to be uploaded
	$body = $filename;
	$file = new SplFileObject($body);
	$content_length = $file->getsize();   //!<< indicates the size of the request body.
	$object_name = $file->getfilename();  //!<< url-encoded object name
	try {
		$result = $obj_api_instance->uploadobject( $bucket_key, $object_name, $content_length, $body, null, null );
		/*echo "UPLOAD FILE RESULT";
		echo "<br/>";
		print_r( $result );  //!<< print file/object upload response from the data management api.
		echo "<br/>";
		echo "<br/>";*/
		$urn = $result['object_id'];
		} catch( exception $e ) {
			echo 'exception when calling objectsapi->uploadobject: ', $e->getmessage(), PHP_EOL;
		}
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

		$base64Urn = rtrim( strtr( base64_encode( $urn ), '+/', '-_' ), '=' );
		$derivatives_api= new \Autodesk\Forge\Client\Api\DerivativesApi( $twoLeggedAuth );
		$jobInput = array(
		  'urn' => $base64Urn
		);
		$jobPayloadInput = new \Autodesk\Forge\Client\Model\JobPayloadInput( $jobInput );
		$jobOutputItem = array(
		  'type' => 'svf',
		  'views' => array('2d', '3d')
		);
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

		$jobPayloadItem = new \Autodesk\Forge\Client\Model\JobPayloadItem( $jobOutputItem );
		$jobOutput = [
		  'formats' => array( $jobPayloadItem )
		];
		$jobPayloadOutput = new \Autodesk\Forge\Client\Model\JobPayloadOutput( $jobOutput );
		$job = new \Autodesk\Forge\Client\Model\JobPayload();
		$job->setInput( $jobPayloadInput );
		$job->setOutput( $jobPayloadOutput );

		
		print_r($jobInput);
		$x_ads_force = true;
		try {
			$result = $derivatives_api->translate( $job, $x_ads_force );
			/*echo "TRANSLATING API RESULT";
			echo "<br/>";
			print_r( $result );  //!<< Print job request response from the Model Derivative API.
			echo "<br/>";
			echo "<br/>";*/
		} catch( Exception $e ) {
			echo 'Exception when calling DerivativesApi->translate: ', $e->getMessage(), PHP_EOL;
		};
///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////
		try {
		  $result = $derivatives_api->getManifest( $base64Urn, null );

		 /* print_r( $result );  //!<< Print translation status from the Model Derivative API.
		  echo 'Translation Status: ' . $result['status'];
		  echo "\t\nTranslation Progress: " . $result['progress'];*/
		} catch( Exception $e ) {
		  echo 'Exception when calling DerivativesApi->getManifest: ', $e->getMessage(), PHP_EOL;
		}
    echo<<<END
    <form action="/cos?">
    <input type="submit" value="Powrót" />
    </form>
    END;
	return view('welcome', ['token' => $twoLeggedAuth->getAccessToken(), 'urn' => $result['urn']]);
});
