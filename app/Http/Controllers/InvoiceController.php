<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Employee;
use App\Invoice;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;
use Exception;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::paginate(10);
        $count = Invoice::count();
        $employees = Employee::all();
        $customers = Customer::all();

    	return view('invoice.index')
            ->with('count', $count)
    		->with('invoices', $invoices)
            ->with('employees', $employees)
             ->with('customers', $customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        $customers = Customer::all();

    	return view('invoice.create')
        ->with('employees', $employees)
        ->with('customers', $customers);
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
            'InvoiceDate' => 'required',
            'ExpiredDate' => 'required',
            'employee_id' => 'required',
            'customer_id' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('invoice/create')
                ->withInput()
                ->withErrors($validator);
        }

        $invoice = new Invoice();
        $invoice->InvoiceDate = $request->InvoiceDate;
        $invoice->ExpiredDate = $request->ExpiredDate;
        $invoice->employee_id = $request->employee_id;
        $invoice->customer_id = $request->customer_id;
        $invoice->save();

        Session::flash('invoice_create','New Invice is Created');
        return redirect('invoice/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        $employees = Employee::all();
        $customers = Customer::all();

    	return view('invoice.view')
        ->with('invoice', $invoice)
        ->with('employees', $employees)
        ->with('customers', $customers);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoice::find($id);
        $employees = Employee::all();
        $customers = Customer::all();

    	return view('invoice.edit')
        ->with('invoice', $invoice)
        ->with('employees', $employees)
        ->with('customers', $customers);
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
            'InvoiceDate' => 'required',
            'ExpiredDate' => 'required',
            'employee_id' => 'required',
            'customer_id' => 'required',
        ]);
        $invoice = Invoice::find($id);

        if ($validator->fails()) {
             return redirect('invoice/'.$invoice->id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $invoice->InvoiceDate = $request->InvoiceDate;
        $invoice->ExpiredDate = $request->ExpiredDate;
        $invoice->employee_id = $request->employee_id;
        $invoice->customer_id = $request->customer_id;
        $invoice->save();

        Session::flash('invoice_update','Invice is Updated');
        return redirect('invoice');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $invoice = Invoice::find($id);
        $employees = Employee::all();
        $customers = Customer::all();

    	return view('invoice.delete')
        ->with('invoice', $invoice)
        ->with('employees', $employees)
        ->with('customers', $customers);
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);

        try {
            DB::table('invoices')->where('id',$id)->delete();
            Session::flash('invoice_delete','Invice is Deleted');
            return redirect('invoice');
        } catch(Exception $e) {
            Session::flash('invoice_delete', 'You can not delete, because this record has relationship to other recortd');
            return redirect('invoices/delete/'.$invoice->id);
        }
    }

    public function search(Request $request) {

        $employees = Employee::all();
        $customers = Customer::all();
        $InvoiceDate = $request->InvoiceDate;
        $EmployeeId = $request->employee_id;
        $CustomerId = $request->customer_id;

        if( $EmployeeId != "" && $CustomerId != "" && $InvoiceDate != ""){

            $count = Invoice::where('employee_id', $EmployeeId )
            ->where('customer_id', $CustomerId )
            ->where('InvoiceDate', $InvoiceDate )
            ->count();

            $invoices = Invoice::where('employee_id', $EmployeeId )
            ->where('customer_id', $CustomerId )
            ->where('InvoiceDate', $InvoiceDate )
            ->paginate(10);               
            
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        } else if( $EmployeeId != "" && $CustomerId == "" && $InvoiceDate == ""){

            $count = Invoice::where('employee_id', $EmployeeId )
            ->count();

            $invoices = Invoice
            ::where('employee_id', $EmployeeId )
            ->paginate(10);
            // dd($invoices);
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        } else if( $EmployeeId == "" && $CustomerId != "" && $InvoiceDate == ""){

            $count = Invoice::where('customer_id', $CustomerId )
            ->count();

            $invoices = Invoice
            ::where('customer_id', $CustomerId )
            ->paginate(10);
            // dd($invoices);
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        } else if( $EmployeeId == "" && $CustomerId == "" && $InvoiceDate != ""){

            $count = Invoice::where('InvoiceDate', $InvoiceDate )
            ->count();

            $invoices = Invoice::
            where('InvoiceDate', $InvoiceDate )
            ->paginate(10);
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        } else if( $EmployeeId != "" && $CustomerId != "" && $InvoiceDate == ""){

            $count = Invoice:: where('customer_id', $CustomerId )
            ->where('employee_id', $EmployeeId )
            ->count();

            $invoices = Invoice::
            where('customer_id', $CustomerId )
            ->where('employee_id', $EmployeeId )
            ->paginate(10);
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        }
        else if( $EmployeeId != "" && $CustomerId == "" && $InvoiceDate != ""){

            $count = Invoice:: where('employee_id', $EmployeeId )
            ->where('InvoiceDate', $InvoiceDate )
            ->count();

            $invoices = Invoice::
            where('employee_id', $EmployeeId )
            ->where('InvoiceDate', $InvoiceDate )
            ->paginate(10);
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        }else if( $EmployeeId == "" && $CustomerId != "" && $InvoiceDate != ""){

            $count = Invoice::where('customer_id', $CustomerId )
            ->where('InvoiceDate', $InvoiceDate )
            ->count();

            $invoices = Invoice::
            where('customer_id', $CustomerId )
            ->where('InvoiceDate', $InvoiceDate )
            ->paginate(10);
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        }else if( $EmployeeId != "" && $CustomerId != "" && $InvoiceDate == ""){

            $count = Invoice::where('customer_id', $CustomerId )
            ->where('employee_id', $EmployeeId )
            ->count();

            $invoices = Invoice::
            where('customer_id', $CustomerId )
            ->where('employee_id', $EmployeeId )
            ->paginate(10);
            return view('invoice.index')
                ->with('invoices', $invoices)
                ->with('keyword', $InvoiceDate)
                ->with('employees', $employees)
                ->with('count', $count)
              ->with('customers', $customers);
        }
         else {
            return redirect('invoice');
        } 
    }
}

