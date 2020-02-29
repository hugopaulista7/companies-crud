@extends('admin.table')

@section('content_title', 'Companies')

@section('action-buttons')
<a class="btn btn-primary" href="{{ route('companies.create') }}">Inserir registro</a>
@endsection

@section('filter-row')
<div class="col-8">
    <div class="form-group">
        <input type="text" id="filter-input" name="filter" class="form-control" placeholder="Type here...">
    </div>
</div>
<div class="col-4">
    <div class="form-group">
        <select name="filter-type" id="filter-type" class="form-control">
            <option value="name" selected='true'>Name</option>
            <option value="document">CPF/CNPJ</option>
        </select>
    </div>
</div>

@endsection


@section('table-header')
<thead>
    <tr>
      <th>#</th>
      <th>Name</th>
      <th>City</th>
      <th>CPF/CNPJ</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
</thead>
@endsection


@section('table-content')
<tbody id="table-body">
    @foreach ($companies as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->name}}</td>
        <td>{{$item->city}}</td>
        <td>{{!empty($item->individual) ? $item->individual->cpf : $item->entity->cnpj}}</td>
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
      <th>CPF/CNPJ</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
</tfoot>

<script type="text/javascript" src="{{asset('js/underscore-min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(($) => {
        const deleteRoute = '{{route("companies.delete")}}'
        const editRoute = '{{route("companies.edit")}}'
        let eventHandler = (ev) => {
            const type = $('#filter-type').val();
            const val = $('#filter-input').val();
            const obj = {
                    _token: '{!!csrf_token()!!}',
                    type: type,
                    value: val
            };
            $.ajax(
                {
                    url: '{{route("companies.filter")}}',
                    method: 'POST',
                    data: obj,
                    success: function({companies}) {
                        $('#table-body').empty();
                        let html = ``;
                        companies.forEach(element => {
                            html = html + `<tr>
                                            <td>${element.id}</td>
                                            <td>${element.name}</td>
                                            <td>${element.city}</td>
                                            <td>${element.individual !== null
                                                ? element.individual.cpf
                                                : element.entity !== null
                                                                 ? element.entity.cnpj
                                                                 : ''}</td>
                                            <td>
                                                <a href="${editRoute}/${element.id}" class="btn btn-primary">Edit</a>
                                            </td>
                                            <td>
                                                <a href="${deleteRoute}/${element.id}" class="btn btn-danger">Delete</a>
                                            </td>
                                           </tr>`
                        });

                        $('#table-body').append(html);
                    }
                }
            )
        };

        eventHandler = _.debounce(eventHandler, 300);

        $('#filter-input').keydown(eventHandler)
    });
</script>

@endsection





