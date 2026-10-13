<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLeaveRequest;
use App\Models\LeaveRequest;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $leave = LeaveRequest::latest()->get();
        return view('employee.leave.index', compact('leave'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.leave.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequest $request)
    {
        $leave = new LeaveRequest();
        $leave->employee_id = 2;
        $leave->leave_type = $request->leave_type;
        $leave->from_date = $request->from_date;
        $leave->to_date = $request->to_date;
        $leave->reason = $request->reason;
        $leave->status = 'pending';
        $leave->save();
        return redirect()
            ->route('employee.leaves.index')
            ->with('success', 'Leave apply successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
