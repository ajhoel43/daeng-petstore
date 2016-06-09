@extends('layouts.default')

@section('main')

<div class="col-md-6">
    <h1>Edit Barang</h1>
    {{ Form::model($barang, array('method' => 'PATCH', 'route' => array('barang.update', $barang->id))) }}
        <div class="form-group">
            {{ Form::label('nama', 'Nama Barang:') }}
            {{ Form::text('nama', $barang->nama, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('jenis', 'Jenis Barang:') }}
            {{ Form::select('jenis', $data['jenis'], $barang->jenis,array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('harga', 'Harga Barang:') }}
            {{ Form::number('harga', $barang->harga, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('stok', 'Stok Barang:') }}
            {{ Form::text('stok', $barang->stok, array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('satuan', 'Satuan Barang:') }}
            {{ Form::select('satuan', $data['satuan'], $barang->satuan, array('class' => 'form-control')) }}
        </div>
            {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}
            {{ link_to_route('barang.index', 'Back to index', '', array('class' => 'btn btn-danger')) }}
    {{ Form::close() }}
</div>
@stop