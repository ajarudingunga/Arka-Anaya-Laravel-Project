@extends('admin.layouts.adminMaster')

@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->


        <section class="content-header">
            <h1>Orders</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Orders</li>
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
                            <h3 class="box-title">Orders</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>At</th>
                                        <th>Items</th>
                                        <th>Quntity</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                    <tr>
                                        <td># {{$order->id}}</td>
                                        <td>{{$order->created_at}}</td>
                                        <td><table>
                                         @foreach ($order->cart->items as $key => $item)

                                                 <tr>
                                                     <td>
                                                         <?php
                                                           print_r($item['item']->product_name);
                                                         ?>
                                                     </td>
                                                 </tr>

                                         @endforeach
                                          </table>
                                         </td>

                                         <td><table>
                                          @foreach ($order->cart->items as $key => $item)

                                                  <tr>
                                                      <td>
                                                          {{$item['qty']}}
                                                      </td>
                                                  </tr>

                                          @endforeach
                                           </table>
                                          </td>
                                          <td>{{$order->cart->totalPrice}}</td>
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
