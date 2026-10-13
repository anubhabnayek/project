@extends('layouts.app')
@section('title', 'Employee Listing')
@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Employee Listing</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="">Home</a>
                    </li>
                    <li class="breadcrumb-item active">
                        Employees
                    </li>
                </ol>
            </div>

        </div>
    </div>
</section>
<!-- Main Content -->
<section class="content">
    <div class="container-fluid">
        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button"
                class="close"
                data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Employee List
                        </h3>
                        <div class="card-tools">
                            <a href="{{route('admin.employees.create')}}"
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                                Add Employee

                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="employeeTable"
                            class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Department</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($employee as $employees)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{ $employees->name }}
                                    </td>
                                    <td>
                                        {{ $employees->email }}
                                    </td>
                                    <td>
                                        {{ $employees->phone }}
                                    </td>
                                    <td>
                                        {{ $employees->department }}
                                    </td>
                                    <td>

                                        <a href="{{route('admin.employees.edit',$employees->id)}}"
                                            class="btn btn-warning btn-sm"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>

                                        </a>
                                        {{-- Delete --}}
                                        <form action="{{route('admin.employees.destroy',$employees->id)}}"
                                            method="POST"
                                            style="display:inline-block;"
                                            onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(function() {
        $("#employeeTable").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "ordering": true,
            "searching": true,
            "paging": true,
            "info": true
        });
    });
</script>
@endpush
