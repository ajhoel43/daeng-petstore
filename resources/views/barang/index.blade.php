@extends('layouts.default')

@section('main')

<style type="text/css">
table th {
    text-align: center;
}
.right { text-align: right; }
</style>

<h1>Master Barang Daeng PetStore</h1>
{{ link_to_route('barang.create', "Tambahkan Barang",'',array('class' => 'btn btn-warning')) }}
<div>&nbsp;</div>
@if ($barangs->count())
    <table class="table table-bordered table-hover table-condensed">
        <thead>
            <tr>

                <th width="5px">No.</th>
                <th>Nama Barang</th>
                <th>Jenis</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Satuan</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $index = 1; ?>
            @foreach ($barangs as $barang)
                @if($barang->stok <= 5)
                    <tr class="danger">
                @elseif($barang->stok > 5 and $barang->stok <= 10)
                    <tr class="info">
                @else
                    <tr>
                @endif
                    <td align="center">{{ $index."." }}</td>
                    <td>{{ $barang->nama }}</td>
                    <td>{{ $barang->jenis }}</td>
                    <td class="right">{{ CURRENCY($barang->harga, 'id') }}</td>
                    <td class="right">{{ STOCK($barang->stok) }}</td>
                    <td>{{ $barang->satuan }}</td>
                    <td align="center" width="80px">{{ link_to_route('barang.edit', 'Edit', array($barang->id), array('class' => 'btn btn-info btn-xs')) }}</td>
                    <td align="center" width="80px">
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('barang.destroy', $barang->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs')) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                <?php $index++; ?>
            @endforeach
              
        </tbody>
      
    </table>
@else
    Barang tidak ditemukan
@endif

@stop