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
  <title>Transaction - Seralight.ID</title>
	@endsection
	@section('body')
  <div class="row">
    <div class="col-md-12">
       <div class="box">
    <div class="box-header">
      <h3 class="box-title">Transaction</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th width="30px">No</th>
          <th>Kode Transaksi</th>
          <th>Member</th>
          <th>Ekspedisi</th>
          <th>Status Pembayaran</th>
          <th>Status Pengiriman</th>
          <th>Menu</th>
        </tr>
        </thead>
        <tbody>
        @php
          $no = 1;
        @endphp
        @foreach($transaction as $tran)
        <tr>
          <td>{{ $no++ }}</td>
          <td>SR{{$tran->id_transaction}}</td>
          <td>{{$tran->user->name_user}}</td>
          <td>{{ $tran->ekspedition}}</td>
          <td>
            @if($tran->status_pembayaran == 'belum lunas')
                <a href="{{url('admin/transaction/' . $tran->id_transaction . '/' . $tran->status_pembayaran)}}" class="btn btn-primary btn-sm">Belum Lunas</a>
            @else
                <a href="{{url('admin/transaction/' . $tran->id_transaction . '/' . $tran->status_pembayaran)}}" class="btn btn-danger btn-sm">Sudah Lunas</a>
            @endif      
          </td>
          <td>
              @if($tran->status_pengiriman == '0')
                <a href="{{url('admin/transaction/pengiriman/' . $tran->id_transaction . '/' . $tran->status_pengiriman)}}" class="btn btn-primary btn-sm">Belum</a>
              @else
                <a href="{{url('admin/transaction/pengiriman/' . $tran->id_transaction . '/' . $tran->status_pengiriman)}}" class="btn btn-danger btn-sm">Sudah</a>
              @endif
          </td>
          <td>
            <a href="{{url('admin/transaction/detail/' .$tran->id_transaction . '/data')}}" class="btn btn-sm btn-success">Detail</a>
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

          <!-- /.box -->
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
