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
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with default features</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>email</th>

                                    <th>mobile</th>

                                    <th>Status</th>
                                    <th>Gender</th>
                                    <th>Created At</th>
                                    <th>Settings</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($admin as $admin)
                                    <tr>
                                        <td>{{$admin->id}}</td>
                                        <td><a href="{{ route('admin.show',[$admin->id]) }}">{{ $admin->name }}</a></td>
                                        <td>{{$admin->email}}</td>
                                        <td>{{$admin->mobile}}</td>

                                        @if($admin->status == 'Active')
                                            <td style="color: green">{{$admin->status}}</td>
                                        @else
                                            <td style="color: red">{{$admin->status}}</td>
                                        @endif
                                        @if($admin->gender != 'Female')
                                        <td style="color:blue">{{$admin->gender}}</td>
                                         @else
                                        <td style="color:rgb(196, 53, 77)">{{$admin->gender}}</td>
                                         @endif
                                        <td>{{$admin->created_at}}</td>
                                        <td>
                                            <ul>
                                                <li>
                                                    <a href="{{route('admin.edit',[$admin->id])}}">Edit</a>
                                                </li>
                                                @if (auth()->user()->id == $admin->id )
                                                <p> This User</p>

                                                @else
                                                <li>

                                                    <a href="{{route('admin.destroy',[$admin->id])}}"
                                                        style="color: red">Delete</a>



                                                </li>
                                                @endif

                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>name</th>
                                    <th>email</th>

                                    <th>mobile</th>

                                    <th>Status</th>
                                    <th>Gender</th>
                                    <th>Created At</th>
                                    <th>Settings</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
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
