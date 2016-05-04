@extends('layouts.default')

@section('main')

<div class="col-md-6">
    <h1>Input Barang</h1>
    {{ Form::open(array('route' => 'barang.store', 'class' => 'well')) }}
        <div class="form-group">
            {{ Form::label('nama', 'Nama Barang:') }}
            {{ Form::text('nama', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('jenis', 'Jenis Barang:') }}
            {{ Form::select('jenis', $data['jenis'], '',array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('harga', 'Harga Barang:') }}
            {{ Form::text('harga', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('stok', 'Stok Barang:') }}
            {{ Form::text('stok', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('satuan', 'Satuan Barang:') }}
            {{ Form::select('satuan', $data['satuan'],'', array('class' => 'form-control')) }}
        </div>
            {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
@stop