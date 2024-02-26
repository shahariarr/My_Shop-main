@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Report</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Sales Report</h4>
                        <div class="mb-3">
                            <label for="FormDate" class="form-label">Date From</label>
                            <input id="FormDate" type="date" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="ToDate" class="form-label">Date To</label>
                            <input id="ToDate" type="date" class="form-control">
                        </div>
                        <button onclick="SalesReport()" class="btn btn-primary mt-3">Download</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
