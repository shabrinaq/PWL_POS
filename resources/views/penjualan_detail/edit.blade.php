@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if (!$detail)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                Data detail penjualan tidak ditemukan.
            </div>
            <a href="{{ route('penjualan_detail.index') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
        <form method="POST" action="{{ route('penjualan_detail.update', $detail->detail_id) }}">
                @csrf
                @method('PUT')

                {{-- Penjualan --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Penjualan</label>
                    <div class="col-10">
                        <select name="penjualan_id" class="form-control" required>
                            <option value="">-- Pilih Penjualan --</option>
                            @foreach($penjualans as $penjualan)
                                <option value="{{ $penjualan->penjualan_id }}" {{ old('penjualan_id', $detail->penjualan_id) == $penjualan->penjualan_id ? 'selected' : '' }}>
                                    {{ $penjualan->penjualan_kode }}
                                </option>
                            @endforeach
                        </select>
                        @error('penjualan_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Barang --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Barang</label>
                    <div class="col-10">
                        <select name="barang_id" class="form-control" required>
                            <option value="">-- Pilih Barang --</option>
                            @foreach($barangs as $barang)
                                <option value="{{ $barang->barang_id }}" {{ old('barang_id', $detail->barang_id) == $barang->barang_id ? 'selected' : '' }}>
                                    {{ $barang->barang_nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('barang_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Harga --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Harga</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="harga"
                               value="{{ old('harga', $detail->harga) }}" required>
                        @error('harga')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Jumlah --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Jumlah</label>
                    <div class="col-10">
                        <input type="number" class="form-control" name="jumlah"
                               value="{{ old('jumlah', $detail->jumlah) }}" required>
                        @error('jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Button --}}
                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ route('penjualan_detail.index') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
