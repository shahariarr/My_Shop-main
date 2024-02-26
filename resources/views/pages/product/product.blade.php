@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Product</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Product</li>
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
                                    data-bs-target="#createModal">
                                    Add New Product
                                </button>
                            </div>
                        </div>
                        <br>

                        {{-- model creted --}}
                        <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="save-form">

                                            <select type="text" class="form-control form-select" id="productCategory">
                                                <option value="">Select Category</option>
                                            </select><br>

                                            <input type="text" id="name" class="form-control"
                                                placeholder="Enter Product name"><br>
                                            <input type="text" id="unit" class="form-control"
                                                placeholder="Enter unit price"><br>
                                            <input type="text" id="price" class="form-control"
                                                placeholder="Enter product price"><br>
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

                        <div class="modal fade" id="delete-modal-show" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Product Update</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="update-form">

                                            <input class="d-none" id="updateID" />

                                            <select type="text" class="form-control form-select" id="productCategoryUpdate">
                                                <option value="">Select Category</option>
                                            </select><br>

                                            <input type="text" id="ProductNameUpdate" class="form-control"
                                                placeholder="Enter customar name"><br>
                                            <input type="text" id="ProductUnitUpdate" class="form-control"
                                                placeholder="Enter unit price"><br>
                                            <input type="text" id="ProductpriceUpdate" class="form-control"
                                                placeholder="Enter product price"><br>

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
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Unit</th>
                                        <th>Product Price</th>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Category Id</th>
                                        <th>Category Created At</th>
                                        <th>Category Updated At</th>
                                        <th>Category Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableList">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Product Id</th>
                                        <th>Product Name</th>
                                        <th>Product Unit</th>
                                        <th>Product Price</th>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Category Id</th>
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
                let res = await axios.get('/list-product');
                let tableData = $("#tableData");
                let tableList = $("#tableList");
                tableData.DataTable().destroy();
                $('#tableList').empty();

                res.data.data.forEach(function(item, index) {
                    tableList.append(`<tr>
                            <td>${index+1}</td>
                            <td>${item.name}</td>
                            <td>${item.unit}</td>
                            <td>${item.price}</td>
                            <td>${item.user_id}</td>
                            <td>{{ Auth::user()->name }}</td>
                            <td>${item.category_id}</td>
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
                    $("#delete-modal-show").modal('show');
                    $("#deleteID").val(id);
                })


                $('.edit').on('click', function() {
                    let id = $(this).data('id');
                    $("#updateModal").modal('show');
                    $("#deleteID").val(id);
                    FillUpUpdateForm(id);
                })



                new DataTable('#tableData', {
                    order: [
                        [0, 'asc']
                    ],
                    lengthMenu: [5, 10, 15, 20, 30]
                })



            } catch (error) {
                console.error(error);
            }
        }


        FillCategoryDropDown();

        async function FillCategoryDropDown() {
            let res = await axios.get('/list-category');
            $('#productCategory').empty().html('<option selected disabled hidden value="">Select Category</option>');
            let productCategory = $("#productCategory");
            res.data.data.forEach(function(item, index) {
                productCategory.append(`<option value="${item.id}">${item.name}</option>`);
            });
        }



        async function Save() {

            try {
                let name = $("#name").val();
                let unit = $("#unit").val();
                let price = $("#price").val();
                let category = $("#productCategory").val();
                document.getElementById('modal-close').click();
                let res = await axios.post('/create-product', {
                    name: name,
                    unit: unit,
                    price: price,
                    category_id: category
                });
                if (res.data['status'] == "success") {
                    document.getElementById("save-form").reset();
                    await getList();
                }

            } catch (error) {
                console.error(error);
            }
        }

        async function itemDelete() {
            try {
                let id = $('#deleteID').val();
                document.getElementById('delete-modal-close').click();
                let res = await axios.post('/delete-product', {
                    id:id
                })

                if (res.data['status'] == "success") {

                    await getList();

                }

            } catch (error) {
                console.log(error);
            }
        }

        async function UpdateFillCategoryDropDown(){
            let res = await axios.get('/list-category');
            let productCategoryUpdate = $("#productCategoryUpdate");
            res.data.data.forEach(function(item, index) {
                productCategoryUpdate.append(`<option value="${item.id}">${item.name}</option>`);
            });
        }


        async function FillUpUpdateForm(id) {
            try {

                $('#updateID').val(id);
                await UpdateFillCategoryDropDown();

                let res = await axios.post("/product-by-id", {
                    id: id
                })
                console.log(res.data.rows);



                document.getElementById('ProductNameUpdate').value = res.data.rows.name;
                document.getElementById('ProductUnitUpdate').value = res.data.rows.unit;
                document.getElementById('ProductpriceUpdate').value = res.data.rows.price;
                document.getElementById('productCategoryUpdate').value = res.data.rows.category_id;

            } catch (error) {
                console.log(error);
            }
        }

        async function Update() {
            try {
                let id = document.getElementById('updateID').value;
                let customerName = document.getElementById('ProductNameUpdate').value;
                let customerUnit = document.getElementById('ProductUnitUpdate').value;
                let customerPrice = document.getElementById('ProductpriceUpdate').value;
                let categoryId =document.getElementById("productCategoryUpdate").value;
                document.getElementById('Update-close').click();
                let res = await axios.post("/update-product", {
                    id: id,
                    name: customerName,
                    unit: customerUnit,
                    price: customerPrice,
                    category_id:categoryId
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
