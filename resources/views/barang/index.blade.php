@extends('layouts.default')

@section('main')

<h1>Master Barang Daeng PetStore</h1>

<p>{{ link_to_route('barang.create', 'Tambahkan Barang', null, array('class' => 'btn btn-primary')) }}</p>

@if ($barangs->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>

                <th>ID.</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th colspan="2" style="text-align: center;">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $no = 1; ?>
            @foreach ($barangs as $barang)
                <tr>
                    <td>{{ $no }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->jenis }}</td>
                    <td>{{ CURRENCY($barang->harga, 'id') }}</td>
                    <td>{{ STOCK($barang->stok) }}</td>
                    <td>{{ $barang->satuan }}</td>
                    <td align="center" width="80px">{{ link_to_route('barang.edit', 'Edit', array($barang->id), array('class' => 'btn btn-info')) }}</td>
                    <td align="center" width="80px">
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('barang.destroy', $barang->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                <?php $no++; ?>
            @endforeach
              
        </tbody>
      
    </table>
@else
    Barang tidak ditemukan
@endif

@stop