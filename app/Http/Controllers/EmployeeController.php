<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
            $title = "employee";
            $employee = Employee::with('user')->get();
            $paginate = Employee::orderBy('id', 'asc')->paginate(5);
            return view('admin.employee.index', ['employee'=>$employee,'paginate'=>$paginate, 'title'=>$title]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $title = "employee";
        return view('admin.employee.create', ['user'=>$user, 'title'=>$title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'role_id' => 'required|integer',
            'password' => 'required|min:8|max:255',
            'date_of_birth' => 'required|date',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|min:10|max:15',
            'sex' => 'required',
        ]);
        
        $employee = new Employee;
        $employee->date_of_birth = $request->get('date_of_birth'); 
        $employee->address = $request->get('address'); 
        $employee->phone = $request->get('phone'); 
        $employee->sex = $request->get('sex'); 
        
        $user = new User;
        $user->name = $request->get('name'); 
        $user->email = $request->get('email'); 
        $user->role_id = $request->get('role_id'); 
        $pwd = $request->get('password');
        $user->password = Hash::make($pwd); 
        $user->email_verified_at = date('Y/m/d H:i:s'); 
        $user->save();
        
        $employee->user()->associate($user);
        $employee->save();

        return redirect()->route('employee.index')
        ->with('success', 'Employee Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function show($id)
    {
        
        $title = "employee";
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('admin.employee.detail', compact('employee', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $title = "employee";
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('admin.employee.edit', compact('employee', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'role_id' => 'required|integer',
            'user_id' => 'required|integer',
            'date_of_birth' => 'required|date',
            'address' => 'required|min:3|max:255',
            'phone' => 'required|min:10|max:15',
            'sex' => 'required',
        ]);
        
        $employee = Employee::with('user')->where('id', $id)->first();
        $employee->user_id = $request->get('user_id'); 
        $employee->user->role_id = $request->get('role_id'); 
        $employee->user->name = $request->get('name'); 
        $employee->user->email = $request->get('email'); 
        $employee->date_of_birth = $request->get('date_of_birth'); 
        $employee->address = $request->get('address'); 
        $employee->phone = $request->get('phone'); 
        $employee->sex = $request->get('sex'); 

        $employee->save();
        $employee->user->save();
        
        return redirect()->route('employee.index')
        ->with('success', 'Employee Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * 
     */
    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        
        return redirect()->route('employee.index')
        ->with('success', 'Employee Deleted Successfully'); 
    }

    public function show_profile_kasir($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('employee.kasir.profile', compact('employee'));
    }

    public function edit_profile_kasir($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('employee.kasir.edit_profile', compact('employee'));
    }
    
    public function edit_password_kasir($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('employee.kasir.edit_password', compact('employee'));
    }

    public function update_profile_kasir(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
            'name' => 'required|min:3|max:50',
        ]);
        
        $employee = Employee::with('user')->where('id', $id)->first();
        $employee->user_id = $request->get('user_id'); 
        $employee->user->role_id = $request->get('role_id'); 
        $employee->user->name = $request->get('name'); 
        $employee->date_of_birth = $request->get('date_of_birth'); 
        $employee->address = $request->get('address'); 
        $employee->phone = $request->get('phone'); 
        $employee->sex = $request->get('sex'); 

            if ($request->file('image')) {
                if ($employee->user->profile_path && file_exists(storage_path('app/public/'.$employee->user->profile_path))) {
                    Storage::delete('public/'.$employee->user->profile_path);
                } 
                $image_name = $request->file('image')->store('user_profiles', 'public');
            } else {
                $image_name = $employee->user->profile_path;
            }
            $employee->user->profile_path = $image_name;
            
            $employee->save();
            $employee->user->save();
            
            return redirect()->route('employee.kasir.show_profile', $employee->id)
            ->with('success', 'Data Updated Successfully');
    }
    
    public function update_password_kasir(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
            'password' => 'required|min:8|max:255|',
            'confirm_password' => 'required|min:8|max:255',
        ]);
        
        $employee = Employee::with('user')->where('id', $id)->first();
        $employee->user_id = $request->get('user_id'); 
        $employee->user->role_id = $request->get('role_id'); 

        $pwd = $request->get('password');
        $pwd1 = $request->get('confirm_password');
        if ($pwd !== $pwd1) {
            return redirect()->route('employee.kasir.edit_password', $employee->user->id)
            ->with('error', 'Password does not match');
        } 
        else {
            $employee->user->password = Hash::make($pwd);
            $employee->save();
            $employee->user->save();
            
            return redirect()->route('employee.kasir.show_profile', $employee->id)
            ->with('success', 'Data Updated Successfully');
        }
    }
    
    public function show_profile_staff($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('employee.staff-dapur.profile', compact('employee'));
    }

    public function edit_profile_staff($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('employee.staff-dapur.edit_profile', compact('employee'));
    }
    
    public function edit_password_staff($id)
    {
        $employee = Employee::with('user')->where('id', $id)->first();
        return view('employee.staff-dapur.edit_password', compact('employee'));
    }

    public function update_profile_staff(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
            'name' => 'required|min:3|max:50',
        ]);
        
        $employee = Employee::with('user')->where('id', $id)->first();
        $employee->user_id = $request->get('user_id'); 
        $employee->user->role_id = $request->get('role_id'); 
        $employee->user->name = $request->get('name'); 
        $employee->date_of_birth = $request->get('date_of_birth'); 
        $employee->address = $request->get('address'); 
        $employee->phone = $request->get('phone'); 
        $employee->sex = $request->get('sex'); 

            if ($request->file('image')) {
                if ($employee->user->profile_path && file_exists(storage_path('app/public/'.$employee->user->profile_path))) {
                    Storage::delete('public/'.$employee->user->profile_path);
                } 
                $image_name = $request->file('image')->store('user_profiles', 'public');
            } else {
                $image_name = $employee->user->profile_path;
            }
            $employee->user->profile_path = $image_name;
            
            $employee->save();
            $employee->user->save();
            
            return redirect()->route('employee.staff.show_profile', $employee->id)
            ->with('success', 'Data Updated Successfully');
    }
    
    public function update_password_staff(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'role_id' => 'required|integer',
            'password' => 'required|min:8|max:255',
            'confirm_password' => 'required|min:8|max:255',
        ]);
        
        $employee = Employee::with('user')->where('id', $id)->first();
        $employee->user_id = $request->get('user_id'); 
        $employee->user->role_id = $request->get('role_id'); 

        $pwd = $request->get('password');
        $pwd1 = $request->get('confirm_password');
        if ($pwd !== $pwd1) {
            return redirect()->route('employee.staff.edit_password', $employee->user->id)
            ->with('error', 'Password does not match');
        } 
        else {
            $employee->user->password = Hash::make($pwd);
            $employee->save();
            $employee->user->save();
            
            return redirect()->route('employee.staff.show_profile', $employee->id)
            ->with('success', 'Data Updated Successfully');
        }
    }
}