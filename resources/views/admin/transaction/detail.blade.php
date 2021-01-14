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
  <title>Detail Transaksi - Seralight.ID</title>
	@endsection
	@section('body')
  <div class="row">
     <section class="invoice">
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Detail Transaksi
            {{-- <small class="pull-right">code:  {{ $transaction->code }}</small> --}}
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-md-6">
           <div class="col-sm-2 invoice-col">
          <b>DETAIL PEMBELI : </b>
        </div>
          <div class="col-sm-9 invoice-col">
            <p>Nama pembeli : {{ $transaction->user->name_user }} </p><br>
            <p> Alamat : {{ $transaction->address_receiver }} </p> , 
            {{$transaction->kota }} ,
            {{$transaction->provinsi }} , 
            {{$transaction->portal_code}} <br>
        </div>
         {{-- <div class="col-sm-2 invoice-col">
          <b>Pengirim</b>
        </div>
          <div class="col-sm-9 invoice-col">
            {{ $transaction->user->name_user }}<br>
            {{ $transaction->user->address }}<br>
        </div> --}}
        </div>
         <div class="col-md-6">
        <div class="col-sm-2 invoice-col">
          <b>Ekspedisi</b>
        </div>
        <div class="col-sm-9 invoice-col">
            Code - SR{{ $transaction->id_transaction }} <br>
            Name - {{ $transaction->ekspedition }} <br>
            Lama pengiriman : {{$transaction->lama_kirim}} hari <br>
            {{-- Time - {{ $transaction->ekspedisi['etd'] }} day <br> --}}
        </div>
        <div class="col-sm-2 invoice-col">
          <b>Status </b>
        </div>
        <div class="col-sm-9 invoice-col">
            @if($transaction->status_pembayaran == 'belum lunas')
              Status Pembayaran : Belum Lunas
            @else
              Status Pembayaran :Lunas
            @endif
        </div>
        </div>
      </div>
      <br>
      <!-- /.row -->
      <hr>
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>No</th>
              <th>Quantity</th>
              <th>Product</th>
              <th>Price</th>
              <th>Sub Total</th>
            </tr>
            </thead>
            <tbody>
              @php
                $no = 1;
              @endphp
              @foreach($transaction->product as $detil)
                <tr>
                  <td> {{ $no++ }}</td>
                  <td>{{ $detil->pivot->quantity }}</td>
                  <td> {{ $detil->name_product }}</td>
                  <td> Rp.{{ number_format($detil->price,2,",",".") }}</td>
                  <td> Rp.{{ number_format($detil->price * $detil->pivot->quantity,2,",",".") }}</td>
                </tr>
                
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">Rekening Bank</p>
          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Halaman ini merupakan halaman transaksi, pengiriman pembayaran di lakukan melalui rekening bank.
          </p>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th style="width:50%">Subtotal: Rp.{{number_format($transaction->subtotal)}}</th>
                {{-- <td> {{ number_format($gt,2,",",".") }}</td> --}}
              </tr>
              <tr>
                <th>Ongkir: Rp.{{ number_format($transaction->biaya_ongkir)}}</th>
                {{-- <td>{{ number_format($transaction->ekspedisi['value'],2,",",".") }}</td> --}}
              </tr>
              <tr>
                <th>Grand Total: Rp.{{number_format($transaction->total_harga)}}</th>
                {{-- <td> --}}
                  {{-- <?php echo number_format($gt + $transaction->ekspedisi['value'], 2, ",", "."); ?> --}}
                {{-- </td> --}}
              </tr>
            </table>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- this row will not appear when printing -->
      <div class="row no-print">
        <div class="col-xs-12">
          <a class="btn btn-primary pull-right"  style="margin-right: 5px;"
              href="{{ url('admin/transaction/detail/'.$transaction->id_transaction.'/data/cetak') }}">
              <i class="fa fa-download"></i> Generate PDF
              </a>
        </div>
      </div>
    </section>
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