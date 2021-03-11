@extends('cms.index')

@section('title','Dashboard')

@section('styles')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('cms/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
@endsection

@section('content')
    <div class="container">
        <div class="container">
            <div class="main-body">

                  <!-- Breadcrumb -->
                  <nav aria-label="breadcrumb" class="main-breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ route('cms.admin.index') }}">Admin</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Admin Profile</li>
                    </ol>
                  </nav>
                  <!-- /Breadcrumb -->

                  <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                      <div class="card">
                        <div class="card-body">
                          <div class="d-flex flex-column align-items-center text-center">
                            <img src="{{url('images/admins/'.$admin->admin_image )}}" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                              <h4>{{ $admin->name }}</h4>
                              <p class="text-secondary mb-1">{{ $admin->email }}</p>

                            </div>
                          </div>
                        </div>
                      </div>

                    </div>
                    <div class="col-md-8">
                      <div class="card mb-3">
                          <form action="{{ route('cms.admin.profileEdit',[$admin->id]) }} " method="POST" enctype="multipart/form-data
                            ">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Full Name</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                    {{ $admin->name }}
                                    <input type="text" name="name" value="{{ $admin->name  }}">
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Email</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      <input type="email" name="email" value="{{ $admin->email }}">
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">password</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      <a href="{{ route('profile.password',[$admin->id]) }}">Change password</a>

                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Mobile</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      {{ $admin->mobile }}
                                      <input type="tel" name="mobile" value="{{ $admin->mobile }}">
                                  </div>
                                </div>
                                <hr>
                                <div class="row">
                                  <div class="col-sm-3">
                                    <h6 class="mb-0">Admin Image</h6>
                                  </div>
                                  <div class="col-sm-9 text-secondary">
                                      <input type="file" class="custom-file-input"
                                      value="{{ $admin->admin_image }}"
                                      name="admin_image">
                               <label class="custom-file-label" for="customFile">Choose
                                   file</label>
                                  </div>
                                </div>
                              </div>
                              <hr>

                              <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>



                        </form>

                      </div>

                    </div>
                  </div>
                </div>
            </div>

    </div>
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{asset('cms/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('cms/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('cms/dist/js/demo.js')}}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $("#example1").DataTable();
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
