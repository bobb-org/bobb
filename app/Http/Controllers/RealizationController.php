<?php

namespace App\Http\Controllers;

use App\Http\Resources\RealizationResource;
use App\Models\Realization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RealizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
	{
		/* $realization = new Realization(); */
		/* $realization->fill($request->all()) */
		/* $realization->owner_id = $request->user()->id; */

		/* Autodesk\Auth\Configuration::getDefaultConfiguration() */
		/*    ->setClientId(env('FORGE_CLIENT_ID')) */
		/*    ->setClientSecret(env('FORGE_CLIENT_SECRET')); */

		/* $twoLeggedAuth = new Autodesk\Auth\OAuth2\TwoLeggedAuth(); */
		/* $twoLeggedAuth->setScopes( [ 'bucket:create', 'data:write', 'data:read' ] ); */

		/* $twoLeggedAuth->fetchToken(); */

		/* $tokenInfo = [ */
		/*    'accessToken' => $twoLeggedAuth->getAccessToken(), */
		/*    'expiry'           => time() + $twoLeggedAuth->getExpiresIn(), */
		/* ]; */
		/* $bucket_key = hash($request->post('name') . $request->post('owner_id') . time()); */
		/* 	$bucket_info = array( */
		/* 	  'bucket_key' => $bucket_key, */
		/* 	  'policy_key' => 'transient' */
		/* ); */
		/* $post_buckets = new \Autodesk\Forge\Client\Model\PostBucketsPayload($bucket_info); */
		/* $apiInstance = new Autodesk\Forge\Client\Api\BucketsApi($twoLeggedAuth); */
		/* try { */
		/* 	$result = $apiInstance->createBucket($post_buckets, $x_ads_region); */
		/* 	print_r($result); */
		/* } catch (Exception $e) { */
		/* 	error_log($e); */
		/* } */
		        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
