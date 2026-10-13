<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveController as AdminLeaveController;
use App\Http\Controllers\Employee\LeaveController as EmployeeLeaveController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Admin
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {

        // Employees (names stay employees.*)
        Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
        Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
        Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
        Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
        Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
        Route::post('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])->name('employees.destroy');

        // Leaves (names are admin.leaves.*)
        Route::get('/leaves', [AdminLeaveController::class, 'index'])->name('leaves.index');
        Route::patch('/leaves/{id}/approve', [AdminLeaveController::class, 'approve'])->name('leaves.approve');
        Route::patch('/leaves/{id}/reject', [AdminLeaveController::class, 'reject'])->name('leaves.reject');

    });

    // Employee
    Route::middleware('role:employee')->prefix('employee')->name('employee.')->group(function () {
        Route::get('/leaves', [EmployeeLeaveController::class, 'index'])->name('leaves.index');
        Route::get('/leaves/create', [EmployeeLeaveController::class, 'create'])->name('leaves.create');
        Route::post('/leaves', [EmployeeLeaveController::class, 'store'])->name('leaves.store');
    });
});

require __DIR__ . '/auth.php';
