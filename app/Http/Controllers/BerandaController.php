<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Parent_Category;
use App\Category;
use App\User;
use Auth;
use Alert;
use Storage;

class BerandaController extends Controller
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
    public function index()
    {
        $parent = $this->parent;
        $product = Product::take(12)->orderBy('id_product', 'DESC')->get();
        return view('homepage.homepage', compact('product','parent'));
    }

    public function product() {
        $parent = $this->parent;
        $product = Product::orderBy('id_product','DESC')->paginate(8);
        return view('homepage.product', compact('product','parent'));
    }

    public function productbycategory($id) {
        $parent = $this->parent;
        $parents = Parent_Category::all();
        $category = Category::findOrFail($id);
        return view('homepage.productbycategory', compact('category','parent','parents'));
    }

    public function detail($id) {
        $product = Product::findOrFail($id);
        $parents = Parent_Category::all();
        $parent = $this->parent;
        return view('homepage.detail', compact('product','parent','parents'));
    }
    public function penjual() {
        $parent = $this->parent;
        $supplier = User::orderBy('id_user','DESC')->where('status','1')->where('role','!=','member')->get();
        return view('homepage.supplier', compact('supplier','parent'));
    }

    public function productbypenjual($id) {
        $parent = $this->parent;
        $penjual = User::findOrFail($id);
        return view('homepage.productbypenjual', compact('penjual','parent'));
    }

    public function myprofil() {
        $parent = $this->parent;
        $user = User::where('id_user',Auth::user()->id_user)->first();
        return view('homepage.myprofil', compact('parent','user'));
    }

    public function updateprofil(Request $request) {

        $user = User::findOrFail($request->id);
        if($request->hasFile('foto')) {

            $exist = Storage::disk('foto')->exists($user->photo);
            if(isset($user->photo) && $exist) {
                $delete = Storage::disk('foto')->delete($user->photo);
            }

            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            if($request->file('foto')->isValid()) {
                $foto_name = date('YmdHis'). " .$ext";
                $upload_path = 'static/dist/img';
                $request->file('foto')->move($upload_path,$foto_name);
                $user->photo = $foto_name;
            }
        }
        // $mydata = ([
        //     'name_user' => $request['name'],
        //     'username'=> $request['username'],
        //     'email' => $request['email'],
        //     'address' => $request['address'],
        //     'phone' => $request['phone'],
        //     'gender' => $request['gender'],
        //     'birthday' => $request['birthday'],
        //     'role' => $request['role'],
        //     // 'password' => bcrypt($request['password']),
        //     // 'photo' => $request['foto'],
        // ]);

        $user->name_user = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->gender = $request->gender;
        $user->birthday = $request->birthday;
        $user->role = $request->role;
        $user->save();
        // User::where('id_user',$request->id)->update($mydata);
        Alert::success('Update Akun User', 'Akun berhasil diupdate');
        return redirect('myprofil');
    }

    public function logout(){
        Auth::logout();
        Alert::success('Logout','Berhasil keluar');
        return redirect('/');
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
