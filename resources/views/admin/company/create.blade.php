@extends('admin.dashboard')

@section('content_title', 'Create Company')


@section('dashboard-content')

<form action="{{ route('companies.insert') }}" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" class="form-control" placeholder="Company name" required>
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" class="form-control" placeholder="City where company is located" required>
    </div>

    <div class="form-group">
        <label for="type">Type</label>
        <select name="type" id="select-company-type" class="form-control">
            <option value="individual">Private Individual</option>
            <option value="entity">Legal Entity</option>
        </select>
    </div>

    <div id="individual">
        <h2 class="title">Private Individual</h2>
        <div class="form-group">
            <label for="rg">RG</label>
            <input type="number" name="rg" placeholder="Company RG" class="form-control">
        </div>
        <div class="form-group">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" placeholder="Company CPF" class="form-control" id="cpf">
        </div>
        <div class="form-group">
            <label for="birth_date">Birth Date</label>
            <input type="date" name="birth_date" placeholder="Date of birth" class="form-control">
        </div>
    </div>

    <div id="entity" style="display: none;">
        <h2 class="title">Legal Entity</h2>
        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" name="cnpj" placeholder="Company CNPJ" class="form-control" id="cnpj">
        </div>
        <div class="form-group">
            <label for="fantasy_name">Fantasy Name</label>
            <input type="text" name="fantasy_name" placeholder="Company Fantasy Name" class="form-control">
        </div>
    </div>

    <button type="submit" class="btn btn-success">Confirm</button>
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


