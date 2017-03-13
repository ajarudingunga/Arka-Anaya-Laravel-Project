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
                    <h4 class="modal-title" id="myModalLabel">Add Product</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" action="{{url('admin/product')}}" method="post" enctype="multipart/form-data">

                      <div class="form-group {{ $errors->has('productname') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">Name</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                            id="productname" name="productname" placeholder="New Product Name" value="{{ old('productname') }}"/>

                            @if ($errors->has('productname'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('productname') }}</strong>
                                </span>
                            @endif

                        </div>
                      </div>

                      <div class="form-group {{ $errors->has('productprice') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">Price</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control"
                            id="productprice" name="productprice" placeholder="Product Price" value="{{old('productprice')}}"/>
                            @if ($errors->has('productprice'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('productprice') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>

                      <div class="form-group {{ $errors->has('categoryname') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">Category</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="categoryname">
                                <option value="">--Please select--</option>
                                @foreach ($getCategory as $key => $getCategory)
                                    <option value="{{$getCategory->id}}">{{$getCategory->category_name}}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('categoryname'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('categoryname') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>

                       <div class="form-group {{ $errors->has('foodtype') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">Type</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="foodtype">
                                <option value="{{ old('foodtype') ? old('foodtype') : '' }}">
                                    {{ old('foodtype') ? old('foodtype') : '--Please select--' }}</option>


                                <option value="Veg">Veg</option>
                                <option value="Jain">Jain</option>
                                <option value="n-Veg">n-Veg</option>
                            </select>
                            @if ($errors->has('foodtype'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('foodtype') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>

                      <div class="form-group {{ $errors->has('productImage') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="inputEmail3">Image</label>
                        <div class="col-sm-8" style="min-height: 30px;">
                            <input type="file"
                            id="productImage" name="productImage" accept="image/*"/>
                            @if ($errors->has('productImage'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('productImage') }}</strong>
                                </span>
                            @endif
                        </div>
                      </div>

                      <div class="form-group {{ $errors->has('productdesc') ? ' has-error' : '' }}">
                        <label  class="col-sm-4 control-label"
                                  for="">Description</label>
                        <div class="col-sm-8">
                            <textarea name="productdesc" class="form-contorl" placeholder="Description" style="width:100%;"></textarea>
                            @if ($errors->has('productdesc'))
                                <span class="help-block alert alert-danger">
                                <strong>{{ $errors->first('productdesc') }}</strong>
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
            <h1>Products</h1>
            <ol class="breadcrumb">
                <li><a href="{{url('admin/dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Products</li>
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
                    <button type="button" class="btn btn-block btn-primary btn-lg" data-toggle="modal" data-target="#myModal">New Product</button>
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
                                        <th class="col-md-1">SR.NO</th>
                                        <th class="col-md-2">Product Name</th>
                                        <th class="col-md-1">Price</th>
                                        <th class="col-md-2">Category</th>
                                        <th >Type</th>
                                        <th >Image</th>
                                        <th class="col-md-3">Description</th>
                                        <th>Status</th>
                                        <th class="col-md-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($productData as  $key=>$productData)
                                    <tr>
                                        <td>{{++$key }}</td>

                                        <td>{{$productData->product_name}}</td>

                                        <td><i class="fa fa-rupee">&nbsp;</i>{{ $productData->product_price}}</td>

                                        <td>
                                            {{
                                            $result = Helper::getCategoryName($productData->product_category_id)
                                            }}
                                        </td>

                                        @if ($productData->product_type=='Veg')
                                            <td class="text-green">Veg</td>
                                        @elseif ($productData->product_type=='Jain')
                                            <td class="text-warning">Jain</td>
                                        @elseif ($productData->product_type=='n-Veg')
                                            <td class="text-danger">n-Veg</td>
                                        @endif

                                        <td><img style="height:30px;width:30px;" src=" {{ URL:: asset('/resources/uploads/avatars/'.$productData->product_image_url)}}"></td>
                                        <td>{{$productData->product_description}}</td>

                                        @if ($productData->product_status=='1')
                                            <td class="text-green">Active</td>
                                        @else
                                            <td class="text-danger">Deactive</td>
                                        @endif

                                        <td>
                                            <a href="{{url('admin/product/delete', ['id' => $productData->id])}}" class="btn btn-social-icon btn-danger" title="Delete" onclick="return confirm('Are you sure you want to Delete?');">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                            <a href="" class="btn btn-social-icon btn-success" title="Update">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>

                                            @if ($productData->product_status=='0')
                                                <a href="{{ url('admin/product/toggleStatus', ['id' => $productData->id])}}" class="btn btn-social-icon btn-danger" title="click to Activate">
                                                    <i class="fa fa-toggle-off"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('admin/product/toggleStatus', ['id' => $productData->id])}}" class="btn btn-social-icon btn-primary" title="click to Deactivate">
                                                    <i class="fa fa-toggle-on"></i>
                                                </a>
                                            @endif


                                            @if ($productData->featured=='1')
                                                <a href="{{ url('admin/product/toggleFeatured', ['id' => $productData->id])}}" class="btn btn-social-icon btn-warning" title="click to Remove from Featured">
                                                    <i class="fa fa-quote-right"></i>
                                                </a>
                                            @else
                                                <a href="{{ url('admin/product/toggleFeatured', ['id' => $productData->id])}}" class="btn btn-social-icon btn-grey" title="click to Make Featured">
                                                    <i class="fa fa-quote-right"></i>
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
