@extends('layouts.default')

@section('main')

<div class="col-md-6">
    <h1>Input Transaksi</h1>
    {{ Form::open(array('route' => 'transaksi.store', 'class' => 'well')) }}
        <div class="form-group">
            {{ Form::label('nama', 'Nama Pembeli:') }}
            {{ Form::text('nama', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('alamat', 'Alamat:') }}
            {{ Form::textarea('alamat', '', array('class' => 'form-control')) }}
        </div>
        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@stop