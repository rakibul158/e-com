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
                <!-- SELECT2 EXAMPLE -->
                <form action="{{ route('category.add.edit') }}" method="POST" name="addCategoryForm" id="addCategoryForm" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Add Category</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" class="form-control" name="category_name" id="categoryName" placeholder="Enter Category Name">
                                    </div>
                                    <div id="appendCategoryLevel">
                                        @include('admin.category.append_category_level')
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryDiscount">Category Discount</label>
                                        <input type="text" class="form-control" name="category_discount" id="categoryDiscount" placeholder="Enter Category Discount">
                                    </div>
                                    <div class="form-group">
                                        <label>Category Description</label>
                                        <textarea class="form-control" rows="3" name="description" placeholder="Enter ..."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Keyword</label>
                                        <textarea class="form-control" rows="3" name="meta_keyword" placeholder="Enter ..."></textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Section</label>
                                        <select name="section_id" id="sectionId" class="form-control select2" style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="categoryImage">Category Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="category_image" class="custom-file-input" id="categoryImage">
                                                <label class="custom-file-label" for="categoryImage">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="url">Category Url</label>
                                        <input type="text" class="form-control" name="url" id="url" placeholder="Enter Category Url">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <textarea class="form-control" rows="3" name="meta_title" placeholder="Enter ..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea class="form-control" rows="3" name="meta_description" placeholder="Enter ..."></textarea>
                                    </div>

                                </div>

                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Add Category</button>
                        </div>
                    </div>
                </form>

                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
