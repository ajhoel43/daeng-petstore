@extends('layouts.default')

@section('main')

<div class="col-md-12">
    <h1>Buat Transaksi</h1>
    @if (Session::has('message'))
        {!! Session::get('message') !!}
    @endif
    {{ Form::open(array('route' => 'transaksi.store', 'class' => 'well')) }}
        {{ Form::hidden('id', '', array('class' => 'form-control')) }}
        <div class="form-group">
            {{ Form::label('nama', 'Nama Pembeli:', array('class' => 'control-label')) }}
            {{ Form::text('nama', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('alamat', 'Alamat:', array('class' => 'control-label')) }}
            {{ Form::textarea('alamat', '', array('class' => 'form-control', 'rows' => '2')) }}
        </div>
        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@stop