@extends('admin.layouts.adminMaster')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <section class="content-header">
            <h1>Recharge Center</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Recharge</li>
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
                            <h3 class="box-title">New Recharge</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Enter Enrollment or StaffID</h5>
                            <form class="" action="" method="post">
                                <div class="col-sm-5">
                                    <input class="form-control input-lg" type="text" name="enrollment" placeholder="e.g 140043131005" autofocus value="{{old('enrollment')}}">
                                    @if ($errors->has('enrollment'))
                                        <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('enrollment') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control input-lg" type="text" name="amount" placeholder="Amount"  value="{{old('amount')}}">
                                    @if ($errors->has('amount'))
                                        <span class="help-block alert alert-danger">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                        </span>
                                    @endif

                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-block btn-info btn-lg">PROCEED</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>



                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Transactions</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Transaction ID</th>
                                        <th>To Account</th>
                                        <th>Amount</th>
                                        <th>When</th>
                                        <th>Transaction State</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($alltansactionResult as  $key=>$alltansactionResult)
                                    <tr>

                                        <td>{{$alltansactionResult->id}}</td>
                                        <td>{{$alltansactionResult->enrollment}}</td>
                                        <td>{{$alltansactionResult->amount}}</td>
                                        <td>{{$alltansactionResult->created_at}}</td>

                                        @if ($alltansactionResult->status=='1')
                                            <td class="text-green">Success</td>
                                        @else
                                            <td class="text-danger">Failed</td>
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

    <script type="text/javascript">
       $(function() {
           $('#example1').DataTable({
               "paging": true,
               "lengthChange": true,
               "searching": true,
               "ordering": false,
               "info": true,
               "autoWidth": true
           });
       });
   </script>

@endsection
