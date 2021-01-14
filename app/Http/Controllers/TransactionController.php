<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use Alert;
use PDF;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::all();
        return view('admin.transaction.index', compact('transaction'));
    }


    public function status($id, $status) {
        if($status == 'belum lunas'){
			$change = 'lunas';
		}else{
			$change = 'belum lunas';
		}

        $transaction = Transaction::findOrFail($id);
        $transaction->status_pembayaran = $change;
        $transaction->save();
		Alert::success('Update Status Pembayaran', 'Status Pembayaran berhasil diperbarui');
        return redirect('admin/transaction');
    }

    public function pengiriman($id, $status) {
        if($status == '0'){
			$change = '1';
		}else{
			$change = '0';
		}

        $transaction = Transaction::findOrFail($id);
        $transaction->status_pengiriman = $change;
        $transaction->save();
		Alert::success('Update Status Pengiriman', 'Status Pengiriman berhasil diperbarui');
        return redirect('admin/transaction');
    }

    public function detail($id) {
        $transaction = Transaction::findOrFail($id);
        // $users = Transaction::findOrFail($id);
        return view('admin.transaction.detail', compact('transaction'));
    }

    public function cetakpdf($id){
        $data['transaction'] = Transaction::findOrFail($id);
        $pdf = PDF::loadView('admin.transaction.cetakpdf', $data);
		return $pdf->download('admin.transaction.pdf');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
