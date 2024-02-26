@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Category</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Category</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Datatables</h5>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="add-new-btn">
                                    <a href="{{ route('category.create') }}" class="btn btn-primary btn-custom">Add New</a>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tableData">
                                <thead>
                                    <tr>
                                        <th>Category id</th>
                                        <th>Category name</th>
                                        <th>User id</th>
                                        <th>User name</th>
                                        <th>Category Created At</th>
                                        <th>Category Updated At</th>
                                        <th>Category Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category['id'] }}</td>
                                            <td>{{ $category['name'] }}</td>
                                            <td>{{ $category['user_id'] }}</td>
                                            <td>{{Auth::user()->name}}</td>
                                            <td>{{ $category['created_at'] }}</td>
                                            <td>{{ $category['updated_at'] }}</td>


                                            <td class="d-flex justify-content-around align-items-center">

                                                <a href="{{ route('category.edit', $category['id']) }}"
                                                    class="btn btn-primary btn-custom">Edit</a>

                                                    <form action="{{ route('category.destroy', $category->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-custom">Delete</button>

                                                    </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Category Slug</th>
                                        <th>Category Description</th>
                                        <th>Category Status</th>
                                        <th>Category Created At</th>
                                        <th>Category Updated At</th>
                                        <th>Category Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            </div>





                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection

@push('scripts')
    <script>

        new DataTable('#tableData',{
            order:[[0,'asc']],
            lengthMenu:[5,10,15,20,30]
        });

    </script>
@endpush

