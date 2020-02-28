@extends('admin.dashboard')

@section('dashboard-content')

<div class="row">
    <div class="col-12">
      <div class="box">
        <div class="box-header">
          @if(Session::has('message'))
            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
          @endif     
        </div>
        <div class="box-body">
          
          <table id="table" class="table table-bordered table-striped">
            @yield('table-header')

            @yield('table-content')
            
            @yield('table-footer')
                
          </table>
        </div>
      </div>
    </div>
</div>

@endsection

