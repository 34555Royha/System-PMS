<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;
use Exception;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = DB::table('customers')->paginate(10);
        $count = Customer::count();
    	return view('customer.index')
            ->with('count', $count)
    		->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer.create');
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
            return redirect('customer/create')
                ->withInput()
                ->withErrors($validator);
        }

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->sex = $request->sex;
        $customer->address = $request->address;
        $customer->DOB = $request->DOB;
        $customer->phone = $request->phone;
        $customer->save();

        Session::flash('customer_create','New Customer is Created');
        return redirect('customer/create');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return view('customer.view')->with('customer', $customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('customer.edit')->with('customer', $customer);
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

        $customer = Customer::find($id);
        if ($validator->fails()) {
            return redirect('customer/'.$customer->id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $customer->name = $request->name;
        $customer->sex = $request->sex;
        $customer->address = $request->address;
        $customer->DOB = $request->DOB;
        $customer->phone = $request->phone;
        $customer->save();

        Session::flash('customer_update','Customer is Updated');
        return redirect('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $customer = Customer::find($id);
        return view('customer.delete')->with('customer', $customer);
    }
    public function destroy($id)
    {
        $customer = Customer::find($id);

        try {
            DB::table('customers')->where('id',$id)->delete();
            Session::flash('customer_delete','Customer is Deleted');
            return redirect('customer');
        } catch(Exception $e) {
            Session::flash('customer_delete', 'You can not delete, because this record has relationship to other recortd');
            return redirect('customers/delete/'.$customer->id);
        }
    }

    public function search(Request $request) {

        $keyword = $request->input('keyword');
        if( $keyword != ""){
            $count = Customer::where('name', 'LIKE', '%'.$keyword.'%')->count();
            return view('customer.index')
                ->with('customers', Customer::where('name', 'LIKE', '%'.$keyword.'%')->paginate(10))
                ->with('count', $count)
                ->with('keyword', $keyword);
        } else {
            return redirect('/customer');
        } 

    }
}
