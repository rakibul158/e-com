@extends('admin.layout.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Settings</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Settings</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Update Info</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{ route('admin.updateDetails') }}" id="update_details" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    @if(Session::has('error_message'))
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            {{ Session::get('error_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if(Session::has('success_message'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ Session::get('success_message') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" id="email" readonly="" value="{{ Auth::guard('admin')->user()->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <input class="form-control" id="type" readonly="" value="{{ Auth::guard('admin')->user()->type }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ Auth::guard('admin')->user()->name }}" class="form-control"  id="name" placeholder="Name" >
                                        <span id="checkCurrentPwdError"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input type="text" name="mobile" value="{{ Auth::guard('admin')->user()->mobile }}" class="form-control" id="mobile" placeholder="Mobile">
                                        <span id="checkCurrentPwdError"></span>
                                    </div>

                                     <div class="form-group">
                                         <label for="image_label">Image</label>
                                         <div class="input-group">
                                             <div class="custom-file">
                                                 <input type="file" name="image" class="custom-file-input" id="image">
                                                 <label class="custom-file-label" for="image">Choose file</label>
                                             </div>
                                         </div>
                                         @if(!empty(Auth::guard('admin')->user()->image))
                                             <a target="_blank" href="{{ url('images/admin/admin_upload_profile_images/'.Auth::guard('admin')->user()->image) }}">View Image</a>
                                             <input type="hidden" name="current_img" value="{{ Auth::guard('admin')->user()->image }}">
                                         @endif
                                     </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-info">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>


            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
