@extends('admin.main')



@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">View Payment</h1>
        <div class="card mb-4">
            <div class="card-body">
            @if(Session::has('payment_create'))
            <div class="alert alert-success"><em>{!! session('payment_create') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times</span></button>    
            </div>
            @endif
            <!-- It Show the form/input error -->
            @include('common.errors')
            

            <form action="{{route('payment.store')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{@csrf_token()}}">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="">Invoice Id</label>
                    </div>
                    <div class="col-sm-4" invoice_id="{{ $payment->invoice_id }}" id="invoice_id">
                        <select name="invoice_id" id="invoice_id" class="form-control" disabled>
                            @foreach ($invoices as $invoice)
                            <option value="{{ $invoice->id }}"  >{{ $invoice->id }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <label for="">Product Name</label>
                    </div>
                    <div class="col-sm-5" product_id="{{ $payment->product_id }}" id="product_id">
                        <select name="product_id" id="product_id" class="form-control" disabled>
                            @foreach ($posts as $post)
                            <option value="{{ $post->id }}" pdprice={{ $post->price }} pddiscount={{ $post->discounts }}>{{ $post->name }}</option>
                            @endforeach
                        </select>
                     </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-2">
                        <label for="">Quantity</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="number" placeholder="Quantity" id="qty" name="qty" class="form-control" value="{{ $payment->qty}}" disabled>
                    </div>
                    <div class="col-sm-1">
                        <label for="">Unit Price</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" placeholder="Price" id="price" name="price" value="{{ $payment->price}}" class="form-control" disabled>
                        <input type="hidden" placeholder="Price" id="prices" name="price" value="{{ $payment->price}}" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-2">
                        <label for="">Discount</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Discount" id="discount" name="discount" value="{{ $payment->discount}}" class="form-control" disabled>
                        <input type="hidden" placeholder="Discount" id="discounts" name="discount" value="{{ $payment->discount}}" class="form-control">
                    </div>
                    
                </div>
                <div class="row mt-sm-2">
                    <div class="col-sm-2">
                        <label for="">Total</label>
                    </div>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Total" id="total" name="total" value="{{ $payment->total}}" class="form-control" disabled>
                        <input type="hidden" placeholder="Total" id="totals" name="total" value="{{ $payment->total}}" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-8"></div>
                    <div class="col-md-4">
                        <a href="/payment" class="btn btn-outline-warning w-100">Cancel</a>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>
</main>
@endsection

