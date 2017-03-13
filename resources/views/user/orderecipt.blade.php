@extends('layouts.master')

@section('content')
<style relation="stylesheet">
@page {
    size: 225px 600px;
    margin: 0;
}
@media print {
    #header , #footer{
        visibility: hidden;
    }
    #container{
        visibility: visible;
        position: absolute;
        left: 0;
        top: 0;
    }
}
</style>

<div id="container">
  <div class="container">
    <div class="row">
      <!--Middle Part Start-->
          <div class="col-sm-3"></div>
          <div class="col-sm-5">
          <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading text-center">Order Reciept</div>
            <div class="panel-body">
                <div class="reciptlogo text-center" style="border-bottom:1px solid #ddd; padding-bottom:10px;" >
                    <img src="{{ URL::asset('/resources/assets/user/image/logo.png')}}"  alt="Arka-Anaya" style="width:150px;">
                </div>
                <div class="QR text-center">
                      <img src="https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl={{$orderid}}&choe=UTF-8" title="Link to Google.com" />
                      <p>OrderNo:#{{$orderid}}</p>
                </div>
                <div class="pull-left">
                    <h6>Account : <strong>{{$userenrll}}</strong></h6>
                </div>
                <div class="pull-right">
                    <h6>Time : <strong>{{$ordertime}}</strong></h6>
                </div>
            </div>
            <!-- Table -->
            <table class="table table-striped">
                <th>#</th>
                <th>ItemName</th>
                <th>Qty</th>
                <th>UnitPrice</th>
                <th>Total</th>

                @foreach ($cartdata->items as $item )
                    <tr>
                        <td>1</td>
                        <td><?php echo $item['item']->product_name; ?></td>
                        <td><?php echo $item['qty']; ?> </td>
                        <td><?php echo $item['price']; ?></td>
                        <td><?php echo $item['price'] * $item['qty'] ;?></td>
                    </tr>
                @endforeach

            </table>
            <br>
             <div class="panel-footer">
                <h3 class="pull-right">Grand Total : <i class="fa fa-inr"> </i> {{$cartTotal}} </h3>
                <div class="clearfix">
                </div>
             </div>
          </div>
          </div>
      <!--Middle Part End -->
    </div>
  </div>
</div>

@endsection
