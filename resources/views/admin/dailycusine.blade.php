@extends('admin.layouts.adminMaster')

@section('content')
<style media="screen">
.btn-grey {
    background-color: gray;
    border-color: grey;
    color:white;
}
</style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Cuisine</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" action="{{url('admin/cuisine')}}" method="post" enctype="multipart/form-data">

                    <div class="form-group {{ $errors->has('day') ? ' has-error' : '' }}">
                      <label  class="col-sm-4 control-label"
                                for="">Day</label>
                      <div class="col-sm-8">
                         <select class="form-control" name="day">
                             <option value="">--Please select--</option>
                             <option value="Monday">Monday</option>
                             <option value="Tuesday">Tuesday</option>
                             <option value="Wednesday">Wednesday</option>
                             <option value="Thursday">Thursday</option>
                             <option value="Friday">Friday</option>
                             <option value="Saturday">Saturday</option>
                             <option value="Sunday">Sunday</option>
                         </select>
                          @if ($errors->has('day'))
                              <span class="help-block alert alert-danger">
                              <strong>{{ $errors->first('day') }}</strong>
                              </span>
                          @endif

                      </div>
                    </div>


                    <div class="form-group {{ $errors->has('time') ? ' has-error' : '' }}">
                      <label  class="col-sm-4 control-label"
                                for="">Time</label>
                      <div class="col-sm-8">
                         <select class="form-control" name="time">
                             <option value="">--Please select--</option>
                             <option value="Breakfast">Breakfast</option>
                             <option value="Lunch">Lunch</option>
                             <option value="Dinner">Dinner</option>
                         </select>
                          @if ($errors->has('time'))
                              <span class="help-block alert alert-danger">
                              <strong>{{ $errors->first('time') }}</strong>
                              </span>
                          @endif

                      </div>
                    </div>


                      <div class="form-group {{ $errors->has('productid') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="">Select Product</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="productid" required>

                                <option value="">--Please select--</option>

                                @foreach (Helper::getAllProducts() as $key => $products)
                                    <option value="{{$products->id}}">{{$products->product_name}}</option>
                                @endforeach

                            </select>

                            @if ($errors->has('productid'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('productid') }}</strong>
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
            <h1>Cuisines</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Cuisines</li>
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

                <div class="col-sm-2 pull-right" style="padding-bottom: 15px; padding-top: 30px;">
                    <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#myModal">New Cuisine</button>
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
                                    <tr>
                                        <th class="">SR.NO</th>
                                        <th class="">Day</th>
                                        <th class="">Time</th>
                                        <th class="col-md-2">Product ID</th>

                                        <th>Status</th>
                                        <th class="col-md-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($getCuisine as  $key=>$getCuisine)
                                    <tr>
                                        <td>{{++$key }}</td>

                                        <td>{{$getCuisine->cuisine_day}}</td>
                                        <td>{{$getCuisine->cuisine_time}}</td>
                                        <td>{{$getCuisine->product_id}}</td>

                                        @if ($getCuisine->cuisine_status=='1')
                                            <td class="text-green">Active</td>
                                        @else
                                            <td class="text-danger">Deactive</td>
                                        @endif
                                        <td>
                                                <a href="{{url('admin/cuisine/delete', ['id' => $getCuisine->id])}}" class="btn btn-social-icon btn-danger" title="Delete" onclick="return confirm('Are you sure you want to Delete?');">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>

                                                <a href="" class="btn btn-social-icon btn-success" title="Update">
                                                    <i class="fa fa-pencil-square-o"></i>
                                                </a>

                                                @if ($getCuisine->cuisine_status=='0')
                                                    <a href="{{ url('admin/cuisine/toggleStatus', ['id' => $getCuisine->id])}}" class="btn btn-social-icon btn-danger" title="click to Activate">
                                                        <i class="fa fa-toggle-off"></i>
                                                    </a>
                                                @else
                                                    <a href="{{ url('admin/cuisine/toggleStatus', ['id' => $getCuisine->id])}}" class="btn btn-social-icon btn-primary" title="click to Deactivate">
                                                        <i class="fa fa-toggle-on"></i>
                                                    </a>
                                                @endif

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
