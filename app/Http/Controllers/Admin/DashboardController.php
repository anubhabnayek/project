<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // employee dahboard
        $employeeId = Auth::id();
        $totalLeaves = LeaveRequest::where('employee_id', $employeeId)->count();
        $ependingLeaves = LeaveRequest::where('employee_id', $employeeId)
            ->where('status', 'Pending')->count();

        $eapprovedLeaves = LeaveRequest::where('employee_id', $employeeId)
            ->where('status', 'Approved')->count();

        $erejectedLeaves = LeaveRequest::where('employee_id', $employeeId)
            ->where('status', 'Rejected')->count();
        //admin dahboard
        $totalEmployees = Employee::count();

        $approvedLeaves = LeaveRequest::where('status' , 'approved')->count();
        $rejectedLeaves = LeaveRequest::where('status', 'rejected')->count();
        $pendingLeaves = LeaveRequest::where(function ($q) {
            $q->whereNotIn('status', ['Approved', 'Rejected'])
                ->orWhereNull('status');
        })->count();
        if ($request->user()->role === 'admin') {

            return view('dashboard',compact('totalEmployees', 'approvedLeaves', 'rejectedLeaves', 'pendingLeaves'));
        }

        if ($request->user()->role === 'employee') {
            return view('employee_dashboard',compact('totalLeaves', 'ependingLeaves', 'eapprovedLeaves', 'erejectedLeaves'));
        }

        abort(403, 'Unauthorized access.');
    }
}
