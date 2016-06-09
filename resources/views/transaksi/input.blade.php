@extends('layouts.default')

@section('main')

<div class="col-md-12">
    <h1>Buat Transaksi</h1>
    @if (Session::has('message'))
        {!! Session::get('message') !!}
    @endif
    {{ Form::open(array('route' => 'transaksi.store')) }}
        {{ Form::hidden('id', '', array('class' => 'form-control')) }}
        <div class="form-group">
            {{ Form::label('nama', 'Nama Pembeli:', array('class' => 'control-label')) }}
            {{ Form::text('nama', '', array('class' => 'form-control pembeli_auto')) }}
        </div>
        <div class="form-group">
            {{ Form::label('alamat', 'Alamat:', array('class' => 'control-label')) }}
            {{ Form::textarea('alamat', '', array('class' => 'form-control', 'rows' => '2')) }}
        </div>
        {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
</div>
<script>
$.ajaxSetup({cache:false, async: false});

setTimeout(function(){
    $(".pembeli_auto").autocomplete({
        source: "{!! route('autocomplete_pembeli') !!}",
        select: function(event, ui){
            $(".pembeli_auto").val(ui.item.value);
            $("[name='id']").val(ui.item.id);
            $("[name='alamat']").val(ui.item.alamat);
        }
    });
}, 1500);
</script>
@stop