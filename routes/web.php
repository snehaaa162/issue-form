<?php

use Illuminate\Support\Facades\Route;
use IssueConnector\SubmissionFormConnector\Http\Controllers\IssueFormController;

Route::middleware(['web'])->group(function () {
    Route::get('/submit-issue', [IssueFormController::class, 'showForm']);
    Route::post('/submit-issue', [IssueFormController::class, 'submitForm']);
});