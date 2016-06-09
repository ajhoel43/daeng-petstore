@extends('layouts.default')

@section('main')

<h1>Daftar Transaksi Daeng PetStore</h1>

<!-- <p>{{-- link_to_route('transaksi.create', 'Tambahkan transaksi', null, array('class' => 'btn btn-primary')) --}}</p> -->

@if ($transaksis->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>

                <th>No.</th>
                <th>Tanggal Transaksi</th>
                <th>Pembeli</th>
                <th>Variasi Barang</th>
                <th>Total Nilai Transaksi</th>
                <th colspan="2" style="text-align: center;">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php $index = 1; ?>
            @foreach ($transaksis as $transaksi)
                <?php 
                    $jumlahTransaksi = count($transaksi->pembelian);
                    $totalNTransaksi = 0;
                ?>
                @foreach ($transaksi->pembelian as $pembelian)
                    <?php 
                        $totalNTransaksi += $pembelian->total_harga;
                    ?>
                @endforeach
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ HumanDate($transaksi->tanggal) }}</td>
                    <td>{{ $transaksi->pembeli->nama }}</td>
                    <td>{{ $jumlahTransaksi }}</td>
                    <td align="right">{{ CURRENCY($totalNTransaksi) }}</td>
                    <td align="center" width="80px">{{ link_to_route('transaksi.pembelian', 'Lihat', array($transaksi->id), array('class' => 'btn btn-info')) }}</td>
                </tr>
                <?php $index++; ?>
            @endforeach
              
        </tbody>
      
    </table>
@else
    Transaksi tidak ditemukan
@endif

@stop