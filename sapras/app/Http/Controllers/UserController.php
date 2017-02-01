<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Statu;
use App\Kondisi;
use App\Ruangan;
use App\Sarana;
use App\Prasarana;
use App\User;
use App\Sarana_pinjam;
use Auth;
use Illuminate\Support\Facades\Hash;
use DB;
class UserController extends Controller
{
    public function olah_user(){
    $hak=DB::table('user_hak_akses')->get();
    $user=DB::table('users')->leftjoin('user_hak_akses','users.user_hak_akses_id','user_hak_akses.id')->select('users.*','user_hak_akses.user_hak_akses')->where('username','!=',Auth::user()->username)->get();
    $guru=DB::table('ak_guru')->get();
    $siswa=DB::table('ak_siswa')->get();
    $no=1;
    return view("guru.olah_user",compact("hak","no","user","guru","siswa"));
    }

    public function simpan_user(Request $request){
    if($request['user_hak_akses']==1)
    {
        $this->validate($request,[
        'username' => 'required|max:255|unique:users,username|exists:ak_guru,nip',
        'password' => 'required|min:6|confirmed',
        ]);
        $user = new User;
            $user->nip =  Auth::user()->username;
            $user->username =$request['username'];
            $user->name = "Administrator";
            $user->status = "1";
            $user->password = bcrypt($request['password']);
            $user->user_hak_akses_id = $request['user_hak_akses'];
        $user->save();
    }
    elseif($request['user_hak_akses']==2)
    {
        $this->validate($request,[
        'username' => 'required|max:255|unique:users,username|exists:ak_guru,nip',
        'password' => 'required|min:6|confirmed',
        ]);
        $user = new User;
            $user->nip =  Auth::user()->username;
            $user->username =$request['username'];
            $user->name = "Operator";
            $user->status = "1";
            $user->password = bcrypt($request['password']);
            $user->user_hak_akses_id = $request['user_hak_akses'];
        $user->save();
    }
    elseif ($request['user_hak_akses']==3) {
       $this->validate($request,[
        'username' => 'required|max:255|unique:users,username|exists:ak_siswa,nis',
        'password' => 'required|min:6|confirmed',
        ]);
        $user = new User;
        $user->username =$request['username'];
            $user->nip =  Auth::user()->username;
            $user->name = "Siswa";
            $user->status = "1";
            $user->password = bcrypt($request['password']);
            $user->user_hak_akses_id = $request['user_hak_akses'];
        $user->save();
    }
        
        $request->session()->flash('alert-success', 'User Telah Berhasil Ditambah');    
        return redirect()->route("guru.user");
    }
    public function lihat_user(User $id){
    if($id['user_hak_akses_id']==1||$id['user_hak_akses_id']==2){
        $user=DB::table('users')->join('ak_guru','users.username','=','ak_guru.nip')->select('users.*','ak_guru.namaguru','user_hak_akses.user_hak_akses')->join('user_hak_akses','user_hak_akses.id','users.user_hak_akses_id')->where('users.username',$id['username'])->get();

    }
    elseif ($id['user_hak_akses_id']==2) {
        $user=DB::table('users')->join('ak_guru','users.username','=','ak_guru.nip')->select('users.*','ak_guru.namaguru','user_hak_akses.user_hak_akses')->join('user_hak_akses','user_hak_akses.id','users.user_hak_akses_id')->where('users.username',$id['username'])->get();        
    }
    elseif ($id['user_hak_akses_id']==3) {
        $user=DB::table('users')->join('ak_siswa','users.username','=','ak_siswa.nis')->join('user_hak_akses','user_hak_akses.id','users.user_hak_akses_id')->select('users.*','ak_siswa.nisn','ak_siswa.namasiswa','ak_siswa.jurusan','user_hak_akses.user_hak_akses')->where('users.username',$id['username'])->get();
    }
    
	return view("guru.detail_user",compact("user"))    ;	
    }
    public function edit_user(User $id){
    $user=$id;	
    return view("guru.update_user",compact("user"))    ;
    }
    public function naik_user(Request $request,$id){
    User::where('id',$id)
                ->update([
                    'name'=>'Administrator',
                	'user_hak_akses_id'=>1,'nip' =>  Auth::user()->username]);
    $request->session()->flash('alert-success', 'User Telah Berhasil Dirubah Menjadi Administrator');                 
     return back();	
    }
    public function turun_user(Request $request,$id){
    User::where('id',$id)
                ->update([
                    'name'=>'Operator',
                	'user_hak_akses_id'=>2,'nip' =>  Auth::user()->username]);
    $request->session()->flash('alert-warning', 'User Telah Berhasil Dirubah Menjadi Operator'); 
    return back();	
    }

    public function aktif_user(Request $request,$id){
    User::where('id',$id)
                ->update([
                    'status'=>1,'nip' =>  Auth::user()->username]);
     $request->session()->flash('alert-success', 'User Telah Berhasil Diaktifkan');            
     return back(); 
    }
    public function nonaktif_user(Request $request,$id){
    User::where('id',$id)
                ->update([
                    'status'=>0,'nip' =>  Auth::user()->username]);
    $request->session()->flash('alert-danger', 'User Telah Berhasil Dinonaktifan'); 
    return back();  
    }

    public function update_user(Request $request,User $id){
    if($request['user_hak_akses']==1)
    {
        $this->validate($request,[
        'username' => 'required|max:255|exists:ak_guru,nip',
        'password' => 'required|min:6|confirmed',
        ]);
       
         User::where('id','=',$id['id'])
                ->update([
                    'password'=>bcrypt($request['password']),
                    'username'=>$request['username'],
                    'nip' =>  Auth::user()->username,
                    'name' => "Siswa",
                    'user_hak_akses_id'=>$request['user_hak_akses']]);
    }
    elseif($request['user_hak_akses']==2)
    {
        $this->validate($request,[
        'username' => 'required|max:255|exists:ak_guru,nip',
        'password' => 'required|min:6|confirmed',
        ]);
         User::where('id',$id['id'])
                ->update(['password'=>bcrypt($request['password']),
                    'username'=>$request['username'],
                    'nip' =>  Auth::user()->username,
                    'name' => "Operator",
                    'user_hak_akses_id'=>$request['user_hak_akses']]);
    }
    elseif ($request['user_hak_akses']==3) {
       $this->validate($request,[
        'username' => 'required|max:255|exists:ak_siswa,nis',
        'password' => 'required|min:6|confirmed',
        ]);
        User::where('id',$id['id'])
                ->update(['password'=>bcrypt($request['password']),'name' => "Administrator",'username'=>$request['username'],'nip' =>  Auth::user()->username]);
                  
    }
    $request->session()->flash('alert-success', 'User Telah Berhasil Dirubah'); 
    return back();   
    }
   
    public function delete_user(Request $request,$id){
    $request->session()->flash('alert-danger', 'User Telah Berhasil Dihapus'); 
    User::where('id',$id)->delete();
        return back();	
    }

    public function cari_data(Request $request){
    $request->session()->flash('alert-danger', 'User Telah Berhasil Dihapus'); 
        $keyword=$request['search'];
        //return view('cari')
        return redirect()->route("cari",compact("keyword"));
    }

    public function cari_data_view(Request $request){
    $request->session()->flash('alert-danger', 'User Telah Berhasil Dihapus'); 
        $keyword=$request['search'];
        $sarana=Sarana::paginate(10);
        return view("cari",compact("sarana"));
    }
}
