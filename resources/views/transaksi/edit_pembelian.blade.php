@extends('layouts.default')

@section('main')
<div class="col-md-12 well">
    {{ Form::open(array('route' => 'pembelian.update')) }}
        <h3>Edit Barang</h3>
        {{ Form::hidden('id', $pembelian->id) }}
        {{ Form::hidden('transaksi_id', $pembelian->transaksi_id) }}
        {{ Form::hidden('barang_id', $pembelian->barang_id) }}
        <div class="form-group col-xs-6">
            {{ Form::label('nama_barang', 'Nama barang:', array('class' => 'control-label')) }}
            {{ Form::text('', $pembelian->barang->nama, array('class' => 'form-control brg_auto')) }}
        </div>
        <div class="form-group col-xs-6">
            {{ Form::label('satuan', 'Satuan:', array('class' => 'control-label')) }}
            {{ Form::text('satuan', $pembelian->barang->satuan, array('class' => 'form-control', 'readonly' => 'readonly')) }}
        </div>
        <div class="form-group col-xs-4">
            {{ Form::label('qty', 'Quantity:', array('class' => 'control-label')) }}
            {{ Form::text('qty', $pembelian->qty, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-xs-4">
            {{ Form::label('harga_satuan', 'Harga:', array('class' => 'control-label')) }}
            {{ Form::text('harga_satuan', $pembelian->harga_satuan, array('class' => 'form-control', 'readonly' => 'readonly')) }}
        </div>
        <div class="form-group col-xs-4">
            {{ Form::label('total_harga', 'Total Harga:', array('class' => 'control-label')) }}
            {{ Form::text('total_harga', $pembelian->total_harga, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-xs-12">
            {{ Form::submit('Submit', array('class' => 'btn btn-primary', 'name' => 'submit')) }}
        </div>
    {{ Form::close() }} 
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