@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ route('stok.create') }}">Tambah</a>
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
                    <th>Nama Barang</th>
                    <th>Nama User</th>
                    <th>Jumlah Stok</th>
                    <th>Tanggal Stok</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stok as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td> <!-- Index number -->
                    <td>{{ $item->barang->barang_nama ?? '-' }}</td> <!-- Nama Barang -->
                    <td>{{ $item->user->nama ?? '-' }}</td> <!-- User -->
                    <td>{{ $item->stok_jumlah }}</td> <!-- Jumlah Stok -->
                    <td>{{ \Carbon\Carbon::parse($item->stok_tanggal)->format('d-m-Y') }}</td> <!-- Tanggal Stok -->
                    <td>
                        <a href="{{ route('stok.show', $item->stok_id) }}" class="btn btn-info btn-sm">Detail</a>
                        <a href="{{ route('stok.edit', $item->stok_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form class="d-inline-block" method="POST" action="{{ route('stok.destroy', $item->stok_id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data stok ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data stok tersedia.</td> <!-- Adjusted colspan to 5 -->
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection