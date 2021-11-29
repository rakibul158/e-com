@extends('admin.layout.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Catalogue</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(Session::has('success_message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Products</h3>
                                <a href="{{ route('product.add.edit') }}" class="btn btn-primary float-right">Add Product</a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="product" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Category</th>
                                        <th>Sections</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 1;
                                    ?>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>
                                            <td>{{ $product->product_color }}</td>
                                            <td>{{ $product->category->category_name }}</td>
                                            <td>{{ $product->section->name }}</td>
                                            <td>
                                                @if($product->status == 1)
                                                    <a href="javascript:void(0)" class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}">Active</a>
                                                @else
                                                    <a href="javascript:void(0)" class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}">Inactive</a>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ url('admin/add-edit-product/'.$product->id) }}">Edit</a>
                                                &nbsp; &nbsp;
                                                <a href="javascript:void(0)" class="confirmDelete" record="product" recordId="{{ $product->id }}">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
