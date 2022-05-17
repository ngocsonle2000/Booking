<?php
namespace App\Http\Controllers;

use App\Models\custom;
use App\Models\customer;
use App\Models\Hotel;
use App\Models\permission;
use App\Models\Roles;
use App\Models\UserRole;
use App\Models\UserRoles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



class AccountController extends Controller
{
    public function index(){
        $custom = customer::where('level', 1)->get();
        $admin = customer::where('level', 0)->get();
        return view('admin.Account.index', compact('custom', 'admin'));
    }
    public function lock($id,$status){
        if($status == 1){
            $updateStatus = customer::findOrFail($id);
            if($updateStatus->update(['Status' => 0])){
                return redirect()->back();
            }
        }else{
            $updateStatus = customer::findOrFail($id);
            if( $updateStatus->update(['Status' => 1])){
                return redirect()->back();
            }
        }
    }

    // public function create(){
    //     $roles = Roles::all();
    //     $permission = permission::all();
    //     return view('admin.Account.create', compact('roles', 'permission'));
    // }
    // public function store(Request $request){
    //     // if(UserRoles::create([
    //     //             'user_id' => $request->idUser,
    //     //             'roles_id' => $request->idRoles,
    //     //         ])){
    //     //             return redirect()->back()->with('success', 'Thêm nhân viên thành công' );
    //     //         }
    //     $request->validate([
    //         'name'     => 'required',
    //         'email'    => 'required|unique:customers',
    //         'postion'  => 'required',
    //         'password' => 'required',
    //         'role'     => 'required',
    //     ],[
    //         'name.required'     => 'Tên nhân viên không được bỏ trống',
    //         'email.required'    => 'Email không được bỏ trống',
    //         'email.unique'      => 'Email đã có trong hệ thống',
    //         'postion.required'  => 'Chức vụ không được bỏ trống',
    //         'password.required' => 'Mật khẩu không được để trống',
    //         'role.required'     => 'Quyền không được bỏ trống',
    //     ]);
    //     $pass = bcrypt($request-> password);
    //     $permission = json_encode($request->input('role'));
    //     $custom = [
    //         'username' => $request -> name,
    //         'email'    => $request -> email,
    //         'password' => $pass,
    //         'level'    => 1,
    //         'Status'   => 0,
    //     ];
    //     $roles = [
    //         'name' => $request -> postion,
    //         'permissions' => $permission,
    //     ];
    //     if(
    //         customer::create($custom) && Roles::create($roles)
    //     ){
    //         $idcus =  customer::latest('id')->first()->id;
    //         $idrol = Roles::latest('id')->first()->id;
    //         if(UserRole::create([
    //             'user_id' => $idcus,
    //             'role_id' => $idrol,
    //         ])){
    //             return redirect()->back()->with('success', 'Thêm nhân viên thành công' );
    //         }

    //     }else{
    //         return redirect()->back()->with('error', 'Thêm nhân viên thất bại' );
    //     }

    // }
    // public function edit($id){
    //     $dataAdmin = customer::where('id', $id)->get();
    //     $roles = UserRole::where('user_id', $id)->get();
    //     return view('admin.Account.edit', compact('dataAdmin', 'roles'));
    // }

    // public function PermissionCreate(){
    //     $arrRoute = [];
    //     $allRoute = Route::getRoutes();

    //     foreach($allRoute as $rou){
    //         $name = $rou->getName();
    //         // lấy các route có admin đằng trước
    //         $post = strpos($name, 'admin');
    //         if($post !== false){
    //             array_push($arrRoute, $rou->getName());
    //         }
    //     }
    //     $permission = permission::all();
    //     return view('admin.Account.createPer', compact('arrRoute', 'permission'));
    // }

    // public function PermissionStore(Request $request){
    //     $request->validate([
    //         'name' => 'required',
    //     ],
    //     [
    //         'name.required' => 'Tên quyền không được để trống'
    //     ]);
    //     if($request->input('role')){
    //         $roles = json_encode($request->input('role'));
    //         if(Roles::create([
    //             'name'        => $request -> name,
    //             'permissions' => $roles,
    //         ])){
    //             return redirect()->back();
    //         }

    //     }
    //     else{
    //         if(permission::create($request->all())){
    //             return redirect()->back();
    //         }
    //     }
    // }

    // public function error(){
    //     $code = request()->code;
    //     $config = config('error.'.$code);
    //     return view('admin.error', $config);
    // }
}
