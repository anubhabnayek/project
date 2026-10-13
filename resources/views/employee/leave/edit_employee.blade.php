@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Employee</h1>
            </div>

            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Employees
                    </li>

                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-8">

                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Employee Information</h3>
                    </div>

                    <form action="{{ route('employee.employees.update', $employee->id) }}" method="POST">
                        @csrf

                        <div class="card-body">
                            {{-- Name --}}
                            <div class="form-group">
                                <label for="name">
                                    Employee Name <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter employee name"
                                    value="{{ old('name', $employee->name) }}">

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- Email --}}
                            <div class="form-group">
                                <label for="email">
                                    Email <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    id="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Enter email address"
                                    value="{{ old('email', $employee->email) }}">

                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- Phone --}}
                            <div class="form-group">
                                <label for="phone">
                                    Phone <span class="text-danger">*</span>
                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    id="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    placeholder="Enter phone number"
                                    value="{{ old('phone', $employee->phone) }}">

                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            {{-- Department --}}
                            <div class="form-group">
                                <label for="department">
                                    Department <span class="text-danger">*</span>
                                </label>

                                <select
                                    name="department"
                                    id="department"
                                    class="form-control @error('department') is-invalid @enderror">

                                    <option value="">Select Department</option>

                                    <option value="HR"
                                        {{ old('department', $employee->department) == 'HR' ? 'selected' : '' }}>
                                        HR
                                    </option>

                                    <option value="IT"
                                        {{ old('department', $employee->department) == 'IT' ? 'selected' : '' }}>
                                        IT
                                    </option>

                                    <option value="Finance"
                                        {{ old('department', $employee->department) == 'Finance' ? 'selected' : '' }}>
                                        Finance
                                    </option>

                                    <option value="Marketing"
                                        {{ old('department', $employee->department) == 'Marketing' ? 'selected' : '' }}>
                                        Marketing
                                    </option>

                                    <option value="Sales"
                                        {{ old('department', $employee->department) == 'Sales' ? 'selected' : '' }}>
                                        Sales
                                    </option>

                                    <option value="Operations"
                                        {{ old('department', $employee->department) == 'Operations' ? 'selected' : '' }}>
                                        Operations
                                    </option>

                                </select>

                                @error('department')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>

                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                Update Employee
                            </button>

                            <a href="{{ route('employee.employees.index') }}"
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
