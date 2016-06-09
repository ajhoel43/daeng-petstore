@extends('layouts.default')

@section('main')

<h1>Daftar Pembeli Daeng PetStore</h1>

<p>{{-- link_to_route('pembeli.create', 'Tambahkan pembeli', null, array('class' => 'btn btn-primary')) --}}</p>
<style type="text/css">
    table th { text-align: center; }
</style>
@if ($pembelis->count())
    <table class="table table-striped table-bordered">
        <thead>
            <tr>

                <th>No.</th>
                <th>Nama Pembeli</th>
                <th>Alamat</th>
            </tr>
        </thead>

        <tbody>
            <?php $index = 1; ?>
            @foreach ($pembelis as $pembeli)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $pembeli->nama }}</td>
                    <td>{{ $pembeli->alamat }}</td>
                    <!-- <td align="center" width="80px">{{-- link_to_route('pembeli.edit', 'Edit', array($pembeli->id), array('class' => 'btn btn-info')) }}</td>
                    <td align="center" width="80px">
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('pembeli.destroy', $pembeli->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() --}}
                    </td> -->
                    <?php $index++ ?>
                </tr>
            @endforeach
              
        </tbody>
      
    </table>
@else
    Pembeli tidak ditemukan
@endif

@stop