<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Auth;
use App\Category;
use App\User;
use App\Transaction;
use App\Parent_Category;
use App\Digunakan;
use Cart;
use Alert;
use Illuminate\Support\Str;
use Storage;

ini_set('max_execution_time', 180);
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $parent;
	public function __construct(){
		$this->parent = Parent_Category::all();
	}
    public function index(Request $request)
    {
        // $parent = $this->parent;
        // Cart::clear();
        $product = Product::findOrFail($request->id_product);
        $userid = Auth::user()->id_user; // or any string represents user identifier
        // Cart::session($userid)->clear();
        $id = $product->name_product;
        Cart::session($userid)->add([
            'id' => $id,
            'name' => $product->name_product,
            'price' => $product->price,
            'quantity' => $request->qty,
            'associatedModel'=>$product,
        ]);
        // return Cart::session($userid)->getContent();
        return redirect('keranjang');
    }

    public function keranjang() {
        $parent = $this->parent;
        $userid = Auth::user()->id_user;
        $cart = Cart::session($userid)->getContent();
        return view('homepage.keranjang',compact('parent','cart'));
    }

    public function update(Request $request)
    {
        $parent = $this->parent;
        $userid = Auth::user()->id_user;
        Cart::session($userid)->update($request->rowid, array(
            'quantity' => array(
                'relative' => false,
                'value' => $request->qty,
            ),
          ));
        // return Cart::getContent();
        return redirect('keranjang');
    }

    public function delete($id){
        $userid = Auth::user()->id_user;
        Cart::session($userid)->remove($id);
        return redirect('keranjang');
    }

    public function formulir(){
        $parent = $this->parent;
        $userid = Auth::user()->id_user;
        $cart = Cart::session($userid)->getContent();
        return view('homepage.formulir', compact('parent','cart'));
        // echo city();
    }

    public function transaction(Request $request) {

        $userid = Auth::user()->id_user;
        $cart = Cart::session($userid)->getContent();
        $quantitytotal = Cart::session($userid)->getTotalQuantity();
        $subtotal = Cart::session($userid)->getSubTotal();

        $transaction = new Transaction;
        $transaction->id_user = $userid;
        $transaction->save();
        $temp = $transaction->id_transaction;
        foreach($cart as $row){
            $product = Product::findOrFail($row->associatedModel->id_product);
          
            $city = json_decode(city(),true);
            $weight = $product->weight * $row->quantity;
            foreach ($city['rajaongkir']['results'] as $key ) {
                $product->stock = $product->stock - $row->quantity;
                $product->save();
                if($request->city==$key['city_id']){
                     
                     $data = json_decode(cost(20,$request->city,$weight,$request->eks),true);
                    //  Cart::update($row->id,array(
                    //      'attributes'=> array (
                    //         'code'  => $data['rajaongkir']['results'][0]['code'],
                    //         'name'  => $data['rajaongkir']['results'][0]['name'],
                    //         'value' => $data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'],
                    //         'etd'   => $data['rajaongkir']['results'][0]['costs'][0]['cost'][0]['etd']
                    //  )));

                    //  $eks = [
                    //     'code' =>  $row->options->code, 
                    //      'name' =>$row->options->name,
                    //      'value' => $row->options->value,
                    //      'etd' =>$row->options->etd
                    //  ];
                     $digunakan = new Digunakan;
                     $digunakan->id_transaction = $temp;
                     $digunakan->id_product = $product->id_product;
                     $digunakan->quantity = $row->quantity;
                     $digunakan->save();
                     
                     Cart::session(Auth::user()->id_user)->remove($row->id);
                
                }   

            }

            if(count($cart) == 0)
            {
               return redirect('cart/myorder');
            }
           
        }
        $city = json_decode(city(),true);
        $cost = json_decode(cost(20,$request->city,$weight,$request->eks),true);

        $transaction = Transaction::findOrFail($temp);
        $transaction->quantity_total = $quantitytotal;
        $transaction->biaya_ongkir = $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        // echo  $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        $transaction->subtotal = $subtotal;
        $transaction->total_harga = $subtotal + $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['value'];
        $transaction->lama_kirim = $cost['rajaongkir']['results'][0]['costs'][0]['cost'][0]['etd'];
        $transaction->address_receiver = $request->addressreceiver;
        $transaction->kota = $city['rajaongkir']['results'][0]['city_name'];
        $transaction->provinsi = $city['rajaongkir']['results'][0]['province'];
        $transaction->portal_code = $request->portal_code;
        $transaction->ekspedition = $request->eks;
        $transaction->save();

        return redirect('cart/myorder');
    }

    public function myorder(){
        $parent = $this->parent;
        $transaction = Transaction::where('id_user', Auth::user()->id_user)->get();
        return view('homepage.myorder',compact('parent','transaction'));
    }

    public function detail($id){
        $parent = $this->parent;
        $transaction = Transaction::findOrFail($id);
        return view('homepage.detailtransaksi',compact('parent','transaction'));
    }

    public function product() {
        $parent = $this->parent;
        $product = Product::where('id_user',Auth::user()->id_user)->get();
        return view('homepage.myproduct',compact('product','parent'));
    }

    public function addproduct(){
        $parent = $this->parent;
        $category = Category::all();
        return view('homepage.addproduct',compact('parent','category'));
    }

    public function saveproduct(Request $request) {
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
        return redirect('myproduct');
    }

    public function editproduct($id) {
        $parent = $this->parent;
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('homepage.editproduct', compact('product','category','parent'));
    }

    public function updateproduct(Request $request) {
        $id = $request->id;
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
        return redirect('myproduct');
    }

    public function deleteproduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        Alert::warning('Delete Product', 'Product Berhasil dihapus');
        return redirect('myproduct');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
