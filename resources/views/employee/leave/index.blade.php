@extends('layouts.app')
@section('title', 'Leave Listing')
@section('content')
<!-- Content Header -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Leave Listing</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">

                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard') }}">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item active">
                        Leave
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
                            My Leave List
                        </h3>
                        <div class="card-tools">
                            <a href="{{ route('employee.leaves.create') }}"
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i>
                                Apply Leave
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="leaveTable"
                            class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Leave Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Reason</th>
                                    <th>Status</th>
                                    <th>Rejection Reason</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($leave as $leaves)
                                <tr>
                                    <td width="5%">{{$leaves->id}}</td>
                                    <td>{{$leaves->leave_type}}</td>
                                    <td>{{$leaves->from_date}}</td>
                                    <td>{{$leaves->to_date}}</td>
                                    <td>{{$leaves->reason}}</td>
                                    <td>{{$leaves->status}}</td>
                                    <td>{{$leaves->rejection_reason }}</td>
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

        $("#leaveTable").DataTable({
            responsive: true,
            lengthChange: true,
            autoWidth: false,
            ordering: true,
            searching: true,
            paging: false,
            info: true

        });

    });
</script>

@endpush
