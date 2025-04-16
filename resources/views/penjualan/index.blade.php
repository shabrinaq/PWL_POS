@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a>
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
                    <th>No</th>
                    <th>Kode Penjualan</th>
                    <th>Pembeli</th>
                    <th>Tanggal Penjualan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($penjualans as $index => $penjualan)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $penjualan->penjualan_kode }}</td>
                    <td>{{ $penjualan->pembeli }}</td>
                    <td>{{ $penjualan->penjualan_tanggal }}</td>
                    <td>
                        <a href="{{ url('penjualan/'.$penjualan->penjualan_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ url('penjualan/'.$penjualan->penjualan_id.'/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                        <form class="d-inline-block" method="POST" action="{{ url('penjualan/'.$penjualan->penjualan_id) }}">
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