@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan_detail/create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        
        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Penjualan</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($details as $index => $detail)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $detail->penjualan->penjualan_kode ?? '-' }}</td>
                    <td>{{ $detail->barang->barang_nama ?? '-' }}</td>
                    <td>Rp{{ number_format($detail->harga, 0, ',', '.') }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>Rp{{ number_format($detail->harga * $detail->jumlah, 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ url('penjualan_detail/'.$detail->detail_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ url('penjualan_detail/'.$detail->detail_id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        <form class="d-inline-block" method="POST" action="{{ url('penjualan_detail/'.$detail->detail_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection