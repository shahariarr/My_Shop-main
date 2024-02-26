@extends('layouts.app')

@section('content')
    <div class="pagetitle">
        <h1>Product Sale</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Sale</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="row">
                        <div class="col-8">
                            <h5 class="card-title mb-3">BILLED TO</h5>
                            <p class="text-xs mx-0 my-1">Name: <span id="CName"></span> </p>
                            <p class="text-xs mx-0 my-1">Email: <span id="CEmail"></span></p>
                            <p class="text-xs mx-0 my-1">User ID: <span id="CId"></span> </p>
                        </div>
                        <div class="col-4">
                            <h5 class="card-title mb-3">MY Shop</h5>
                            <p class="text-bold mx-0 my-1 text-dark">Invoice </p>
                            <p class="text-xs mx-0 my-1">Date: {{ date('Y-m-d') }} </p>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />
                    <div class="row">
                        <div class="col-12">
                            <table class="table w-100" id="invoiceTable">
                                <thead class="w-100">
                                    <tr>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tbody id="invoiceList">
                                    <!-- Invoice items will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr class="mx-0 my-2 p-0 bg-secondary" />
                    <div class="row">
                        <div class="col-12">
                            <p class="fw-bold mb-1">TOTAL: <span id="total"></span></p>
                            <p class="fw-bold mb-1">PAYABLE: <span id="payable"></span></p>
                            <p class="fw-bold mb-1">VAT(10%): <span id="vat"></span></p>
                            <p class="fw-bold mb-1">Discount: <span id="discount"></span></p>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Discount(%)</span>
                                <input onkeydown="return false" value="0" min="0" type="number" step="0.25"
                                    onchange="DiscountChange()" class="form-control" id="discountP">
                            </div>
                            <button onclick="createInvoice()" class="btn btn-primary">Confirm</button>
                        </div>
                        <div class="col-12 p-2">

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Available Products</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="productTable">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Pick</th>
                                    </tr>
                                </thead>
                                <tbody id="productList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-lg-4 p-2">
                <div class="shadow-sm h-100 bg-white rounded-3 p-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Select Customer</h5>
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered" id="customerTable">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Pick</th>
                                    </tr>
                                </thead>
                                <tbody id="customerList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    <div class="modal animated zoomIn" id="create-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Add Product</h6>
                </div>
                <div class="modal-body">
                    <form id="add-form">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 p-1">
                                    <label class="form-label">Product ID *</label>
                                    <input type="text" class="form-control" id="PId">
                                    <label class="form-label mt-2">Product Name *</label>
                                    <input type="text" class="form-control" id="PName">
                                    <label class="form-label mt-2">Product Price *</label>
                                    <input type="text" class="form-control" id="PPrice">
                                    <label class="form-label mt-2">Product Qty *</label>
                                    <input type="text" class="form-control" id="PQty">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button id="modal-close" class="btn btn-secondary" data-bs-dismiss="modal"
                        aria-label="Close">Close</button>
                    <button onclick="add()" id="save-btn" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        let InvoiceItemList = [];
        CustomerList();

        async function CustomerList() {
            let res = await axios.get('/list-customer');
            let customerList = $('#customerList');
            let customerTable = $('#customerTable');
            customerTable.DataTable().destroy();
            customerList.empty();
            res.data.data.forEach(function(item, index) {
                customerList.append(`<tr>
                                <td>${item.name}</td>
                                <td class="d-flex justify-content-around align-items-center">
                                   <button data-name="${item['name']}" data-email="${item['email']}" data-id="{{ Auth::user()->id }}" class="btn addCustomer btn-primary btn-sm">Add</button>
                                </td>
                            </tr>`);
            });

            $('.addCustomer').on('click', async function() {
                let CName = $(this).data('name');
                let CEmail = $(this).data('email');
                let CId = $(this).data('id');
                $("#CName").text(CName)
                $("#CEmail").text(CEmail)
                $("#CId").text(CId)
            })


            new DataTable('#customerTable', {
                order: [
                    [0, 'desc']
                ],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });
        }


        ProductList();
        async function ProductList() {

            let res = await axios.get('/list-product');
            let productTable = $("#productTable");
            let productList = $("#productList");
            productTable.DataTable().destroy();
            $('#productList').empty();

            res.data.data.forEach(function(item, index) {
                productList.append(`<tr>
                            <td>${item.name}</td>
                            <td class="d-flex justify-content-around align-items-center">
                                <button data-name="${item['name']}" data-price="${item['price']}" data-id="${item['id']}" class="btn addProduct btn-primary btn-sm">Add</button>
                            </td>
                        </tr>`);
            });

            $('.addProduct').on('click', async function() {
                let PName = $(this).data('name');
                let PPrice = $(this).data('price');
                let PId = $(this).data('id');
                addModal(PId, PName, PPrice)
            })

            new DataTable('#productTable', {
                order: [
                    [0, 'desc']
                ],
                scrollCollapse: false,
                info: false,
                lengthChange: false
            });

        }

        function addModal(id, name, price) {
            document.getElementById('PId').value = id
            document.getElementById('PName').value = name
            document.getElementById('PPrice').value = price
            $('#create-modal').modal('show')
        }

        function add() {
            let PId = document.getElementById('PId').value;
            let PName = document.getElementById('PName').value;
            let PPrice = document.getElementById('PPrice').value;
            let PQty = document.getElementById('PQty').value;
            let PTotalPrice = (parseFloat(PPrice) * parseFloat(PQty)).toFixed(2);

            let item = {
                product_name: PName,
                product_id: PId,
                qty: PQty,
                sale_price: PTotalPrice
            };

            InvoiceItemList.push(item);
         
            $('#create-modal').modal('hide')
            ShowInvoiceItem();

        }

        function ShowInvoiceItem() {
            let invoiceList = $('#invoiceList');
            invoiceList.empty();
            let total = 0;
            InvoiceItemList.forEach(function(item, index) {
                total += parseFloat(item.sale_price);
                invoiceList.append(`<tr>
                            <td>${item.product_name}</td>
                            <td>${item.qty}</td>
                            <td>${item.sale_price}</td>
                            <td class="d-flex justify-content-around align-items-center">
                                <button onclick="removeItem(${index})" class="btn btn-danger btn-sm">Remove</button>
                            </td>
                        </tr>`);
            });

            $('#total').text(total.toFixed(2));
            $('#payable').text(total.toFixed(2));
            $('#vat').text((total*0.1).toFixed(2));
            $('#discount').text(0);

    }
    function removeItem(index) {
        InvoiceItemList.splice(index, 1);
        ShowInvoiceItem();
    }



    </script>
@endpush
