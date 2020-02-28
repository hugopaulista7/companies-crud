@extends('admin.table')

@section('content_title', 'Companies')

@section('action-buttons')


<a class="btn btn-primary" href="">Inserir registro</a>

@endsection
@section('table-header')
<thead>
    <tr>
      <th>#</th>
      <th>Nome</th>
      <th>Cidade</th>
      <th>Editar</th>
      <th>Excluir</th>
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
            <a href="#" class="btn btn-primary">Editar</a>
        </td>
        <td>
            <a href="#" class="btn btn-danger">Excluir</a>
        </td>

    </tr>
    @endforeach
</tbody>

@endsection

@section('table-footer')
<tfoot>
    <tr>
      <th>#</th>
      <th>Nome</th>
      <th>Cidade</th>
      <th>Editar</th>
      <th>Excluir</th>
    </tr>
</tfoot>
@endsection





