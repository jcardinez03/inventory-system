@extends('layouts.app')

@section('title', 'Stock Logs')

@section('content')
<div class="container-fluid">

    <div class="mb-2">
        <a href="{{ route('stocklog.index', 'all') }}" class="btn btn-outline-secondary">ALL</a>
        <a href="{{ route('stocklog.index', 'in') }}" class="btn btn-outline-secondary">IN</a>
        <a href="{{ route('stocklog.index', 'out') }}" class="btn btn-outline-secondary">OUT</a>
        <form action="{{ request()->url() }}" method="get" class="">
            @csrf
            
            <select name="product_id" id="product-id" class="form-select mt-2 d-inline" style="width: 25%" onchange="this.form.submit()">
                <option value="" hidden>Select Product</option>
                @foreach ($all_products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class= "table-dark">
                <th>ID</th>
                <th>DATE</th>
                <th>PRODUCT</th>
                <th>TYPE</th>
                <th>CHANGE</th>
                <th>BEFORE</th>
                <th>AFTER</th>
                <th>USER</th>
                <th>REMARKS</th>
            </thead>
            <tbody>
                @forelse ($all_stocklogs as $stocklog)
                <tr>
                    @if ($stocklog->user_id === Auth::user()->id)    
                    <td>{{ $stocklog->id }}</td>
                    <td>{{ date('M d, Y', strtotime($stocklog->updated_at)) }}</td>
                    <td>{{ $stocklog->product->name }}</td>
                    <td>{{ $stocklog->type }}</td>
                    @if ($stocklog->type == "IN")
                        <td class="text-success font-monospace fw-bold">+{{ $stocklog->quantity }}</td>
                    @elseif($stocklog->type == "OUT")
                        <td class="text-danger font-monospace fw-bold">-{{ $stocklog->quantity }}</td>
                    @endif
                    <td>{{ $stocklog->before_stock}}</td>
                    <td>{{ $stocklog->after_stock }}</td>
                    <td>{{ $stocklog->user->name }}</td>
                    <td>No remarks</td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="9">
                        <h2 class="fst-italic text-center">Stock log is empty.</h2>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection