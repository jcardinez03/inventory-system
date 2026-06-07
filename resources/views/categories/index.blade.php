@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="row justify-content-center">
        <div class="col-7">
             <h2 class="fw-light mb-3">Categories</h2>

                <!-- form -->
                <div class="mb-3">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="row gx-2">
                            <div class="col">
                                <input type="text" name="name" id="name" placeholder="Add a new section here..." max="50" class="form-control" required>
                                @error('name')
                                    <p class="text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-info w-100 fw-bold" name="btn_add">
                                    <i class="fas fa-plus"></i> Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- table -->
                <table class="table table-sm align-middle text-center">
                    <thead class="table-success">
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            @foreach ($all_categories as $category)
                                @if ($category->user_id === Auth::user()->id)
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <form action="" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-danger border-0" value="{{ $category->id }}" title="Delete">
                                            <i class="fas fa-trash-can"></i>
                                        </button>
                                    </form>
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
@endsection