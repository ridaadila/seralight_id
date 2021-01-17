<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Storage;
use Alert;
// use SweetAlert;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all()->sortByDesc('id_product');
        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        return view('admin.product.add', compact('category'));
    }

    public function updatesuccess() {
        return view('admin.product.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $product = new Product;
        if($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if($request->file('foto')->isValid()) {
                $foto_name = date('YmdHis'). " .$ext";
                $upload_path = 'static/dist/img';
                $request->file('foto')->move($upload_path,$foto_name);
                $product->photo = $foto_name;
            }
        }
       
        $product->id_category = $request->category_id;
        $product->name_product = $request->nameproduct;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->id_user = Auth::user()->id_user;
        $product->save();
        Alert::success('Add Product', 'Product Berhasil ditambahkan');
        return redirect(route('product.index'));
        // Alert::success('Add Product', 'Product Berhasil ditambahkan');
        // return redirect()->back();
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
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('admin.product.edit', compact('product','category'));
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
        // dd($request);
        $product = Product::findOrFail($id);
        if($request->hasFile('foto')) {

            $exist = Storage::disk('foto')->exists($product->photo);
            if(isset($product->photo) && $exist) {
                $delete = Storage::disk('foto')->delete($product->photo);
            }

            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if($request->file('foto')->isValid()) {
                $foto_name = date('YmdHis'). " .$ext";
                $upload_path = 'static/dist/img';
                $request->file('foto')->move($upload_path,$foto_name);
                $product->photo = $foto_name;
            }
        }
       
        $product->id_category = $request->category_id;
        $product->name_product = $request->nameproduct;
        $product->description = $request->description;
        $product->stock = $request->stock;
        $product->price = $request->price;
        $product->weight = $request->weight;
        $product->id_user = Auth::user()->id_user;
        $product->save();
        Alert::success('Update Product', 'Product Berhasil diupdate');
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Alert::warning('Delete Product', 'Product Berhasil dihapus');
        return redirect('admin/product');
    }
}
