@extends('admin.layout.master')
	@section('header')
      <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('static/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
  <style type="text/css">
    .table_list {
      list-style: none;
      padding: 3px;
      margin-left: -30px;
    }
  </style>
  <title>Update Category - Seralight.ID</title>
	@endsection
	@section('body')
  <div class="row">
    <div class="col-md-12">
       <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Update Parent Category</h3>
            </div>
            <form role="form" action="{{url('admin/parent/'. $parent->id_parent)}}" method="POST">
            {{ csrf_field() }}
            {{ method_field('PUT')}}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Parent Category" name="parentname" value="{{ $parent->parent_name }}">
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
	@endsection
	@section('footer')
		  <!-- DataTables -->
  <script src="{{ asset('static/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('static/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
  <script>
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
</script>
	@endsection
@show
