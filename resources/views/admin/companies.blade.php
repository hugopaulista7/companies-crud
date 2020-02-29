@extends('admin.table')

@section('content_title', 'Companies')

@section('action-buttons')


<a class="btn btn-primary" href="{{ route('companies.create') }}">Inserir registro</a>

@endsection
@section('table-header')
<thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>City</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
</thead>
@endsection


@section('table-content')
<tbody>
    @foreach ($companies as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->city}}</td>
        <td>
            <a href="{{route('companies.edit', $item->id)}}" class="btn btn-primary">Edit</a>
        </td>
        <td>
            <a href="{{route('companies.delete', $item->id)}}" class="btn btn-danger">Delete</a>
        </td>

    </tr>
    @endforeach
</tbody>

@endsection

@section('table-footer')
<tfoot>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>City</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
</tfoot>
@endsection





