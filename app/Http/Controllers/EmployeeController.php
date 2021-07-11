<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use Validator;
use Session;
use File;
use DB;
use Exception;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = DB::table('employees')->paginate(10);
        $count = Employee::count();
    	return view('employee.index')
            ->with('count',$count)
    		->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'sex' => 'required',
            'address' => 'required|max:20',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'DOB' => 'required|max:1000|min:10',
            'phone' => 'required|max:15|min:10',
        ]);
        if ($validator->fails()) {
            return redirect('employee/create')
                ->withInput()
                ->withErrors($validator);
        }
        
        $image = $request->file('image');
        $upload = 'img/employees/';
        $filename = time().$image->getClientOriginalName();
        $path = move_uploaded_file($image->getPathName(), $upload. $filename);

        $employee = new Employee();
        $employee->name = $request->name;
        $employee->sex = $request->sex;
        $employee->address = $request->address;
        $employee->image = $filename;
        $employee->DOB = $request->DOB;
        $employee->phone = $request->phone;
        $employee->save();

        Session::flash('employee_create','New Employee is Created');
        return redirect('employee/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('employee.view')->with('employee', $employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        return view('employee.edit')->with('employee', $employee);
        
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'sex' => 'required',
            'address' => 'required|max:20',
            'image' => 'mimes:jpg,jpeg,png,gif',
            'DOB' => 'required|max:1000|min:10',
            'phone' => 'required|max:15|min:10',
        ]);

        $employee = Employee::find($id);

        if ($validator->fails()) {
            return redirect('employee/'.$employee->id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }

        if($request->file('image') != ""){
            $image = $request->file('image');
            $upload = 'img/employees/';
            $filename = time().$image->getClientOriginalName();
            $path = move_uploaded_file($image->getPathName(), $upload. $filename);
            }

        $employee->name = $request->name;
        $employee->sex = $request->sex;
        $employee->address = $request->address;
        if(isset($filename)){
           $employee->image = $filename;
            }
        $employee->DOB = $request->DOB;
        $employee->phone = $request->phone;
        $employee->save();

        Session::flash('employee_update','New Employee is Updated');

        return redirect('employee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $employee = Employee::find($id);
        return view('employee.delete')->with('employee', $employee);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        try {
            DB::table('employees')->where('id',$id)->delete();

            $image_path = 'img/employees/'.$employee->image;
            File::delete($image_path);
            Session::flash('employee_delete','Employee is Deleted');
            return redirect('employee');
        } catch(Exception $e) {
            Session::flash('employee_delete', 'You can not delete, because this record has relationship to other recortd');
            return redirect('employees/delete/'.$employee->id);
        }
    }

    public function detail()
    {
        $employees = Employee::all();
    	return view('employee.detail')
    		->with('employees', $employees);
    }

    public function search(Request $request) {

        $keyword = $request->input('keyword');
        if( $keyword != ""){
            $count = Employee::where('name', 'LIKE', '%'.$keyword.'%')->count();
            return view('employee.index')
                ->with('count', $count)
                ->with('employees', Employee::where('name', 'LIKE', '%'.$keyword.'%')->paginate(10))
                ->with('keyword', $keyword);
        } else {
            return redirect('/employee');
        } 
    }

    public function searchdetail(Request $request) {

        $keyword = $request->input('keyword');
        if( $keyword != ""){
            return view('employee.detail')
                ->with('employees', Employee::where('name', 'LIKE', '%'.$keyword.'%')->paginate(10))
                ->with('keyword', $keyword);
        } else {
            return redirect('/employees/detail');
        } 

    }
}
