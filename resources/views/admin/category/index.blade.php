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
                            <li class="breadcrumb-item active">Category</li>
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
                                <h3 class="card-title">Category</h3>
                                <a href="{{ route('category.add.edit') }}" class="btn btn-primary float-right">Add Category</a>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="category" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category</th>
                                        <th>Parent Category</th>
                                        <th>Section</th>
                                        <th>URL</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $i = 1;
                                    ?>
                                    @foreach($categories as $category)
                                        @if(!isset($category->parentCategory->category_name))
                                            <?php
                                                $parent_category = "Root";
                                            ?>
                                        @else
                                            <?php
                                                $parent_category = $category->parentCategory->category_name;
                                            ?>
                                        @endif

                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $category->category_name }}</td>
                                            <td>{{ $parent_category }}</td>
                                            <td>{{ $category->section->name }}</td>
                                            <td>{{ $category->url }}</td>
                                            <td>
                                                @if($category->status == 1)
                                                    <a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}">Active</a>
                                                @else
                                                    <a href="javascript:void(0)" class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}">Inactive</a>
                                                @endif

                                            </td>
                                            <td>
                                                <a href="{{ url('admin/add-edit-category/'.$category->id) }}">Edit</a>
                                                &nbsp; &nbsp;
                                                <a {{--href="{{ url('admin/delete-category/'.$category->id) }}"--}} href="javascript:void(0)" class="confirmDelete" record="Category" recordId="{{ $category->id }}">Delete</a>
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
