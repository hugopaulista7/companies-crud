@extends('admin.dashboard')

@section('content_title', 'Edit Company')


@section('dashboard-content')
@if(strlen(Session::get('message')) > 0)
<div class="alert alert-{{Session::get('messageClass')}}" role="alert">
    {{Session::get('message')}}
</div>
@endif
<form action="{{route('companies.update', $company->id)}}" method="POST" >
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" value="{{$company->name}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" value="{{$company->city}}" class="form-control">
    </div>
    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="select-company-type" class="form-control">
            <option value="individual" {{$relation->cpf != null ? 'selected=true' : '' }}>Private Individual</option>
            <option value="entity" {{$relation->cpf == null ? 'selected=true' : ''}}>Legal Entity</option>
        </select>
    </div>

    <div id="individual" style="{{ $relation->cpf == null ? 'display: none;' : '' }}">
        <h2 class="title">Private Individual</h2>
        <div class="form-group">
            <label for="rg">RG</label>
            <input type="number" name="rg" placeholder="Company RG" class="form-control" value="{{$relation->rg}}">
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" placeholder="Company CPF" class="form-control" id="cpf" value="{{$relation->cpf}}">
        </div>
        <div class="form-group">
            <label for="birth_date">Birth Date</label>
            <input type="date" name="birth_date" placeholder="Date of birth" class="form-control" value="{{$relation->birth_date}}">
        </div>
    </div>
    <div id="entity" style="{{ $relation->cpf != null ? 'display: none;' : '' }}">
        <h2 class="title">Legal Entity</h2>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" placeholder="Company CNPJ" class="form-control" id="cnpj" value="{{$relation->cnpj}}">
        </div>
        <div class="form-group">
            <label for="fantasy_name">Fantasy Name</label>
            <input type="text" name="fantasy_name" placeholder="Company Fantasy Name" class="form-control" value="{{$relation->fantasy_name}}">
        </div>
    </div>

    <button type="submit" class="btn btn-success">Confirmar</button>
</form>

<script type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>
<script defer type="text/javascript">
$(document).ready(($) => {
    $('#select-company-type').change((ev) => {
        ev.preventDefault();
        toggleCompanyType();
    });

    function toggleCompanyType() {
        $('#entity').slideToggle();
        $('#individual').slideToggle();
    }
    $('#cpf').mask('000.000.000-00', {reverse: true});
    $('#cnpj').mask('00.000.000/0000-00', {reverse: true});
});
</script>

@endsection
