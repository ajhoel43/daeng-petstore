@extends('layouts.default')

@section('main')

<h1>Daftar Transaksi Daeng PetStore</h1>

<!-- <p>{{-- link_to_route('transaksi.create', 'Tambahkan transaksi', null, array('class' => 'btn btn-primary')) --}}</p> -->

@if ($transaksis->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>

                <th>ID.</th>
                <th>Tanggal Transaksi</th>
                <th>Pembeli</th>
                <th>Barang</th>
                <th>Satuan</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total Harga</th>
                <th colspan="2" style="text-align: center;">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transaksis as $transaksi)
                <tr>
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->tanggal }}</td>
                    <td>{{ $transaksi->id_pembeli }}</td>
                    <td>{{ $transaksi->id_barang }}</td>
                    <td>{{ $transaksi->satuan }}</td>
                    <td>{{ $transaksi->qty }}</td>
                    <td>{{ $transaksi->harga_satuan }}</td>
                    <td>{{ $transaksi->total_harga }}</td>
                    <td align="center" width="80px">{{-- link_to_route('transaksi.edit', 'Edit', array($transaksi->id), array('class' => 'btn btn-info')) }}</td>
                    <td align="center" width="80px">
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('transaksi.destroy', $transaksi->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() --}}
                    </td>
                </tr>
            @endforeach
              
        </tbody>
      
    </table>
@else
    Transaksi tidak ditemukan
@endif

@stop