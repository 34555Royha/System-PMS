@extends('admin.main')



@section('content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Create Invoice</h1>
        <div class="card mb-4">
            <div class="card-body">
            @if(Session::has('invoice_create'))
            <div class="alert alert-success"><em>{!! session('invoice_create') !!}</em>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times</span></button>    
            </div>
            @endif
            <!-- It Show the form/input error -->
            @include('common.errors')
            

            <form action="{{route('invoice.store')}}" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{@csrf_token()}}">
                <div class="row">
                    <div class="col-sm-2">
                        <label for="">Invoice Date</label>
                    </div>
                    <div class="col-sm-4">
                        <input type="date" placeholder="Invoice Date" id="InvoiceDate" name="InvoiceDate" value="{{old('InvoiceDate')}}" class="form-control">
                   
                    </div>
                    <div class="col-sm-1">
                        <label for="">Expired Date</label>
                    </div>
                    <div class="col-sm-5">
                        <input type="date" placeholder="Expired Date" id="ExpiredDate" name="ExpiredDate" value="{{old('ExpiredDate')}}" class="form-control">
                   
                     </div>
                </div>
                <div class="row mt-sm-2">
                    <div class="col-sm-2">
                        <label for="">Employee Name</label>
                    </div>
                    <div class="col-sm-4">
                        <select name="employee_id" id="employee_id" class="form-control">
                            <option hidden>Select</option>
                            @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <label for="">Customer Name</label>
                    </div>
                    <div class="col-sm-5">
                        <select name="customer_id" id="customer_id" class="form-control">
                            <option hidden>Select</option>
                            @foreach ($customers as $customer)
                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>    
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-2">
                        <a href="/invoice" class="btn btn-outline-warning w-100">Cancel</a>
                    </div>
                    <div class="col-sm-2">
                        <input type="submit" value="Create" class="btn btn-outline-success w-100">
                    </div>
                </div>
            </form>

            </div>
        </div>
        <div style="height: 100vh"></div>
    </div>
</main>
@endsection