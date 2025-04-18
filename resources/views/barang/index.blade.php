@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ route('barang.create') }}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form method="GET" action="{{ route('barang.index') }}">
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label class="col-1 col-form-label">Filter:</label>
                        <div class="col-3">
                            <select class="form-control" name="kategori_id" onchange="this.form.submit()">
                                <option value="">- Semua Kategori -</option>
                                @foreach($kategori as $kat)
                                    <option value="{{ $kat->kategori_id }}" {{ request('kategori_id') == $kat->kategori_id ? 'selected' : '' }}>
                                        {{ $kat->kategori_nama }}
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
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($barang as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->barang_kode }}</td>
                        <td>{{ $item->barang_nama }}</td>
                        <td>Rp. {{ number_format($item->harga_beli, 2, ',', '.') }}</td>
                        <td>Rp. {{ number_format($item->harga_jual, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('barang.show', $item->barang_id) }}" class="btn btn-info btn-sm">Detail</a>
                            <a href="{{ route('barang.edit', $item->barang_id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form class="d-inline-block" method="POST" action="{{ route('barang.destroy', $item->barang_id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus barang ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data barang.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection