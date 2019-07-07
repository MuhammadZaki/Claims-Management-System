@extends('backend.common.template')

@section('title', 'Welcome'))

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















    @stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/admin/js/select2.js') }}"></script>
@stop



