<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Spouse;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;
use Exception;

class SpouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spouses = Spouse::paginate(10);
        $count = Spouse::count();
    	return view('spouse.index')
            ->with('count', $count)
    		->with('spouses', $spouses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
    	return view('spouse.create')->with('employees', $employees);
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
            'DOB' => 'required|max:1000|min:10',
            'phone' => 'required|max:15|min:10',
        ]);
        if ($validator->fails()) {
            return redirect('spouse/create')
                ->withInput()
                ->withErrors($validator);
        }
        
        $spouse = new Spouse();
        $spouse->name = $request->name;
        $spouse->employee_id = $request->employee_id;
        $spouse->sex = $request->sex;
        $spouse->address = $request->address;
        $spouse->DOB = $request->DOB;
        $spouse->phone = $request->phone;
        $spouse->save();

        Session::flash('spouse_create','New Spouse is Created');
        return redirect('spouse/create');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employees = Employee::all();
        $spouse = Spouse::find($id);

        return view('spouse.view')
    		->with('spouse', $spouse)
            ->with('employees',$employees);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employees = Employee::all();
        $spouse = Spouse::find($id);

        return view('spouse.edit')
    		->with('spouse', $spouse)
            ->with('employees',$employees);
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
            'DOB' => 'required|max:1000|min:10',
            'phone' => 'required|max:15|min:10',
        ]);

        $spouse = Spouse::find($id);
        if ($validator->fails()) {
            return redirect('spouse/'.$spouse->id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }
        
        $spouse->name = $request->name;
        $spouse->employee_id = $request->employee_id;
        $spouse->sex = $request->sex;
        $spouse->address = $request->address;
        $spouse->DOB = $request->DOB;
        $spouse->phone = $request->phone;
        $spouse->save();

        Session::flash('spouse_update','Spouse is Updated');
        return redirect('spouse');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $employees = Employee::all();
        $spouse = Spouse::find($id);

        return view('spouse.delete')
    		->with('spouse', $spouse)
            ->with('employees',$employees);
    }
    public function destroy($id)
    {
        $spouse = Spouse::find($id);
       
        try {
            DB::table('spouses')->where('id',$id)->delete();

            Session::flash('spouse_delete','Spouse is Deleted');
            return redirect('spouse');
        } catch(Exception $e) {
            Session::flash('spouse_delete', 'You can not delete, because this record has relationship to other recortd');
            return redirect('spouses/delete/' .$spouse->id);
        }
    }

    public function search(Request $request) {

        $keyword = $request->input('keyword');
        if( $keyword != ""){
            $count = Spouse::where('name', 'LIKE', '%'.$keyword.'%')->count();
            return view('spouse.index')
                ->with('count', $count)
                ->with('spouses', Spouse::where('name', 'LIKE', '%'.$keyword.'%')->paginate(10))
                ->with('keyword', $keyword);
        } else {
            return redirect('spouse');
        } 
    }
}
