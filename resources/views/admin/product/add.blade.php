@extends('admin.layout.master')
	@section('header')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('static/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <style type="text/css">
    .table_list {
      list-style: none;
      padding: 4px;
      margin-left: -30px;
    }
  </style>
  <title>Add Product - Seralight.ID</title>
  @endsection
  <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
  <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
	@section('body')
  <div class="row">
    <div class="col-md-12">
       <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Product</h3>
            </div>
            <form role="form" action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{-- {{ method_field('PUT')}} --}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Product" name="nameproduct">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                 <textarea id="description" name="description" class="form-control" placeholder="Enter description"></textarea>
                
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Stock</label>
                  <input type="text" class="form-control"  placeholder="Enter your Stock" name="stock">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Price</label>
                  <input type="text" class="form-control"  placeholder="Enter your Price" name="price">
                </div>
                 <div class="form-group">
                  <label for="exampleInputEmail1">Weight ( gram )</label>
                  <input type="text" class="form-control"  placeholder="Enter your Weight" name="weight">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Category</label>
                  <select class="form-control" name="category_id">
                     {{-- <option value="">Select</option> --}}
                     @foreach($category as $cat)
                        <option value="{{ $cat->id_category }}">{{ $cat->category_name }}</option>
                        {{-- @foreach($category ->children as $sub)
                        <option value="{{ $sub->id }}"> - {{ $sub->name }}</option>
                        @endforeach --}}
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Photo</label>
                  <input type="file" class="form-control"  placeholder="Enter Icon Font Awesome" name="foto">
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>
  </div>
   
          <!-- /.box -->
	@endsection
	@section('footer')
		  <!-- DataTables -->
  <script src="{{ asset('static/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('static/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  {{-- <script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script> --}}
{{-- <script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'description', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
</script> --}}

  {{-- <script>
   var route_prefix = "{{ url(config('lfm.url_prefix', config('lfm.prefix'))) }}";
  </script> --}}

  <!-- CKEditor init -->
  {{-- <script>
    $('textarea[name=description]').ckeditor({
      height: 300,
      filebrowserImageBrowseUrl: route_prefix + '?type=Images',
      filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: route_prefix + '?type=Files',
      filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}'
    });
  </script> --}}
{{-- 
  <script>
    {!! \File::get(base_path('vendor/unisharp/laravel-filemanager/public/js/lfm.js')) !!}
  </script>
  <script>
    $('#lfm').filemanager('image', {prefix: route_prefix});
    $('#lfm2').filemanager('file', {prefix: route_prefix});
  </script>

  <script>
    $(document).ready(function(){ --}}

      {{-- // Define function to open filemanager window
      var lfm = function(options, cb) {
          var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
          window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
          window.SetUrl = cb;
      };

    });
  </script> --}}
	@endsection
@show