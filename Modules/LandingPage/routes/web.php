<?php

use Illuminate\Support\Facades\Route;
use Modules\LandingPage\Http\Controllers\AboutController;
use Modules\LandingPage\Http\Controllers\CompanyProfileController;
use Modules\LandingPage\Http\Controllers\ContactController;
use Modules\LandingPage\Http\Controllers\FaqController;
use Modules\LandingPage\Http\Controllers\LandingPageController;
use Modules\LandingPage\Http\Controllers\OrganizationController;
use Modules\LandingPage\Http\Controllers\PageController;
use Modules\LandingPage\Http\Controllers\RegulationController;

Route::get('/', [LandingPageController::class, 'index']);
route::get('/about', [LandingPageController::class, 'about']);
route::get('/event', [LandingPageController::class, 'event']);
route::get('/unit', [LandingPageController::class, 'unit']);


Route::get('/company-profile', [CompanyProfileController::class, 'index']);
Route::post('/company-profile', [CompanyProfileController::class, 'show']);
Route::get('/company-profile/{id}', [CompanyProfileController::class, 'ajax_edit'])->middleware('auth');
Route::post('/update-company-profile', [CompanyProfileController::class, 'update'])->middleware('auth');


Route::get('/page', [PageController::class, 'index'])->middleware('auth');
Route::post('/page', [PageController::class, 'save'])->middleware('auth');
Route::get('/page/{id}', [PageController::class, 'getEdit'])->middleware('auth');
Route::post('/page-update', [PageController::class, 'update'])->middleware('auth');
Route::delete('/page/{id}', [PageController::class, 'delete'])->middleware('auth');
Route::post('/get-page', [PageController::class, 'getList'])->middleware('auth');

Route::get('/regulation', [RegulationController::class, 'index'])->middleware('auth');
Route::post('/regulation', [RegulationController::class, 'save'])->middleware('auth');
Route::get('/regulation/{id}', [RegulationController::class, 'getEdit'])->middleware('auth');
Route::post('/regulation-update', [RegulationController::class, 'update'])->middleware('auth');
Route::delete('/regulation/{id}', [RegulationController::class, 'delete'])->middleware('auth');
Route::post('/get-regulation', [RegulationController::class, 'getList'])->middleware('auth');


Route::get('/organization', [OrganizationController::class, 'index'])->middleware('auth');
Route::post('/organization', [OrganizationController::class, 'save'])->middleware('auth');
Route::get('/organization/{id}', [OrganizationController::class, 'getEdit'])->middleware('auth');
Route::post('/organization-update', [OrganizationController::class, 'update'])->middleware('auth');
Route::delete('/organization/{id}', [OrganizationController::class, 'delete'])->middleware('auth');
Route::post('/get-organization', [OrganizationController::class, 'getList'])->middleware('auth');

Route::get('/faq', [FaqController::class, 'index'])->middleware('auth');
Route::post('/faq', [FaqController::class, 'save'])->middleware('auth');
Route::get('/faq/{id}', [FaqController::class, 'getEdit'])->middleware('auth');
Route::post('/faq-update', [FaqController::class, 'update'])->middleware('auth');
Route::delete('/faq/{id}', [FaqController::class, 'delete'])->middleware('auth');
Route::post('/get-faq', [FaqController::class, 'getList'])->middleware('auth');

Route::get('/contact', [ContactController::class, 'index'])->middleware('auth');
Route::post('/contact', [ContactController::class, 'save'])->middleware('auth');
Route::get('/contact/{id}', [ContactController::class, 'getEdit'])->middleware('auth');
Route::post('/contact-update', [ContactController::class, 'update'])->middleware('auth');
Route::delete('/contact/{id}', [ContactController::class, 'delete'])->middleware('auth');
Route::post('/get-contact', [ContactController::class, 'getList'])->middleware('auth');

Route::get('/company', [CompanyProfileController::class, 'index'])->middleware('auth');
Route::get('/company/getedit', [CompanyProfileController::class, 'getEdit'])->middleware('auth');
Route::post('/company-upload', [CompanyProfileController::class, 'upload'])->middleware('auth');
Route::post('/company', [CompanyProfileController::class, 'save'])->middleware('auth');

Route::get('/profile', [AboutController::class, 'index'])->middleware('auth');
Route::post('/profile', [AboutController::class, 'save'])->middleware('auth');
Route::get('/profile/{id}', [AboutController::class, 'getEdit'])->middleware('auth');
Route::post('/profile-update', [AboutController::class, 'update'])->middleware('auth');
Route::delete('/profile/{id}', [AboutController::class, 'delete'])->middleware('auth');
Route::post('/get-profile', [AboutController::class, 'getList'])->middleware('auth');