@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if (!$penjualan)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Data penjualan tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID</th>
                        <td>{{ $penjualan->penjualan_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode Penjualan</th>
                        <td>{{ $penjualan->penjualan_kode }}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{ $penjualan->pembeli }}</td>
                    </tr>
                     <tr>
                        <th>User</th>
                        <td>{{ $penjualan->user->nama }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Penjualan</th>
                        <td>{{ $penjualan->penjualan_tanggal }}</td>
                    </tr>
                </table>
            @endif

            <a href="{{ url('penjualan') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection