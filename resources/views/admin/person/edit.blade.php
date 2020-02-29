@extends('admin.dashboard')

@section('content_title', 'Edit Person')

@section('dashboard-content')

<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link" id="person-link" data-hash="person">Person</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="phones-link" data-hash="phones">Phones</a>
    </li>
</ul>
<div class="container" id="person-container">
    <form action="{{route('persons.update', $person->id)}}" method="POST" >
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Person name" required value="{{$person->name}}">
        </div>
        <div class="form-group">
            <label for="company">Company</label>
            <select name="company" class="form-control">
                @foreach ($companies as $company)
                    <option value="{{$company->id}}" {{ $person->company->id == $company->id ? 'selected=true' : '' }}>{{$company->name}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Confirm</button>
    </form>
</div>
<div class="container" id="phones-container" style="display: none;">
    <div class="row mb-3">
        <div class="col-3 ml-auto">
            <button class="btn btn-primary" id="add-phone">Add Phone</button>
        </div>
    </div>
    <table id="table" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($phones as $phone)
                <tr>
                    <td>{{$phone->id}}</td>
                    <td>{{$phone->phone}}</td>
                    <td>
                        <a class="btn btn-danger" style="color: white;" href="{{route('phones.delete', $phone->id)}}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Number</th>
                <th>Delete</th>
            </tr>
        </tfoot>
    </table>
</div>

<div class="modal" style="display: none" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Phone</h5>
          </div>
          <div class="modal-body">
            <form action="{{route('persons.addPhone', $person->id)}} " method="POST">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone-input" required placeholder="(XX) XXXXX-XXXX" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" >Confirm</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" id="modal-close">Close</button>
                </div>
            </form>
          </div>
        </div>
</div>
<script type="text/javascript" src="{{asset('js/jquery.mask.js')}}"></script>
<script type="text/javascript">
    $(document).ready(($) => {
        let hash = window.location.hash.replace('#', '');
        $('.nav-item').click((ev) => {
            hash = $(ev.target).data().hash;
            checkHash(hash);
        });

        $('#add-phone').click((ev) => {
            ev.preventDefault();
            $('#modal').css('display', 'block');
        });

        $('#modal-close').click(() => {
            $('#modal').css('display', 'none');
        });

        const checkHash = () => {
            if (hash === 'person' || hash.length <= 0) {
                $('#person-link').addClass('active');
                $('#person-container').css('display', 'block');
                $('#phones-link').removeClass("active");
                $('#phones-container').css('display', 'none');
            }
            if (hash === 'phones') {
                $('#phones-link').addClass("active");
                $('#phones-container').css('display', 'block');
                $('#person-link').removeClass("active");
                $('#person-container').css('display', 'none');
            }
        }

        var maskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            options = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(maskBehavior.apply({}, arguments), options);
                }
            };

        $('#phone-input').mask(maskBehavior, options);
        checkHash(hash);
    });
</script>

@endsection
