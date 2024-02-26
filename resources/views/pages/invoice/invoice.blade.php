@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Invoice</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Invoice</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card px-4 py-4">
                    <div class="row justify-content-between">
                        <div class="col">
                            <h5 class="mb-0">Invoices</h5>
                        </div>
                        <div class="col">
                            <a href="{{ url('/salePage') }}" class="btn btn-primary float-end">Create Sale</a>
                        </div>
                    </div>
                    <hr class="my-3">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tableData">
                            <thead class="bg-light">
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Total</th>
                                    <th>Vat</th>
                                    <th>Discount</th>
                                    <th>Payable</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableList">
                              <tr>
                                <td>1</td>
                                <td>John Doe</td>
                                <td>01712345678</td>
                                <td>1000</td>
                                <td>100</td>
                                <td>50</td>
                                <td>1050</td>
                                <td>
                                    <a href="{{ url('/invoicePage') }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ url('/invoicePage') }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                              </tr>
                              <tr>
                                <td>2</td>
                                <td>John Doe</td>
                                <td>01712345678</td>
                                <td>1000</td>
                                <td>100</td>
                                <td>50</td>
                                <td>1050</td>
                                <td>
                                    <a href="{{ url('/invoicePage') }}" class="btn btn-primary btn-sm">View</a>
                                    <a href="{{ url('/invoicePage') }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        new DataTable('#tableData', {
            order: [[0, 'asc']],
            lengthMenu: [5, 10, 15, 20, 30]
        })
    </script>
@endpush
