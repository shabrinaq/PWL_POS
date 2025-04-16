@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
        </div>
        <div class="card-body">
            @if (!$detail)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    Data detail penjualan tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Detail</th>
                        <td>{{ $detail->detail_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode Penjualan</th>
                        <td>{{ $detail->penjualan->penjualan_kode ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pembeli</th>
                        <td>{{ $detail->penjualan->pembeli ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Penjualan</th>
                        <td>{{ $detail->penjualan->penjualan_tanggal ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Barang</th>
                        <td>{{ $detail->barang->barang_nama ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>{{ number_format($detail->harga, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah</th>
                        <td>{{ $detail->jumlah }}</td>
                    </tr>
                    <tr>
                        <th>Subtotal</th>
                        <td>{{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
                    </tr>
                </table>
            @endif

            <a href="{{ url('penjualan_detail') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection