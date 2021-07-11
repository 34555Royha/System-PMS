@extends('admin.main')

{{-- Inheritance Search --}}
@section('search')

@endsection

@section('content')
<main>
    <div class="container-fluid">
       
        <form action="/invoices/search" method="GET" enctype="multipart/form-data">
           
            <input type="hidden" name="_token" value="{{@csrf_token()}}">
            <div class="row mt-3 mb-3">
                <div class="col-sm-1">
                    <a href="/invoice/create" class="btn btn-success">Create</a>
                </div>
                <div class="col-sm-1">
                    <label for="">Invoice Date</label>
                </div>
                <div class="col-sm-2">
                    <input type="date" placeholder="Invoice Date" id="InvoiceDate" name="InvoiceDate" value="{{old('InvoiceDate')}}"  class="form-control">
               
                </div>
                <div class="col-sm-1">
                    <label for="">Employee Name</label>
                </div>
                <div class="col-sm-2">
                    <select name="employee_id" id="employee_id"  class="form-control">
                        <option value="">All</option>
                        @foreach ($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
             </div>
                <div class="col-sm-1">
                    <label for="">Customer Name</label>
                </div>
                <div class="col-sm-2">
                    <select name="customer_id" id="customer_id" class="form-control">
                        <option value="">All</option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                        @endforeach
                    </select>    
                </div>
                <div class="col-sm-1">
                    <input type="submit" value="Search" class="btn btn-outline-success w-100">
                </div>
                <div class="col-sm-1">
                    <!-- Pagination -->
                    {!! $invoices->appends(request()->input())->links(); !!}
            </div>
            </div>
        </form>
        <div class="card mb-4">
            <div class="card-body">
                @if(Session::has('invoice_update'))
                <div class="alert alert-success"><em>{{ session('invoice_update') }}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
                @if(Session::has('invoice_delete'))
                <div class="alert alert-danger"><em>{!! session('invoice_delete') !!}</em>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times</span></button>    
                </div>
                @endif
            @if (count($invoices) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        All Invoices
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover easy_table">
                            <thead class="thead-dark" style="text-align: center">
                                <th>ID</th>
                                <th>Invoice Date</th>
                                <th>Expire Date</th>
                                <th>Employee Name</th>
                                <th>Customer Name</th>
                                <th>Option</th>
                            </thead>
                            <tbody style="text-align: center">
                                @foreach ($invoices as $invoice)
                                <tr>
                                    <td>{{ $invoice->id }}</td>
                                    <td>
                                        <div>{{ $invoice->InvoiceDate }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $invoice->ExpiredDate }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $invoice->employee->name }}</div>
                                    </td>
                                    <td>
                                        <div>{{ $invoice->customer->name }}</div>
                                    </td>
                                    <td style="text-align: center">
                                        <a href="/invoice/{{$invoice->id}}" class="btn btn-primary">Detail...</a>
                                        <a href="/invoice/{{$invoice->id}}/edit" class="btn btn-success">Update</a>
                                        <a href="/invoices/delete/{{$invoice->id}}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>   

                                @endforeach
                                <tr style="text-align: center" class="bg-dark text-light">
                                    <td>Total Invouce</td>
                                    <td>{{ $count }}</td>
                                </tr>
                            </tbody>
                        </table> 
                        <ul class="pagination justify-content-center mb-4">
                            <li class="page-item"><a class="page-link" href="#!">← Older</a></li>
                            <li class="page-item disabled"><a class="page-link" href="#!">Newer →</a></li>
                        </ul>
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