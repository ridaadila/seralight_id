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
  <title>Category - Seralight.ID</title>
	@endsection
	@section('body')
  <div class="row">
    <div class="col-md-4">
       <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Category</h3>
            </div>
            <form role="form" action="{{ url('admin/category') }}" method="POST">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control"  placeholder="Enter Category" name="categoryname">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Parent Category</label>
                  <select class="form-control" name="id_parent">
                     {{-- <option value="">Select</option> --}}
                     @foreach($parent_category as $parent)
                        <option value="{{$parent->id_parent}}">{{$parent->parent_name }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
    </div>
    <div class="col-md-8">
       <div class="box">
    <div class="box-header">
      <h3 class="box-title">Category</h3>
    </div>
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>No</th>
          {{-- <th width="400px">Parent Category</th> --}}
          <th width="400px">Category</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
          @php
              $no = 1;
          @endphp
          @foreach($parent_category as $parent)
          <tr>
            <td width="40px">{{ $no++ }}</td>
            <td>{{ $parent->parent_name }}
              <ul>
                @foreach($parent->category as $category)
                   <li class="table_list"> - {{ $category->category_name }} </li>
                @endforeach
              </ul>
            </td>
            <td>
            <form action="{{ route('parent.destroy', $parent->id_parent)}}" method="post">
              <a href="{{url('admin/parent/'. $parent->id_parent)}}" class="btn btn-primary  btn-xs">Edit</a>
              {{ csrf_field() }}
              {{ method_field('DELETE')}}
              <input type="submit" name="" value="Delete" class="btn btn-danger  btn-xs">
             </form>
              <ul>
                @foreach($parent->category as $category)
                   <form action="{{ route('category.destroy', $category->id_category)}}" method="post">
                   <li class="table_list"  style="margin-left: -43px"> <a href="{{url('admin/category/'. $category->id_category)}}" class="btn btn-primary  btn-xs">Edit</a>
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}
                        <input type="submit" name="" value="Delete" class="btn btn-danger btn-xs">
                       </form>
                   </li>
                @endforeach
              </ul>
            </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.box-body -->
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
