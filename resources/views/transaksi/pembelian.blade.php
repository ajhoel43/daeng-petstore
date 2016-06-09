@extends('layouts.default')

@section('main')

<div class="col-md-12">
    <h1></h1>
    @if (Session::has('message'))
        {!! Session::get('message') !!}
    @endif
    <h3>Pembeli :</h3>
    <table>
        <tr>
            <td>Nama</td>
            <td>: {{ $transaksi->pembeli->nama }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>: {{ $transaksi->pembeli->alamat }}</td>
        </tr>
    </table>
    {{ Form::open(array('route' => 'transaksi.store_pembelian', 'class' => 'well')) }}
        <h3>Input Barang</h3>
        {{ Form::hidden('transaksi_id', $transaksi->id, array('class' => 'form-control')) }}
        {{ Form::hidden('barang_id', '', array('class' => 'form-control')) }}
        <div class="form-group">
            {{ Form::label('nama_barang', 'Nama barang:', array('class' => 'control-label')) }}
            {{ Form::text('nama_barang', '', array('class' => 'form-control brg_auto')) }}
        </div>
        <div class="form-group">
            {{ Form::label('satuan', 'Satuan:', array('class' => 'control-label')) }}
            {{ Form::text('satuan', '', array('class' => 'form-control', 'readonly' => 'readonly')) }}
        </div>
        <div class="form-group">
            {{ Form::label('qty', 'Quantity:', array('class' => 'control-label')) }}
            {{ Form::text('qty', '', array('class' => 'form-control')) }}
        </div>
        <div class="form-group">
            {{ Form::label('harga_satuan', 'Harga:', array('class' => 'control-label')) }}
            {{ Form::text('harga_satuan', '', array('class' => 'form-control', 'readonly' => 'readonly')) }}
        </div>
        <div class="form-group">
            {{ Form::label('total_harga', 'Total Harga:', array('class' => 'control-label')) }}
            {{ Form::text('total_harga', '', array('class' => 'form-control')) }}
        </div>
        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
    <div class="col-md-12">&nbsp;</div>
    {{ link_to_route('transaksi.barang_autocomplete', 'Tes Link') }}
    {{ Html::linkRoute('transaksi.barang_autocomplete', 'Tes Link1') }}
    {{ Html::linkAction('C_transaksi@barang_autocomplete', 'Tes Link2') }}
    {{ action('C_transaksi@barang_autocomplete') }}
</div>
<script>
$.ajaxSetup({cache:false, async: false});

var _token = "{{ csrf_token() }}";
var timer = null;
$(".brg_auto").keyup(function(){
    clearTimeout(timer);
    timer = setTimeout(brgAutocomplete, 1500);
});
// $(".brg_auto").keydown(function(){
//     clearTimeout(timer);
//     timer = setTimeout(brgAutocomplete, 1500);
// });
<?php
    $tesarray = array('ASP','MySQL','MariaDB');
?>
var availableTags1 = <?php echo json_encode($tesarray) ?>;
var availableTags = [
    'PHP',
    'Java',
    'JavaScript',
    'COBOL',
    'Pascal'
];

$(".brg_auto").autocomplete({
    source: "{{ route('transaksi.barang_autocomplete') }}"
});

// $(".brg_auto").autocomplete({
//     source: function(request, response){
//         $.ajax({
//             type: "POST",
//             async: false,
//             url: "{{ action('C_transaksi@barang_autocomplete') }}",
//             data: { nama_brg: $(".brg_auto").val(), _token: _token },
//             success: function(msg){
//                 response(msg);
//             }
//         });
        
//     }
// });
function brgAutocomplete()
{
}
</script>
@stop