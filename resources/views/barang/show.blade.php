@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($barang)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Error!</h5>
                    The data you are looking for is not found.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover table-sm">
                    <tr>
                        <th>ID Barang</th>
                        <td>{{ $barang->barang_id }}</td>
                    </tr>
                    <tr>
                        <th>ID Kategori</th>
                        <td>{{ $barang->kategori_id }}</td>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <td>{{ $barang->barang_kode }}</td>
                    </tr>
                    <tr>
                        <th>Kategori </th>
                        <td>{{ $barang->kategori->nama_kategori }}</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td>{{ $barang->barang_nama }}</td>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <td>Rp. {{ number_format($barang->harga_beli, 2, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <td>Rp. {{ number_format($barang->harga_jual, 2, ',', '.') }}</td>
                    </tr>
                </table>
            @endempty
            <a href="{{ url('barang') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush

@push('js')
@endpush