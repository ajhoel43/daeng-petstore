@extends('layouts.default')

@section('main')
<style type="text/css">
table tr th{
    text-align: center;
}
.number { text-align: right; }
.blank { background: gray; }
</style>
<div class="col-md-12">
    <h3>Pembeli :</h3>
    <table style="margin-bottom: 1em; margin-left: 1em;">
        <tr>
            <td>Nama</td>
            <td>: {{ $transaksi->pembeli->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $transaksi->pembeli->alamat }}</td>
        </tr>
        <tr>
            <td>Tanggal Transaksi</td>
            <td>: {{ HumanDate($transaksi->tanggal) }}</td>
        </tr>
    </table>
    @if (Session::has('message'))
        {!! Session::get('message') !!}
    @endif
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-bordered" style="width: 100%;">
                <tr>
                    <th width="5px">No.</th>
                    <th width="20px">No.Barang</th>
                    <th width="100px">Nama Barang</th>
                    <th width="100px">Jenis</th>
                    <th width="70px">Qty</th>
                    <th width="50px">Satuan</th>
                    <th width="100px">Harga Satuan</th>
                    <th width="100px">Total Harga</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php 
                    $index = 1; 
                    $subtotal = 0;
                    $subtotalqty = 0;
                ?>
                @if($barangs->count())
                    @foreach ($barangs as $barang)
                        <tr>
                            <td style="text-align: center">{{ $index."." }}</td>
                            <td>{{ $barang->barang_id }}</td>
                            <td>{{ $barang->barang->nama }}</td>
                            <td>{{ $barang->barang->jenis }}</td>
                            <td class="number">{{ STOCK($barang->qty) }}</td>
                            <td>{{ $barang->satuan }}</td>
                            <td class="number">{{ CURRENCY($barang->harga_satuan) }}</td>
                            <td class="number">{{ CURRENCY($barang->total_harga) }}</td>
                            <td align="center" width="80px">{{ link_to_route('pembelian.edit', 'Edit', array($barang->id), array('class' => 'btn btn-info')) }}</td>
                            <td align="center" width="80px">
                                {{ Form::open(array('method' => 'DELETE', 'route' => array('pembelian.hapus', $barang->id))) }}
                                {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                    <?php 
                        $index++; 
                        $subtotal += $barang->total_harga;
                        $subtotalqty += $barang->qty;
                    ?>
                    @endforeach
                    <tr>
                        <td colspan="7">
                            <strong>Total :</strong>
                        </td>
                        <td class="number">{{ CURRENCY($subtotal) }}</td>
                        <td colspan="2" class="blank"></td>
                    </tr>
                @else
                <tr>
                    <td colspan="9" style="color: red;">
                        Belum ada daftar barang yang dibeli
                    </td>
                </tr>
                @endif
            </table>
            
        </div>
    </div>
    <div class="col-md-12 well">
        {{ Form::open(array('route' => 'transaksi.store_pembelian')) }}
            <h3>Input Barang</h3>
            {{ Form::hidden('transaksi_id', $transaksi->id, array('class' => 'form-control')) }}
            {{ Form::hidden('barang_id', '', array('class' => 'form-control')) }}
            <div class="form-group col-xs-6">
                {{ Form::label('nama_barang', 'Nama barang:', array('class' => 'control-label')) }}
                {{ Form::text('nama_barang', '', array('class' => 'form-control brg_auto')) }}
            </div>
            <div class="form-group col-xs-6">
                {{ Form::label('satuan', 'Satuan:', array('class' => 'control-label')) }}
                {{ Form::text('satuan', '', array('class' => 'form-control', 'readonly' => 'readonly')) }}
            </div>
            <div class="form-group col-xs-4">
                {{ Form::label('qty', 'Quantity:', array('class' => 'control-label')) }}
                {{ Form::text('qty', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group col-xs-4">
                {{ Form::label('harga_satuan', 'Harga:', array('class' => 'control-label')) }}
                {{ Form::text('harga_satuan', '', array('class' => 'form-control', 'readonly' => 'readonly')) }}
            </div>
            <div class="form-group col-xs-4">
                {{ Form::label('total_harga', 'Total Harga:', array('class' => 'control-label')) }}
                {{ Form::text('total_harga', '', array('class' => 'form-control')) }}
            </div>
            <div class="form-group col-xs-12">
                {{ Form::submit('Submit', array('class' => 'btn btn-primary', 'name' => 'submit')) }}
            </div>
        {{ Form::close() }} 
    </div>
    <div class="col-md-12">&nbsp;</div>
    {{-- link_to_route('transaksi.barang_autocomplete', 'Tes Link') }}
    {{ Html::linkRoute('transaksi.barang_autocomplete', 'Tes Link1') }}
    {{ Html::linkAction('C_transaksi@barang_autocomplete', 'Tes Link2') }}
    {{ action('C_transaksi@barang_autocomplete') --}}
</div>
<script>
$.ajaxSetup({cache:false, async: false});

setTimeout(function(){
    $(".brg_auto").autocomplete({
        source: "{!! route('autocomplete_brg') !!}",
        select: function(event, ui){
            $(".brg_auto").val(ui.item.value);
            $("[name='barang_id']").val(ui.item.id);
            $("[name='satuan']").val(ui.item.satuan);
            $("[name='harga_satuan']").val(ui.item.harga);
        }
    });
}, 1500);

$("[name='total_harga']").on("focus blur", function(){
    calc_Total();
});

$("[name='submit']").click(function(){
    calc_Total();
});

function calc_Total()
{
    var qty = $("[name='qty']").val(),
        harga = $("[name='harga_satuan']").val(),
        total = 0;

    total = harga * qty;

    $("[name='total_harga']").val(total);
}
</script>
@stop