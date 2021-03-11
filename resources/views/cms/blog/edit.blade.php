@extends('cms.index')

@section('title','Dashboard')

@section('styles')
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        .custom-error-class {
            color: #FF0000; /* red */
        }

        .custom-valid-class {
            color: #00CC00; /* green */
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>General Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">General Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <!-- right column -->
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">General Elements</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form id="create_article_form" role="form" method="post"
                                action="{{route('blog.update',[$blog->id])}}" enctype="multipart/form-data">
                              @csrf
                              @method('PUT')
                              @if($errors->any())
                                  <div class="alert alert-danger">
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif

                              <div class="row">
                                  <div class="col-sm-6">
                                      <!-- select -->
                                      <div class="form-group">
                                          <label>Select Category</label>
                                          <select class="form-control" name="category_id">
                                              <option value="-1">Select Category</option>
                                              @foreach($category as $category)
                                                  <option value="{{$category->id}}"
                                                         @if($category->id == $category->id) selected  @endif>{{$category->category_name}}</option>
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-sm-9">
                                      <!-- text input -->
                                      <div class="form-group">
                                          <label>blog Title</label>
                                          <input name="title" value='{{$blog->title}}'
                                                 type="text" class="form-control"
                                                 placeholder="Enter title...">
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-9">
                                      <!-- textarea -->
                                      <div class="form-group">
                                          <label>Short Description</label>
                                          <textarea name="short_description" class="form-control" rows="3"
                                                    placeholder="Enter short description...">{{$blog->short_description}}</textarea>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-sm-9">
                                      <!-- textarea -->
                                      <div class="form-group">
                                          <label>Full Description</label>
                                          <textarea name="full_description" class="form-control" rows="3"
                                                    placeholder="Enter full description...">{{$blog->full_description}}</textarea>
                                      </div>
                                  </div>
                              </div>



                              <div class="form-group">
                                  <div class="custom-control custom-switch">
                                      <input name="status" type="checkbox"
                                             @if($blog->status == "Visible")
                                             checked
                                             @endif
                                             class="custom-control-input" id="customSwitch1">
                                      <label class="custom-control-label" for="customSwitch1">
                                          Visibility Status
                                      </label>
                                  </div>
                              </div>
                              <div class="card-footer">
                                  <button type="submit" class="btn btn-primary">Save</button>
                              </div>
                          </form>
                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->
                        <!-- general form elements disabled -->
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('scripts')
    <!-- bs-custom-file-input -->
    <script src="{{asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('cms/dist/js/demo.js')}}"></script>


    <script>
        $.validator.addMethod("valueNotEquals", function (value, element, arg) {
            return arg != value;
        }, "Value must not equal arg.");
        $('#create_article_form').validate({
            errorClass: "custom-error-class",
            // validClass: "custom-valid-class",
            rules: {
                category_id: {
                    valueNotEquals: "-1"
                },
                title: {
                    required: true,
                    minlength: 10,
                    maxlength: 50,
                },
                short_description: {
                    required: true,
                    minlength: 20,
                    maxlength: 150,
                },
                full_description: {
                    required: true,
                    minlength: 40,
                }
            },
            messages: {
                category_id: {
                    valueNotEquals: "Please, select category",
                },
                title: {
                    required: "Please, enter article title",
                    minlength: "Please, title must be at least 20",
                    maxlength: "Please, title must be at least 50",
                },
                short_description: {
                    required: "Please, enter short desc. title",
                    minlength: "Please, title must be at least 20",
                    maxlength: "Please, title must be at least 150",
                },
                full_description: {
                    required: "Please, enter full desc. title",
                    minlength: "Please, title must be at least 40",
                }
            }
        })
    </script>
@endsection
