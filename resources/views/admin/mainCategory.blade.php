@extends('admin.layouts.adminMaster')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">New Main Category</h4>
                </div>

                <div class="modal-body">
                    <form class="form-horizontal" role="form" action="{{url('admin/categories')}}" method="post">
                         {{ csrf_field() }}
                      <div class="form-group {{ $errors->has('categoryname') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">New Category</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                            id="categoryname" name="categoryname" placeholder="New Category Name" required/>
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
                            <input type="text" class="form-control"
                            id="categoryname" name="categorydesc" placeholder="New Category Name" required/>
                            @if ($errors->has('categorydesc'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('categorydesc') }}</strong>
                                </span>
                            @endif
                        </div>

                      </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
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
                <div class="col-sm-10" style="  padding-top: 30px;">
                    @if(Session::has('message'))
                    <div class="alert {{ Session::get('alert-class') }} fade-in" id="alert">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                </div>

                <div class="col-sm-2 pull-right" style="padding-bottom: 30px; padding-top: 30px;">
                    <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#myModal">New Category</button>
                </div>


                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"></h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr >
                                        <th>SR.NO</th>
                                        <th>Category Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($allCategoryResult as  $key=>$allCategoryResults)
                                    <tr>
                                        <td>{{++$key }}</td>
                                        <td>{{$allCategoryResults->category_name}}</td>
                                        <td>{{$allCategoryResults->category_desc}}</td>
                                        @if ($allCategoryResults->category_active_status=='1')
                                            <td class="text-green">Active</td>
                                        @else
                                            <td class="text-danger">Deactive</td>
                                        @endif

                                        <td align="center">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-info">Take Action</button>
                                                <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li><a href="{{url('admin/categories/update', ['id' => $allCategoryResults->id])}}">Update</a></li>
                                                    <li><a href="{{url('admin/categories/delete', ['id' => $allCategoryResults->id])}}" onclick="return confirm('Are you sure you want to Delete?');">Delete</a></li>
                                                    <li class="divider"></li>
                                                    @if ($allCategoryResults->category_active_status=='1')
                                                        <li><a href="{{ url('admin/categories/toggleStatus', ['id' => $allCategoryResults->id])}}">Disable</a></li>
                                                    @else
                                                        <li><a href="{{ url('admin/categories/toggleStatus', ['id' => $allCategoryResults->id])}}">Enable</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </td>

                                    </tr>

                                     @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

    <script>
        $("#alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#alert").slideUp(500);
    });
    </script>

    @if(Session::has('errors'))
        <script>
        $(function() {
            $('#myModal').modal('show');
        });
        </script>
    @endif
 <script type="text/javascript">
   $(function() {
       $('#example1').DataTable({
           "paging": true,
           "lengthChange": true,
           "searching": true,
           "ordering": true,
           "info": true,
           "autoWidth": true
       });
   });
   </script>

@endsection
