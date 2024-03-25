<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Exports\PermissionExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PermissionImport;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class RoleController extends Controller
{
    public function AllPermission(){

        $permissions = Permission::all();
        return view('admin.backend.pages.permission.all_permission',compact('permissions'));

    }

    public function AddPermission(){

        return view('admin.backend.pages.permission.add_permission');

    }// End Method 

    public function StorePermission(Request $request){

        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);  

    }

    public function EditPermission($id){

        $permission = Permission::find($id);
        return view('admin.backend.pages.permission.edit_permission',compact('permission'));

    }// End Method 

    public function UpdatePermission(Request $request){

        $per_id = $request->id;

        Permission::find($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.permission')->with($notification);  

    }// End Method 

    public function DeletePermission($id){

        Permission::find($id)->delete();

        $notification = array(
            'message' => 'Permission Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  

    }

    public function ImportPermission(){

        return view('admin.backend.pages.permission.import_permission');

    }

    public function Export(){

        return Excel::download(new PermissionExport, 'permission.xlsx');

    }

    public function Import(Request $request){

        Excel::import(new PermissionImport, $request->file('import_file'));

        $notification = array(
            'message' => 'Permission Imported Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);  

    }

    ////////// ALL ROLE METHODS /////////
    public function AllRoles(){

        $roles = Role::all();
        return view('admin.backend.pages.roles.all_roles',compact('roles'));

    }// End Method

    public function AddRoles(){

        return view('admin.backend.pages.roles.add_roles');

    }// End Method

    public function StoreRoles(Request $request){

        Role::create([
            'name' => $request->name, 
        ]);

        $notification = array(
            'message' => 'Role Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);  

    }
    
    public function EditRoles($id){

        $roles = Role::find($id);
        return view('admin.backend.pages.roles.edit_roles',compact('roles'));


    }// End Method 

    public function UpdateRoles(Request $request){

        $role_id = $request->id;

        Role::find($role_id)->update([
            'name' => $request->name, 
        ]);

        $notification = array(
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.roles')->with($notification);  

    }// End Method 

    public function DeleteRoles($id){

        Role::find($id)->delete();

        $notification = array(
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification); 

    }
    ////////// ALL ROLE METHODS /////////

        //////////// Add Role Permission All Mehtod ////////////////

        public function AddRolesPermission(){
            $roles = Role::all();
            $permissions = Permission::all();
            $permission_groups = User::getpermissionGroups();
            return view('admin.backend.pages.rolesetup.add_roles_permission',compact('roles','permission_groups','permissions'));
        }

        public function RolePermissionStore(Request $request){
            
            $permissions = $request->permission;

            if($permissions){
                foreach ($permissions as $key => $permissionId) {
                    $data = array();
                    // Check if the record already exists
                    $existingRecord = DB::table('role_has_permissions')
                        ->where('role_id', $request->role_id)
                        ->where('permission_id', $permissionId)
                        ->first();
                
                    // If the record doesn't exist, insert it
                    if (!$existingRecord) {
                        $role1 = Role::find($request->role_id);
                        $findPermisson = Permission::find($permissionId);
                        $role1->givePermissionTo($findPermisson->name);
 /*                        $data[] = [
                            'role_id' => $request->role_id,
                            'permission_id' => $permissionId,
                        ]; */
                    }
    
                    if (!empty($data)) {
                        DB::table('role_has_permissions')->insert($data);
                        
                    }
                }
    
                $notification = array(
                    'message' => 'Role Permission Added Successfully',
                    'alert-type' => 'success'
                );
            }else{
                $notification = array(
                    'message' => 'Select at least one permission for the role',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification); 
            }
            
            return redirect()->route('all.roles.permission')->with($notification); 
        }

        public function AllRolesPermission(){
            $roles = Role::all();
            return view('admin.backend.pages.rolesetup.all_roles_permission',compact('roles'));
        }

        public function AdminEditRoles($id){

            $role = Role::find($id);
            $permissions = Permission::all();
            $permission_groups = User::getpermissionGroups();
    
            return view('admin.backend.pages.rolesetup.edit_roles_permission',compact('role','permission_groups','permissions'));
    
    
        }

        public function AdminUpdateRoles(Request $request, $id){

            $role = Role::find($id);
            $permissions = $request->permission;
            $permission_name = array();

            if(!empty($permissions)){
            foreach ($permissions as $permission_id) {
                $permission = Permission::find($permission_id);
                if ($permission) {
                    $permission_name[] = $permission->name;
                }
            }
            }
            if (!empty($permissions)) {
                $role->syncPermissions($permission_name);
            }

            if(empty($permission)){
                $role->syncPermissions([]);
            }
    
            $notification = array(
                'message' => 'Role Permission Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.roles.permission')->with($notification); 
    
        }

        public function AdminDeleteRoles($id){

            $role = Role::find($id);
            if (!is_null($role)) {
                $role->delete();
            }
    
            $notification = array(
                'message' => 'Role Permission Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
    
        }

        //////////// Add Role Permission All Mehtod ////////////////
}
