<?php
use Illuminate\Support\Facades\Route;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');//realization
Route::get('/homecreate', 'HomeController@create');
Route::post('/home', 'HomeController@store');

Route::get('/asset/{id_realization}', 'AssetController@index');//->name('asset');
Route::get('/assetshow/{id_realization}', 'AssetController@show');
Route::get('/assetcreate/{id_realization}', 'AssetController@create');
Route::post('/asset', 'AssetController@store');

Route::get('/role', 'RoleController@index');
Route::get('/rolecreate', 'RoleController@createuserforms');
Route::post('/roleshow', 'RoleController@showuser');
Route::post('/roleupdate', 'RoleController@updateuser');
Route::post('/rolecreate', 'RoleController@createuser');

Route::get('/memberaddform/{id_realization}', 'MemberController@creatememberforms');
Route::post('/memberadd', 'MemberController@store');


Route::get('/Forge', function () {
    $dir    = 'C:/xampp/htdocs/bobb/storage/app/public/uploads/';
    $files1 = preg_grep('~\.(dwg)$~', scandir($dir,1));
    return view('fileUpload', ['dir' => $dir], ['files1' => $files1]);
});
Route::get('file-upload', [FileUploadController::class, 'fileUpload'])->name('file.upload');
Route::post('file-upload', [FileUploadController::class, 'fileUploadPost'])->name('file.upload.post');
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
		$bucket_key = "myfilename1112";
		$bucket_info = array(
		'bucket_key' => $bucket_key,  //!<< Your bucket name which should be unique globally on the Forge Server
		'policy_key' => 'transient'  //!<< Bucket type that affects when stored files will be deleted from the bucket.
		);
		$post_buckets = new \Autodesk\Forge\Client\Model\PostBucketsPayload( $bucket_info );
		$x_ads_region = "US"; // string | The region where the bucket resides Acceptable values: `US`, `EMEA` Default is `US`
		try {
			$result = $apiInstance->createBucket($post_buckets, $x_ads_region);
			echo "CREATE BUCKET RESULT";
			echo "<br/>";
			print_r($result);
			echo "<br/>";
			echo "<br/>";
		} catch (Exception $e) {
			error_log($e);
			echo 'Exception when calling BucketsApi->createBucket: ', $e->getMessage(), PHP_EOL;
		}

	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////

		$obj_api_instance = new \Autodesk\Forge\Client\Api\ObjectsApi($twoLeggedAuth);
		$filename = '../storage/app/public/uploads/'.$myfilename; //!<< File/Object to be uploaded
		$body = $filename;
		$file = new \SplFileObject($body);
		$content_length = $file->getsize();   //!<< indicates the size of the request body.
		$object_name = $file->getfilename();  //!<< url-encoded object name
		try {
			$result = $obj_api_instance->uploadObject( $bucket_key, $object_name, $content_length, $body, null, null );
			echo "UPLOAD FILE RESULT";
			echo "<br/>";
			print_r( $result ); //!<< print file/object upload response from the data management api.
			echo "<br/>";
			echo "<br/>";
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
				echo "TRANSLATING API RESULT";
				echo "<br/>";
				print_r( $result );  //!<< Print job request response from the Model Derivative API.
				echo "<br/>";
				echo "<br/>";
			} catch( Exception $e ) {
				echo 'Exception when calling DerivativesApi->translate: ', $e->getMessage(), PHP_EOL;
			};
	///////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////
			try {
			$result = $derivatives_api->getManifest( $base64Urn, null );

			print_r( $result );  //!<< Print translation status from the Model Derivative API.
			echo 'Translation Status: ' . $result['status'];
			echo "\t\nTranslation Progress: " . $result['progress'];
			} catch( Exception $e ) {
			echo 'Exception when calling DerivativesApi->getManifest: ', $e->getMessage(), PHP_EOL;
			}
		echo<<<END
		<form action="/home">
		<input type="submit" value="Powrót" />
		</form>
		END;
		return view('forge', ['token' => $twoLeggedAuth->getAccessToken(), 'urn' => $result['urn']]);
	
});
//Route::get('/ForgeConnect/{choosefile}', 'ForgeController@ForgeConnect');

