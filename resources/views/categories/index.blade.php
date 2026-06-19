@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="row justify-content-center p-2 gx-0">
        <div class="col">
            <div class="row w-50 ms-4">
                <div class="col">
                    <h2 class="fw-light mb-3 d-inline">Categories</h2>
                </div>
                <div class="col text-end">
                    <button class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#add-category"><i class="fas fa-plus"></i> Add Category</button>
                </div>
                @include('categories.modal.status')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="ms-4 card border border-1" style="height: 130px">
                <div class="card-body pb-0">
                    <p>Total Categories</p>
                    <p class="h2 fw-bold">{{ $all_categories->count() }}</p>
                    <p class="small text-muted">across all products</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="ms-4 card border border-1" style="height: 130px">
                <div class="card-body pb-0">
                    <p>Most stocked</p>
                    <p class="h2 fw-bold">{{ $largest_product_name }}</p>
                    <p class="small text-muted">{{ $largest_product_count }} total products</p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="ms-4 card border border-1" style="height: 130px">
                <div class="card-body pb-0">
                    <p>Least stocked</p>
                    <p class="h2 fw-bold">{{ $least_product['least_product_name'] }}</p>
                    <p class="small text-muted">{{ $least_product['least_product_count'] }}</p>
                </div>
            </div>
        </div>   
    </div>
    <hr>
    <div class="row">
        <div class="col-4 ms-4">
            <div class="card">
                <div class="card-header">
                    <h3>All Categories</h3>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead class="table-dark text-white">
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>Product Count</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->categoryProduct->count() }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <form action="#" method="post" class="d-inline">
                                            @csrf

                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex">
                    {{ $all_categories->links() }}
                </div>
            </div>
            </div>

            <div class="col">

        </div>
    </div>
    
@endsection