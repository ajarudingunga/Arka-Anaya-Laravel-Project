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
                            id="categoryname" name="categoryname" placeholder="New Category Name" />
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
                            id="categoryname" name="categorydesc" placeholder="New Category Name"/>
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
            <h1>User Requests</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User Request</li>
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
                                        <th>Name</th>
                                        <th>Dept</th>
                                        <th>Enrollment</th>
                                        <th>Requested At</th>
                                        <th>Mobile</th>
                                        <th>ResideAtCampus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($userRequest as  $key=>$userRequest)
                                    <tr>
                                        <td>{{++$key }}</td>
                                        <td>{{$userRequest->user_firstname}} {{$userRequest->user_lastname}} </td>
                                        <td>{{$userRequest->user_department}}</td>
                                        <td>{{$userRequest->enrollment}}</td>
                                        <td>{{$userRequest->createdAt}}</td>
                                        <td>{{$userRequest->user_mobileno}}</td>

                                        @if ($userRequest->user_resiatcapus=='1')
                                            <td class="text-green">YES</td>
                                        @else
                                            <td class="text-danger">NO</td>
                                        @endif

                                        <td align="center">
                                            <a href="{{url('admin/userRequest/approve', ['id' => $userRequest->userId])}}">
                                                <button type="button" class="btn btn-block btn-success btn-sm">Approve</button>
                                            </a>
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
