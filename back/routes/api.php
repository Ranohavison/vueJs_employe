<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\EmployeController;

Route::apiResource('employes', EmployeController::class);


Route::get('/employes/check-numEmp/{numEmp}', [EmployeController::class, 'checkNumEmp']);
