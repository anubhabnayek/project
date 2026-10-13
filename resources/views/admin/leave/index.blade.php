@extends('layouts.app')

@section('title', 'Leave Requests')

@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Leave Requests</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Leave Requests</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="content">
    <div class="container-fluid">

        <!-- Success Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif

        <!-- Error Messages -->
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            @foreach($errors->all() as $error)
            <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif

        <div class="card">
            <!-- Card Header -->
            <div class="card-header">
                <h3 class="card-title">All Employee Leave Requests</h3>
            </div>
            <!-- Card Body -->
            <div class="card-body table-responsive">
                <table id="leaveTable" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>Leave Type</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Reason</th>
                            <th>Status</th>
                            <th>Rejection Reason</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($leaves as $leave)
                        {{-- Normalize status so "pending", "PENDING", " Pending ", NULL all work --}}
                        @php
                        $status = strtolower(trim((string) ($leave->status ?? '')));
                        if (!in_array($status, ['approved', 'rejected'])) {
                        $status = 'pending';
                        }
                        @endphp
                        <tr>
                            <td>{{ $leave->id }}</td>
                            <td>{{ $leave->employee->name ?? 'N/A' }}</td>
                            <td>{{ $leave->leave_type }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->from_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($leave->to_date)->format('d M Y') }}</td>
                            <td>{{ $leave->reason }}</td>
                            <!-- Status -->
                            <td>
                                @if($status === 'approved')
                                <span class="badge badge-success">Approved</span>
                                @elseif($status === 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                                @else
                                <span class="badge badge-warning">Pending</span>
                                @endif
                            </td>
                            <!-- Rejection Reason -->
                            <td>{{ $leave->rejection_reason ?? '-' }}</td>
                            <!-- Actions -->
                            <td class="text-nowrap">
                                @if($status === 'pending')
                                <div class="d-flex flex-row align-items-center">
                                    <form action="{{ route('admin.leaves.approve', $leave->id) }}"
                                        method="POST"
                                        class="mb-0 mr-1">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="btn btn-success btn-sm d-inline-flex flex-row align-items-center"
                                            onclick="return confirm('Are you sure you want to approve this leave?')">
                                            <i class="fas fa-check mr-1"></i> Approve
                                        </button>
                                    </form>

                                    <button type="button"
                                        class="btn btn-danger btn-sm d-inline-flex flex-row align-items-center"
                                        data-toggle="modal"
                                        data-target="#rejectModal{{ $leave->id }}">
                                        <i class="fas fa-times mr-1"></i> Reject
                                    </button>
                                </div>
                                @else
                                <span class="text-muted">Processed</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($leaves->isEmpty())
                <p class="text-center text-muted mt-3">No leave requests found.</p>
                @endif

            </div>
        </div>

    </div>
</section>

<!-- Reject Modals (outside the table so DataTables doesn't break them) -->
@foreach($leaves as $leave)
@php
$modalStatus = strtolower(trim((string) ($leave->status ?? '')));
@endphp
@if(!in_array($modalStatus, ['approved', 'rejected']))
<div class="modal fade"
    id="rejectModal{{ $leave->id }}"
    tabindex="-1"
    role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('admin.leaves.reject', $leave->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-header">
                    <h5 class="modal-title">Reject Leave Request</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>
                        Employee:
                        <strong>{{ $leave->employee->name ?? 'N/A' }}</strong>
                    </p>
                    <label for="rejection_reason_{{ $leave->id }}">Rejection Reason</label>
                    <textarea id="rejection_reason_{{ $leave->id }}"
                        name="rejection_reason"
                        class="form-control"
                        rows="4"
                        maxlength="1000"
                        required
                        placeholder="Enter rejection reason"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-danger">
                        Confirm Reject
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endforeach
@endsection
<!-- DataTable Script -->
@push('scripts')
<script>
    $(document).ready(function() {
        $('#leaveTable').DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            ordering: true,
            searching: true,
            paging: true,
            info: true
        });
    });
</script>
@endpush
