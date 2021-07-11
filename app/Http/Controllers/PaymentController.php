<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Payment;
use App\Post;
use Validator;
use Session;
use DB;
use Exception;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $payments = Payment::all();
        $payments = Payment::paginate(10);
        $qty = Payment::sum('qty');
        $price = Payment::sum('total');
        $count = Payment::count();
        $invoices = Invoice::all();
        $posts = Post::all();

        // foreach ($paymentall as $payment) {
        //     $sum  = $payment->qty;
            
        // }
        
    	return view('payment.index')
            ->with('invoices', $invoices)
            ->with('count', $count)
            ->with('price', $price)
            ->with('quantity', $qty)
    		->with('payments', $payments)
            ->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $invoices = Invoice::all();
        $posts = Post::all();

    	return view('payment.create')
        ->with('invoices', $invoices)
        ->with('posts', $posts);
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
            'product_id' => 'required',
            'invoice_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'total' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('payment/create')
                ->withInput()
                ->withErrors($validator);
        }

        $payment = new Payment();
        $payment->product_id = $request->product_id;
        $payment->invoice_id = $request->invoice_id;
        $payment->qty = $request->qty;
        $payment->price = $request->price;
        $payment->discount = $request->discount;
        $payment->total = $request->total;
        $payment->save();

        Session::flash('payment_create','New Payment is Created');
        return redirect('payment/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::findOrFail($id);
        $invoices = Invoice::all();
        $posts = Post::all();

    	return view('payment.view')
        ->with('invoices', $invoices)
        ->with('payment', $payment)
        ->with('posts', $posts);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $invoices = Invoice::all();
        $posts = Post::all();

    	return view('payment.edit')
        ->with('invoices', $invoices)
        ->with('payment', $payment)
        ->with('posts', $posts);
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
            'product_id' => 'required',
            'invoice_id' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'discount' => 'required',
            'total' => 'required',
        ]);
        $payment = Payment::findOrFail($id);

        if ($validator->fails()) {
            return redirect('payment/'.$payment->id.'/edit')
                ->withInput()
                ->withErrors($validator);
        }

        $payment->product_id = $request->product_id;
        $payment->invoice_id = $request->invoice_id;
        $payment->qty = $request->qty;
        $payment->price = $request->price;
        $payment->discount = $request->discount;
        $payment->total = $request->total;
        $payment->save();

        Session::flash('payment_update','Payment is Updated');
        return redirect('payment');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $payment = Payment::findOrFail($id);
        $invoices = Invoice::all();
        $posts = Post::all();

    	return view('payment.delete')
        ->with('invoices', $invoices)
        ->with('payment', $payment)
        ->with('posts', $posts);
    }

    public function destroy($id)
    {
        $payment = Payment::findOrFail($id);

        try {
            DB::table('payments')->where('id',$id)->delete();
            Session::flash('payment_delete','Payment is Deleted');
            return redirect('payment');
        } catch(Exception $e) {
            Session::flash('payment_delete', 'You can not delete, because this record has relationship to other recortd');
            return redirect('payments/delete/'.$payment->id);
        }
    }


    public function search(Request $request) {

        $posts = Post::all();
        $invoices = Invoice::all();
        
        $InvoiceId = $request->invoice_id;
        $ProductId = $request->product_id;

        if( $InvoiceId != "" && $ProductId != ""){

            $qty = Payment::
            where('invoice_id', $InvoiceId )
            ->where('product_id', $ProductId )
            ->sum('qty');
            $price = Payment::
            where('invoice_id', $InvoiceId )
            ->where('product_id', $ProductId )
            ->sum('total');
            $count = Payment::
            where('invoice_id', $InvoiceId )
            ->where('product_id', $ProductId )
            ->count();

            $payments = Payment::
            where('invoice_id', $InvoiceId )
            ->where('product_id', $ProductId )
            ->paginate(10);
            
            return view('payment.index')
                ->with('payments', $payments)
                ->with('invoices', $invoices)
                ->with('count', $count)
                ->with('price', $price)
                 ->with('quantity', $qty)
                ->with('invoices', $invoices)
              ->with('posts', $posts);

        } else if( $InvoiceId != "" && $ProductId == ""){

            $qty = Payment::
            where('invoice_id', $InvoiceId )->sum('qty');
            $price = Payment::
            where('invoice_id', $InvoiceId )->sum('total');
            $count = Payment::
            where('invoice_id', $InvoiceId )->count();

            $payments = Payment::
            where('invoice_id', $InvoiceId )
            ->paginate(10);
            
            return view('payment.index')
                ->with('payments', $payments)
                ->with('count', $count)
                 ->with('price', $price)
                 ->with('quantity', $qty)
                ->with('invoices', $invoices)
              ->with('posts', $posts);
        } else if( $InvoiceId == "" && $ProductId != ""){


            $qty = Payment::
            where('product_id', $ProductId )
            ->sum('qty');
            $price = Payment::
            where('product_id', $ProductId )
            ->sum('total');
            $count = Payment::
            where('product_id', $ProductId )
            ->count();

            $payments = Payment::
            where('product_id', $ProductId )
            ->paginate(10);
            
            return view('payment.index')
                ->with('payments', $payments)
                ->with('invoices', $invoices)
                ->with('count', $count)
                ->with('price', $price)
                 ->with('quantity', $qty)
                ->with('invoices', $invoices)
              ->with('posts', $posts);
        } 
         else {
            return redirect('payment');
        } 
    }
}
