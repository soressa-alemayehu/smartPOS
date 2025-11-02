@extends('layouts.app')
@section('content')
<h4>Categories</h4>
@include('partials.alerts')

<form action="{{ route('categories.store') }}" method="POST" class="d-flex mb-3">
    @csrf
    <input type="text" name="name" placeholder="New category" class="form-control me-2" required>
    <button class="btn btn-primary">Add</button>
</form>

<table class="table table-bordered bg-white">
    <thead>
        <tr><th>#</th><th>Name</th><th>Action</th></tr>
    </thead>
    <tbody>
        @foreach($categories as $cat)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $cat->name }}</td>
            <td>
                <form action="{{ route('categories.destroy',$cat) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
