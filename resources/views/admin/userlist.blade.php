@extends('admin.layouts.adminMaster')


@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <section class="content-header">
            <h1>Users</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">User Listing</li>
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
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr >
                                        <th>SR.NO</th>
                                        <th>Type</th>
                                        <th>Name</th>
                                        <th>Dept</th>
                                        <th>Enrollment</th>
                                        <th>Mobile</th>
                                        <th>ResideAtCampus</th>
                                        <th>Balance</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($usersList as  $key=>$usersList)
                                    <tr>
                                        <td>{{++$key }}</td>
                                        @if ($usersList->user_type=='Staff')
                                            <td class="text-warning">{{$usersList->user_type}}</td>
                                        @else
                                            <td class="text-blue">{{$usersList->user_type}}</td>
                                        @endif

                                        <td>{{$usersList->user_firstname}} {{$usersList->user_lastname}} </td>
                                        <td>{{$usersList->user_department}}</td>
                                        <td>{{$usersList->enrollment}}</td>

                                        <td>{{$usersList->user_mobileno}}</td>

                                        @if ($usersList->user_resiatcapus=='1')
                                            <td class="text-green">YES</td>
                                        @else
                                            <td class="text-danger">NO</td>
                                        @endif

                                        @if ($usersList->user_balance =='0')
                                            <td class="text-danger">{{$usersList->user_balance }}</td>
                                        @else
                                            <td class="text-green">{{$usersList->user_balance }}</td>
                                        @endif

                                        <td>
                                            <a href="{{ url('admin/users/view', ['id' => $usersList->userId])}}" class="btn btn-social-icon btn-success" title="View And Update">
                                                <i class="fa fa fa-eye"></i>
                                            </a>
                                            @if ($usersList->status=='-1')
                                                <a href="{{ url('admin/users/block', ['id' => $usersList->userId])}}" class="btn btn-social-icon btn-danger" title="click to Unblock User">
                                                    <i class="fa fa-lock"></i>
                                                </a>
                                            @elseif ($usersList->status=='1')
                                                <a href="{{ url('admin/users/block', ['id' => $usersList->userId])}}" class="btn btn-social-icon btn-primary" title="click to Block User">
                                                    <i class="fa fa-unlock"></i>
                                                </a>
                                            @else
                                                <a href="#" class="btn btn-social-icon btn-warning" title="User request yet not Approved">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            @endif
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
