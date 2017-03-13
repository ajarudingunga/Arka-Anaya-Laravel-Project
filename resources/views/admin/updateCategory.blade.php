@extends('admin.layouts.adminMaster')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Category update</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form" action="{{url('admin/categories/update', ['id' => $updateData->id])}}" method="post">
                         {{ csrf_field() }}
                      <div class="form-group {{ $errors->has('categoryname') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">Category name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required
                            id="categoryname" name="categoryname" value="{{$updateData->category_name}}"/>
                            @if ($errors->has('categoryname'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('categoryname') }}</strong>
                                </span>
                            @endif
                        </div>

                      </div>

                      <div class="form-group {{ $errors->has('categorydesc') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">Description</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" required
                            id="categoryname" name="categorydesc" value="{{$updateData->category_desc}}"/>
                            @if ($errors->has('categorydesc'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('categorydesc') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>
                </div>
                <div class="modal-footer">
                    <a href="{{url('admin/categories')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                    <button type="submit" class="btn btn-primary">Change</button>
                </div>
                </form>
            </div>
          </div>
       </div>

        <section class="content-header">
            <h1>"Food Product" Main-Category</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Main-Category</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }} fade-in" id="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                </div>

                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <script>
        $('#myModal').modal('show');
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#alert").slideUp(500);
    });
    </script>

    <script>
    $(document).ready(function(){
        $("#myModal").modal({backdrop: "static"});
    });
    </script>
@endsection
