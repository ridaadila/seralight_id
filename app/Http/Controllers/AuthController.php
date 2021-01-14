<?php

namespace App\Http\Controllers;
use Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Product;
use App\Parent_Category;
use App\Category;
use App\User;
use Mail;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class AuthController extends Controller
{
    protected $parent;
	public function __construct(){
		$this->parent = Parent_Category::all();
    }
    
    public function register() {
        $parent = $this->parent;
        return view('homepage.register', compact('parent'));
    }

    protected function store(Request $request)
    {
        $remember_token = base64_encode($request['email']);
        $mydata = ([
            'name_user' => $request['name'],
            'username'=> $request['username'],
            'email' => $request['email'],
            'address' => $request['address'],
            'phone' => $request['phone'],
            'gender' => $request['gender'],
            'birthday' => $request['birthday'],
            'role' => $request['role'],
            'password' => Hash::make($request['password']),
            'remember_token' => $remember_token,
        ]);
        User::create($mydata);
        Mail::send('home', array('firstname'=>$request['name'], 'remember_token'=>$remember_token), function ($message) use($request) {
            $message->from('seralightid@gmail.com', 'SERALIGHT.ID');
            $message->to($request['email'], 'Verifikasi');
            $message->subject('Verifikasi Email untuk Pendaftaran pada SERALIGHT.ID');
        });
        Alert::info('Register', 'Pendaftaran selesai, silahkan cek email anda untuk verifikasi akun');
        return redirect('/');
    }

    public function verifikasi($token) {
        $user = User::where('remember_token','=',$token)->first();
        if($user->status=='0') {
            $user->status = '1';
        }
        $user->save();
        Alert::success('Verifikasi Akun', 'Verifikasi akun sukses, silahkan login');
        return redirect('/');
    }

    public function login(Request $request) {
        $email = $request->email;
        $pwd = $request->password;

        if(Auth::attempt(['email' => $email, 'password' => $pwd])) {
            $cek = User::where('id_user','=',Auth::user()->id_user)->first();
            if($cek->status==0) {
                Auth::logout();
                Alert::info('Belum verifikasi akun','Maaf akun belum terverifikasi. Silahkan cek email untuk verifikasi');
                return redirect('/');
            }
            else {
                Alert::success('Login success','Berhasil login');
                return redirect()->back();
            }
        }
        else {
            Alert::warning('Login gagal','Maaf email atau password tidak sesuai');
            return redirect('/');
        }
    }
}
