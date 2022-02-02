<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SpaController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetObjectController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeRealizationController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\RealizationController;


//Route::get('/{any}', [SpaController::class, 'index'])->where('any', '.*');

Route::group(['prefix' => 'account'], function (){
    
    Route::get('show', [AccountController::class, 'show'])
        ->name('account.show');
    
    Route::post('store', [AccountController::class, 'store'])
        ->name('account.store');
    
    Route::post('update', [AccountController::class, 'update'])
        ->name('account.update');
    
    Route::get('delete', [AccountController::class, 'delete'])//post or get
        ->name('account.delete');
});

Route::group(['prefix' => 'asset'], function (){
    
    Route::get('show', [AssetController::class, 'show'])
        ->name('asset.show');
    
    Route::post('store', [AssetController::class, 'store'])
        ->name('asset.store');
    
    Route::post('update', [AssetController::class, 'update'])
        ->name('asset.update');
    
    Route::get('delete', [AssetController::class, 'delete'])//post or get
        ->name('asset.delete');
});

Route::group(['prefix' => 'asset_object'], function (){
    
    Route::get('show', [AssetObjectController::class, 'show'])
        ->name('asset_object.show');
    
    Route::post('store', [AssetObjectController::class, 'store'])
        ->name('asset_object.store');
    
    Route::post('update', [AssetObjectController::class, 'update'])
        ->name('asset_object.update');
    
    Route::get('delete', [AssetObjectController::class, 'delete'])//post or get
        ->name('asset_object.delete');
});

Route::group(['prefix' => 'contract'], function (){
    
    Route::get('show', [ContractController::class, 'show'])
        ->name('contract.show');
    
    Route::post('store', [ContractController::class, 'store'])
        ->name('contract.store');
    
    Route::post('update', [ContractController::class, 'update'])
        ->name('contract.update');
    
    Route::get('delete', [ContractController::class, 'delete'])//post or get
        ->name('contract.delete');
});

Route::group(['prefix' => 'employee'], function (){
    
    Route::get('show', [EmployeeController::class, 'show'])
        ->name('employee.show');
    
    Route::post('store', [EmployeeController::class, 'store'])
        ->name('employee.store');
    
    Route::post('update', [EmployeeController::class, 'update'])
        ->name('employee.update');
    
    Route::get('delete', [EmployeeController::class, 'delete'])//post or get
        ->name('employee.delete');
});

Route::group(['prefix' => 'organization'], function (){
    
    Route::get('show', [OrganizationController::class, 'show'])
        ->name('organization.show');
    
    Route::post('store', [OrganizationController::class, 'store'])
        ->name('organization.store');
    
    Route::post('update', [OrganizationController::class, 'update'])
        ->name('organization.update');
    
    Route::get('delete', [OrganizationController::class, 'delete'])//post or get
        ->name('organization.delete');
});

Route::group(['prefix' => 'position'], function (){
    
    Route::get('show', [PositionController::class, 'show'])
        ->name('position.show');
    
    Route::post('store', [PositionController::class, 'store'])
        ->name('position.store');
    
    Route::post('update', [PositionController::class, 'update'])
        ->name('position.update');
    
    Route::get('delete', [PositionController::class, 'delete'])//post or get
        ->name('positions.delete');
});

Route::group(['prefix' => 'realization'], function (){
    
    Route::get('show', [RealizationController::class, 'show'])
        ->name('realization.show');
    
    Route::post('store', [RealizationController::class, 'store'])
        ->name('realization.store');
    
    Route::post('update', [RealizationController::class, 'update'])
        ->name('realization.update');
    
    Route::get('delete', [RealizationController::class, 'delete'])//post or get
        ->name('realization.delete');
});

Route::get('owner/{id}', [AccountController::class, 'accountOwner']);//post or get zwraca dane z emoloyee powiązane z account

Route::get('asset/listObjects/{id}', [AssetController::class, 'assetObjlist']); // pobieramy listę obiektów przypisanych do assetu

Route::get('myRealizations/{id}', [EmployeeRealizationController::class, 'getMyRealizations']); //pobiera realizacje z nazwami w kontrakcie przypisanych do uzytkownika

Route::get('assetobject/templates', [AssetObjectController::class, 'getAssetObjectTemplates']); //template properties w AssetObject zwraca content z pliku w storage/app/assetobject_templates.json

Route::get('eloquent/permission/{id}', [AccountController::class, 'permAccount']); // Eloquent
Route::get('qb/permission/{id}', [AccountController::class, 'myPermissions']);// QueryBuilder