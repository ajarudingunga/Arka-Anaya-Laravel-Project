@extends('admin.layouts.adminMaster')


@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1>User Profile</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="{{url('admin/users')}}"> User Listing</a></li>
                <li class="active">User Profile</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">

                <div class="col-sm-12">
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
                        <form class="form-horizontal" method="post" action="{{url('admin/users/view', ['id' => $usersList->userId])}}">
                          <div class="box-body">


                            <div class="form-group {{ $errors->has('enrollment') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">Enrollment</label>

                              <div class="col-sm-8">
                                <input type="text" name="enrollment" class="form-control" placeholder="Enrollment" value="{{$usersList->enrollment}}">
                                @if ($errors->has('enrollment'))
                                    <span class="help-block alert alert-danger">
                                    <strong>{{ $errors->first('enrollment') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>


                            <div class="form-group {{ $errors->has('firstname') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">First Name</label>

                              <div class="col-sm-8">
                                <input type="text" name="firstname" class="form-control" placeholder="First Name" value="{{$usersList->user_firstname}}">
                                @if ($errors->has('firstname'))
                                    <span class="help-block alert alert-danger">
                                    <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>


                            <div class="form-group {{ $errors->has('lastname') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">Last Name</label>

                              <div class="col-sm-8">
                                <input type="text" name="lastname" class="form-control" placeholder="Last Name" value="{{$usersList->user_lastname  }}">
                                @if ($errors->has('lastname'))
                                    <span class="help-block alert alert-danger">
                                    <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>


                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">Email</label>

                              <div class="col-sm-8">
                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{$usersList->email}}">
                                @if ($errors->has('email'))
                                    <span class="help-block alert alert-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>


                            <div class="form-group {{ $errors->has('mobile') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">Mobile Number</label>

                              <div class="col-sm-8">
                                <input type="text" name="mobile" class="form-control" placeholder="Mobile Number" value="{{$usersList->user_mobileno}}">
                                @if ($errors->has('mobile'))
                                    <span class="help-block alert alert-danger">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>

                            <div class="form-group {{ $errors->has('adress') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">Adress</label>

                              <div class="col-sm-8">
                                <textarea name="adress" style="width:100%">{{$usersList->user_address}}</textarea>
                                @if ($errors->has('adress'))
                                    <span class="help-block alert alert-danger">
                                    <strong>{{ $errors->first('adress') }}</strong>
                                    </span>
                                @endif
                              </div>
                            </div>


                            <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">City</label>

                              <div class="col-sm-8">
                                  <input type="text" name="city" class="form-control" placeholder="City" value="{{$usersList->user_city}}">
                                  @if ($errors->has('city'))
                                      <span class="help-block alert alert-danger">
                                      <strong>{{ $errors->first('city') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>


                            <div class="form-group {{ $errors->has('categorydesc') ? ' has-error' : '' }}">
                              <label class="col-sm-2 control-label">Post Code</label>

                              <div class="col-sm-8">
                                  <input type="text" name="postcode" class="form-control" placeholder="Post Code" value="{{$usersList->user_postcode}}">
                                  @if ($errors->has('postcode'))
                                      <span class="help-block alert alert-danger">
                                      <strong>{{ $errors->first('postcode') }}</strong>
                                      </span>
                                  @endif
                              </div>
                            </div>


                          </div>
                          <!-- /.box-body -->
                          <div class="box-footer">
                            <a href="{{url('admin/users')}}"><button type="button" class="btn btn-default pull-left">Back</button></a>

                            <button type="submit" class="btn btn-info pull-right">Update</button>
                          </div>
                          <!-- /.box-footer -->
                        </form>
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
