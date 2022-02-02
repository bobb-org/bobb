<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Asset;
use App\Models\AssetObject;
use App\Http\Controllers\AccountController; //check perm

class AssetController extends Controller
{
/* public function __construct() */
    /* { */
        /* $this->middleware('auth'); */
    /* } */
    
    public function show()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3 || $userperm == 4){
            $assetList = Asset::all();
            return $assetList->toJson();
        }
        else
            return response(401);
    }

    public function store(Request $request)// poniżej jest uploadForge()
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $asset = new Asset;
            
            $asset->realization_id = $request->input('realization_id');
            $asset->autodesk_forge_urn = $request->input('autodesk_forge_urn');
            
            $asset->save();
            
            return redirect('/asset/show');
        }
        else
            return response(401);
    }

    public function update(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $assetid=$request->input('id');
            
            $asset = Asset::find($assetid);

            $asset->realization_id = $request->input('realization_id');
            $asset->autodesk_forge_urn = $request->input('autodesk_forge_urn');

            $asset->save();

            return redirect('/asset/show');
        }
        else
            return response(401);
    }

    public function delete(Request $request)
    {
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2){
            $assetid=$request->input('id');
            
            $asset = Asset::destroy($assetid);

            return redirect('/asset/show');
        }
        else
            return response(401);
    }

    public function assetObjList($id){
        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3 || $userperm == 4){
            $assetObj = Asset::with('assetObject')
                ->where('id','=', $id)
                ->get();

            return $assetObj->toJson();
        }
        else
            return response(401);
    }
	public function uploadForge(Request $request){
        $userperm = AccountController::checkPerm();
        if($userperm == 1  || $userperm == 2){
            $dir    = $request->input('dir');

            $myfilename = $request->input('filename');
        
            $date = new DateTime();
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
                $bucket_key = $myfilename.$date->getTimestamp();
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
                $filename = $dir.$myfilename; //!<< File/Object to be uploaded
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

                $asset = new Asset;
            
                $asset->realization_id = $request->input('realization_id');
                $asset->autodesk_forge_urn = $result['urn'];
                
                $asset->save();

                return redirect('/asset/show');
            }
            else
                return response(401);
    }

    public  function showForge(Request $request){

        $userperm = AccountController::checkPerm();
        if($userperm == 1 || $userperm == 2 || $userperm == 3 || $userperm == 4){
                \Autodesk\Auth\Configuration::getDefaultConfiguration()
                ->setClientId(env('FORGE_CLIENT_ID'))
                ->setClientSecret(env('FORGE_CLIENT_SECRET'));
            ///////////////////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
                $twoLeggedAuth = new \Autodesk\Auth\OAuth2\TwoLeggedAuth();
                $twoLeggedAuth->setScopes( [ 'data:write', 'data:read' ] );    //!<< This is dependent on what API you want to call.
        
                $twoLeggedAuth->fetchToken();
            ///////////////////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////////////////
                $tokenInfo = [
                'accessToken' => $twoLeggedAuth->getAccessToken(),
                'expiry'           => time() + $twoLeggedAuth->getExpiresIn(),
                ];
            /////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////
            $assetid=$request->input('id');
            
            $asset = Asset::find($assetid);

            $asseturn = $asset->autodesk_forge_urn;

            return ['urn' => $asseturn, 'token' => $twoLeggedAuth->getAccessToken()];
        }
        else
            return response(401);
    }
}
