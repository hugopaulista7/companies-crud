@extends('admin.dashboard')

@section('content_title', 'Create Person')


@section('dashboard-content')

<form action="" method="POST" >
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Company name">
    </div>
    <button type="submit" class="btn btn-success">Confirm</button>
</form>

@endsection
