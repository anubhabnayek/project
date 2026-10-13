@extends('layouts.app')

@section('title', 'Apply Leave')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Apply Leave</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>

                    <li class="breadcrumb-item">
                        Employee Leave
                    </li>

                    <li class="breadcrumb-item active">
                        Apply Leave
                    </li>

                </ol>
            </div>

        </div>
    </div>

</section>

<section class="content">

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">

                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Apply Leave</h3>
                    </div>


                    <form action="{{ route('employee.leaves.store') }}" method="POST">

                        @csrf

                        <div class="card-body">

                            {{-- Leave Type --}}
                            <div class="form-group">

                                <label for="leave_type">
                                    Leave Type
                                    <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="leave_type"
                                    id="leave_type"
                                    class="form-control @error('leave_type') is-invalid @enderror">

                                    <option value="">Select Leave Type</option>

                                    <option value="Casual Leave"
                                        {{ old('leave_type') == 'Casual Leave' ? 'selected' : '' }}>
                                        Casual Leave
                                    </option>

                                    <option value="Sick Leave"
                                        {{ old('leave_type') == 'Sick Leave' ? 'selected' : '' }}>
                                        Sick Leave
                                    </option>

                                    <option value="Annual Leave"
                                        {{ old('leave_type') == 'Annual Leave' ? 'selected' : '' }}>
                                        Annual Leave
                                    </option>

                                    <option value="Emergency Leave"
                                        {{ old('leave_type') == 'Emergency Leave' ? 'selected' : '' }}>
                                        Emergency Leave
                                    </option>

                                </select>

                                @error('leave_type')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>


                            {{-- From Date --}}
                            <div class="form-group">

                                <label for="from_date">
                                    From Date
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="from_date"
                                    id="from_date"
                                    class="form-control @error('from_date') is-invalid @enderror"
                                    value="{{ old('from_date') }}">

                                @error('from_date')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>


                            {{-- To Date --}}
                            <div class="form-group">

                                <label for="to_date">
                                    To Date
                                    <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="to_date"
                                    id="to_date"
                                    class="form-control @error('to_date') is-invalid @enderror"
                                    value="{{ old('to_date') }}">

                                @error('to_date')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>


                            {{-- Reason --}}
                            <div class="form-group">

                                <label for="reason">
                                    Reason
                                    <span class="text-danger">*</span>
                                </label>

                                <textarea
                                    name="reason"
                                    id="reason"
                                    rows="5"
                                    class="form-control @error('reason') is-invalid @enderror"
                                    placeholder="Enter reason for leave">{{ old('reason') }}</textarea>

                                @error('reason')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                                @enderror

                            </div>

                        </div>


                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">

                                <i class="fas fa-paper-plane"></i>

                                Apply Leave

                            </button>


                            <a href="{{ route('employee.leaves.index') }}"
                                class="btn btn-secondary">

                                <i class="fas fa-arrow-left"></i>

                                Back

                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection
