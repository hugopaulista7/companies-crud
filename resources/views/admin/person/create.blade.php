@extends('admin.dashboard')

@section('content_title', 'Create Person')

@section('dashboard-content')
<form action="{{route('persons.insert')}}" method="POST" >
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Person name" required>
    </div>
    <div class="form-group">
        <label for="company">Company</label>
        <select name="company" class="form-control">
            @foreach ($companies as $company)
                <option value="{{$company->id}}"> {{$company->name}} </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-success">Confirm</button>
</form>

@endsection
