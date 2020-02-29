@extends('admin.table')

@section('content_title', 'Persons')

@section('action-buttons')


<a class="btn btn-primary" href="{{route('persons.create')}} ">Inserir registro</a>

@endsection
@section('table-header')
<thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
</thead>
@endsection


@section('table-content')
<tbody>
    @foreach ($persons as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>
            <a href="{{route('persons.edit', $item->id)}}" class="btn btn-primary">Edit</a>
        </td>
        <td>
            <a href="{{route('persons.delete', $item->id)}}" class="btn btn-danger">Delete</a>
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
      <th>Edit</th>
      <th>Delete</th>
    </tr>
</tfoot>
@endsection





