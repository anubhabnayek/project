<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use App\Mail\LeaveStatusMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
class LeaveController extends Controller
{
    public function index()
    {
        $leaves = LeaveRequest::with('employee')->latest()->get();

        return view('admin.leave.index', compact('leaves'));
    }

    public function approve($id)
    {
        $leave = LeaveRequest::findOrFail($id);
        $leave->update([
            'status' => 'Approved',
            'rejection_reason' => null,
        ]);
        Mail::to($leave->employee->email)->send(
            new LeaveStatusMail(
                $leave,
                'Your leave application has been approved.'
            )
        );
        return back()->with('success', 'Leave approved successfully.');
    }

    public function reject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $leave = LeaveRequest::findOrFail($id);

        $leave->update([
            'status' => 'Rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);
        Mail::to($leave->employee->email)->send(
            new LeaveStatusMail(
                $leave,
                'Your leave application has been approved.'
            )
        );
        return back()->with('success', 'Leave rejected.');
    }
}
