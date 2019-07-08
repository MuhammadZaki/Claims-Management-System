@extends('backend.common.template')

@section('title', 'BlockChain'))

@section('content')
    @if(Session::has('msg'))
        <div class="alert alert-success" role="alert">
            {!! Session::get('msg') !!}
        </div>
    @endif
    @if(!empty($errors->all()))
        <ul class="alert alert-danger">
            @foreach($errors->all('<li>:message</li>') as $message) {!! $message !!}  @endforeach
        </ul>
    @endif

    <div style="color:blue;"  class="card">
        <div class="card-body">
            <h4 class="card-title float-left"><b><i>Blocks</i></b></h4>
            <div class="row">



            </div>






            
        </div>
















    </div>


    @stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/admin/js/select2.js') }}"></script>
@stop