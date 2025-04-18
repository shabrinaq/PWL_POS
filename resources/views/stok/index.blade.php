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

        <form method="GET" action="{{ route('stok.index') }}">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" name="barang_id" onchange="this.form.submit()">
                                <option value="">- Semua Barang -</option>
                                @foreach($barang as $b)
                                    <option value="{{ $b->barang_id }}" {{ request('barang_id') == $b->barang_id ? 'selected' : '' }}>
                                        {{ $b->barang_nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-striped table-hover table-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Barang</th>
                    <th>Pangkat Pengguna</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stok as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->barang->barang_nama ?? '-' }}</td>
                        <td>{{ $item->user->nama ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->stok_tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $item->stok_jumlah }}</td>
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
                        <td colspan="6" class="text-center">Tidak ada data stok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection