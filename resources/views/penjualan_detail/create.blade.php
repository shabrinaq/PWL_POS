@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('penjualan_detail') }}" class="form-horizontal">
            @csrf

            {{-- Penjualan --}}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Penjualan</label>
                <div class="col-10">
                    <select name="penjualan_id" class="form-control" required>
                        <option value="">-- Pilih Penjualan --</option>
                        @foreach($penjualans as $penjualan)
                            <option value="{{ $penjualan->penjualan_id }}" {{ old('penjualan_id') == $penjualan->penjualan_id ? 'selected' : '' }}>
                                {{ $penjualan->penjualan_kode }} - {{ $penjualan->pembeli }}
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
                <label class="col-2 control-label col-form-label">Barang</label>
                <div class="col-10">
                    <select name="barang_id" class="form-control" required>
                        <option value="">-- Pilih Barang --</option>
                        @foreach($barangs as $barang)
                            <option value="{{ $barang->barang_id }}" {{ old('barang_id') == $barang->barang_id ? 'selected' : '' }}>
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
                <label class="col-2 control-label col-form-label">Harga</label>
                <div class="col-10">
                    <input type="number" name="harga" class="form-control" value="{{ old('harga') }}" required placeholder="Harga per barang">
                    @error('harga')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Jumlah --}}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Jumlah</label>
                <div class="col-10">
                    <input type="number" name="jumlah" class="form-control" value="{{ old('jumlah') }}" required placeholder="Jumlah barang">
                    @error('jumlah')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Button --}}
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ url('penjualan_detail') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush