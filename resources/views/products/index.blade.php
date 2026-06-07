@extends('layouts.app')

@section('title', 'Homepage')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <h2>Products</h2>
        </div>
        <div class="col text-end">
            <a href="{{ route('product.create') }}" class="btn btn-outline-primary">
                <i class="fas fa-plus"></i> Add Product
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-borderless">
            <thead class="table-dark">
                {{-- <th>ID</th> --}}
                <th>SKU</th>
                <th>NAME</th>
                <th>Category</th>
                <th class="text-center" style="width: 200px">Stocks</th>
                <th style="width: 100px">IN</th>
                <th style="width: 100px">OUT</th>
                <th style="width: 100px">DATE</th>
                <th class="text-center" style="width: 150px"></th>
            </thead>
            <tbody>
                @forelse ($all_products as $product)
                    <tr>
                        {{-- <td>{{ $product->id }}</td> --}}
                        @if ($product['user_id'] === Auth::user()->id)     
                        <td>{{ $product->sku }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td class="text-center">
                            {{ $product->stock->quantity }}
                            @if ($product->stock->quantity < 5 && $product->stock->quantity > 0)
                                <p class="text-danger small mb-0">Low quantity </p>
                            @elseif($product->stock->quantity == 0)
                                <p class="text-dark small fw-bold mb-0">SOLD OUT</p>
                            @endif
                        </td>
                        <form action="{{ route('stock.update', $product->id) }}" method="post" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <td>
                                <input type="number" name="quantity_in{{ $product->id }}" id="quantity-in-{{ $product->id }}" class="form-control w-100 d-inline" step="any">
                               
                            </td>
                            <td>
                                <input type="number" name="quantity_out{{ $product->id }}" id="quantity-out-{{ $product->id }}" max="{{ $product->stock->quantity }}" class="form-control w-100 d-inline" step="any">
                            </td>
                            <td>
                                <input type="date" name="date" id="date" class="form-control">
                            </td>
                            <td>
                                <button type="submit" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-plus"></i> Update Stocks
                                </button>
                            </td>
                        </form>
                        @endif
                    </tr>
                @include('products.modal.action')
                @empty
                <td colspan="9" class="bg-dark">
                    <h3 class="text-center text-white mt-1">
                        <i class="fa-solid fa-circle-xmark text-danger"></i> No Products Yet.</h3>
                </td>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection