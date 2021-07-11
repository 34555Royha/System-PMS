@extends('admin.main')

{{-- Inheritance Search --}}
{{-- @section('search')
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0" action="/frontend/searchpost" method="GET">
    <div class="input-group">
        <input class="form-control" type="text" placeholder="Search for..." id="keyword" name="keyword" value="{{old('keyword')}}" aria-label="Search" aria-describedby="basic-addon2" />
        <div class="input-group-append">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
@endsection --}}

@section('content')
<main>
    <div class="container-fluid">
        <form action="/payments/search" method="GET" enctype="multipart/form-data">
           
            <input type="hidden" name="_token" value="{{@csrf_token()}}">
            <div class="row mt-3 mb-3">
                <div class="col-sm-1">
                    <a href="/payment/create" class="btn btn-success">Create</a>
                </div>
                <div class="col-sm-1">
                    <label for="">Invoice Id</label>
                </div>
                <div class="col-sm-2">
                    <select name="invoice_id" id="invoice_id"  class="form-control">
                        <option value="">All</option>
                        @foreach ($invoices as $invoice)
                        <option value="{{ $invoice->id }}">{{ $invoice->id }}</option>
                        @endforeach
                    </select>
             </div>
                <div class="col-sm-1">
                    <label for="">Product Name</label>
                </div>
                <div class="col-sm-2">
                    <select name="product_id" id="product_id" class="form-control">
                        <option value="">All</option>
                        @foreach ($posts as $post)
                        <option value="{{ $post->id }}">{{ $post->name }}</option>
                        @endforeach
                    </select>    
                </div>
                <div class="col-sm-1">
                    <input type="submit" value="Search" class="btn btn-outline-success w-100">
                </div>
                <div class="col-sm-1">
                      <!-- Pagination -->
                      {!! $payments->appends(request()->input())->links(); !!}
                </div>
            </div>
        </form>
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('payment_update'))
                <div class="alert alert-success"><em>{{ session('payment_update') }}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
                @if(Session::has('payment_delete'))
                <div class="alert alert-danger"><em>{!! session('payment_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
            @if (count($payments) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Payment
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover easy_table">
                            <thead class="thead-dark" style="text-align: center">
                                <th>ID</th>
                                <th>Invoice Id</th>
                                <th>Product Name</th>
                                <th>Unit Price</th>
                                <th>Quantity</th>
                                <th>Discount</th>
                                <th>Total</th>
                                <th>Create at</th>
                                <th>Option</th>
                            </thead>
                            <tbody style="text-align: center">
                                @foreach ($payments as $payment)
                                <tr>
                                    <td>{{ $payment->id }}</td>
                                    <td>
                                        <div>{{ $payment->invoice_id }}</div>
                                      
                                    </td>
                                    <td>
                                        <div>{{ $payment->product->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $payment->price }}$</div>
                                    </td>
                                    <td>
                                        <div>{{ $payment->qty }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $payment->discount }}%</div>
                                    </td>
                                    <td>
                                        <div>{{ $payment->total }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $payment->created_at }}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/payment/{{$payment->id}}" class="btn btn-warning">View</a>
                                        <a href="/payment/{{$payment->id}}/edit" class="btn btn-success">Update</a>
                                        <a href="/payments/delete/{{$payment->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>   

                                @endforeach
                                <tr>
                                    <td class="bg-dark text-light">Total Invoice</td>
                                    <td>{{ $count }}</td>
                                    <td colspan="2" class="bg-dark text-light">Total Quantity</td>
                                    <td>{{ $quantity }}</td>
                                    <td class="bg-dark text-light ">Total Money</td>
                                    <td>{{ $price }}$</td>
                                </tr>

                            </tbody>
                        </table> 
                    </div>
                </div>
            @endif
            </div>
        </div>
        {{-- <div style="height: 100vh"></div> --}}
        <div class="card mb-4"><div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static navigation demo.</div></div>
    </div>
</main>
@endsection