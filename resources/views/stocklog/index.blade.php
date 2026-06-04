@extends('layouts.app')

@section('title', 'Stock Logs')

@section('content')
    <table class="table table-striped">
        <thead class = "table-dark">
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
                <td>{{ $stocklog->id }}</td>
                <td>{{ date('M d, Y', strtotime($stocklog->updated_at)) }}</td>
                <td>{{ $stocklog->product->name }}</td>
                <td>{{ $stocklog->type }}</td>
                @if ($stocklog->type == "IN")
                    <td class="text-success font-monospace fw-bold">+{{ $stocklog->quantity }}</td>
                @elseif($stocklog->type == "OUT")
                    <td class="text-danger font-monospace fw-bold">{{ $stocklog->quantity }}</td>
                @else
                    <td class="">{{ $stocklog->quantity }}</td>
                @endif
                <td>{{ $stocklog->before_stock}}</td>
                <td>{{ $stocklog->after_stock }}</td>
                <td>{{ $stocklog->user->name }}</td>
                <td>No remarks</td>
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
@endsection