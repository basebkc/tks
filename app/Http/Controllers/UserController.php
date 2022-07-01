<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kantor;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\PasswordValidationRules;
use Laravel\Jetstream\Jetstream;
use Storage;
use Auth;


class UserController extends Controller
{
    use PasswordValidationRules;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        //
        $akses   = Auth::user();
        $namakantor = Kantor::where('kd_kan',$akses->kode_kantor)->first();

        $kantor     = Kantor::all();
        $user       = User::all();
        $role       = DB::table('role')->get();
        return view('backend.user.list',compact('kantor','user','role','akses','namakantor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   

        if(!is_null($request->id)){
            
            $result = User::where('email',$request->email)
                    ->update([
                        'name' =>$request->name,
                        'role_id' => $request->role_id,
                        'kode_kantor' => $request->kantor,
                    ]);

            
        }else{

            Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => $this->passwordRules(),
                'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
            ])->validate();
            
            $result = User::create([
                'name' =>$request->name,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'kode_kantor' => $request->kantor,
                'password' => Hash::make($request->password),
            ]);


        }
        

        $message = [
            'status' => TRUE,
            'message'   => 'Data berhasil di simpan',
            'info'   => $result
        ];
    

        return response()->json($message,200);

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
        $data = User::find($id);
        return response()->json(['data' => $data],200);
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


    public function getfile(){
        
        $url = Storage::disk('filecenter')->get('/ktp/11.jpg');
        
        return view('welcome',compact('url'));
    }

}
