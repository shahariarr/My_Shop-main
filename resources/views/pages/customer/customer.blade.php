@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Customer</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Customer</li>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add New Customer

                                </button>
                            </div>
                        </div>
                        <br>

                        {{-- model creted --}}
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Customer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="save-form">

                                            <input type="text" id="name" class="form-control"
                                                placeholder="Enter customar name"><br>
                                            <input type="email" id="email" class="form-control"
                                                placeholder="Enter costomer email"><br>
                                            <input type="text" id="mobile" class="form-control"
                                                placeholder="Enter customer mobile number">

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            id="modal-close">Close</button>
                                        <button type="button" class="btn btn-primary"onclick="Save()"
                                            id="save-btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- model end --}}

                        {{-- delete model --}}

                        <div class="modal fade" id="delete-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Delete !</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-3">Once delete, you can't get it back.</p>
                                        <input class="d-none" id="deleteID" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            id="delete-modal-close">Close</button>
                                        <button type="button" onclick="itemDelete()" id="confirmDelete"
                                            class="btn btn-primary">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- delete model end --}}


                        {{-- model update --}}
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Update</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="update-form">

                                            <input class="d-none" id="updateID" />

                                            <input type="text" id="customerNameUpdate" class="form-control"
                                                placeholder="Enter customar name"><br>
                                            <input type="email" id="customerEmailUpdate" class="form-control"
                                                placeholder="Enter costomer email"><br>
                                            <input type="text" id="customerMobileUpdate" class="form-control"
                                                placeholder="Enter customer mobile number">



                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            id="Update-close">Close</button>
                                        <button type="button" class="btn btn-primary"onclick="Update()"
                                            id="save-btn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- model end --}}

                        <!-- DataTales Example -->

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="tableData">
                                <thead>
                                    <tr>
                                        <th>Customer Id</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Mobile Number</th>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Category Created At</th>
                                        <th>Category Updated At</th>
                                        <th>Category Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableList">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Customer Id</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Mobile Number</th>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Category Created At</th>
                                        <th>Category Updated At</th>
                                        <th>Category Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- DataTales Example end -->
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        getList();
        async function getList() {
            try {
                let res = await axios.get('/list-customer');
                let tableData = $("#tableData");
                let tableList = $("#tableList");
                tableData.DataTable().destroy();
                $('#tableList').empty();



                res.data.data.forEach(function(item, index) {
                    tableList.append(`<tr>
                                <td>${index+1}</td>
                                <td>${item.name}</td>
                                <td>${item.email}</td>
                                <td>${item.mobile}</td>
                                <td>${item.user_id}</td>
                                <td>{{ Auth::user()->name }}</td>
                                <td>${item.created_at}</td>
                                <td>${item.updated_at}</td>
                                <td class="d-flex justify-content-around align-items-center">
                                    <button  class="btn edit btn-primary" data-id="${item['id']}" >Edit</button>
                                    <button  class="btn delete btn-danger" data-id="${item['id']}" >Delete</button>
                                </td>
                            </tr>`);
                });

                $('.delete').on('click', function() {
                    let id = $(this).data('id');
                    $("#delete-modal").modal('show');
                    $("#deleteID").val(id);
                })



                $('.edit').on('click', function() {
                    let id = $(this).data('id');

                    $('#updateModal').modal('show');
                    $('#updateID').val(id);

                    FillUpUpdateForm(id);

                })


                new DataTable('#tableData', {
                    order: [
                        [0, 'asc']
                    ],
                    lengthMenu: [5, 10, 15, 20, 30]
                });



            } catch (error) {
                console.log(error);
            }
        }

        async function Save() {
            try {
                let name = $("#name").val();
                let email = $("#email").val();
                let mobile = $("#mobile").val();
                document.getElementById('modal-close').click();

                let res = await axios.post('/create-customer', {
                    name: name,
                    email: email,
                    mobile: mobile
                });

                if (res.data['status'] === "success") {

                    document.getElementById("save-form").reset();


                    await getList();

                }
            } catch (error) {
                console.log(error);
            }
        }

        async function itemDelete() {
            try {
                let id = $('#deleteID').val();
                document.getElementById('delete-modal-close').click();
                let res = await axios.post('/delete-customer', {
                    id: id
                })

                if (res.data['status'] == "success") {

                    await getList();

                }

            } catch (error) {
                console.log(error);
            }
        }

        async function FillUpUpdateForm(id) {
            try {

                $('#updateID').val(id);

                let res = await axios.post("/customer-by-id", {
                    id: id
                })


                document.getElementById('customerNameUpdate').value = res.data.rows.name;
                document.getElementById('customerEmailUpdate').value = res.data.rows.email;
                document.getElementById('customerMobileUpdate').value = res.data.rows.mobile;
            } catch (error) {
                console.log(error);
            }
        }



        async function Update() {
            try {
                let id = document.getElementById('updateID').value;
                let customerName = document.getElementById('customerNameUpdate').value;
                let customerEmail = document.getElementById('customerEmailUpdate').value;
                let customerMobile = document.getElementById('customerMobileUpdate').value;
                document.getElementById('Update-close').click();
                let res = await axios.post("/update-customer", {
                    id: id,
                    name: customerName,
                    email: customerEmail,
                    mobile: customerMobile
                })

                if (res.data['status'] == "success") {
                    document.getElementById("update-form").reset();
                    await getList();

                }
            } catch (error) {
                console.log(error);
            }
        }

    </script>
@endpush
