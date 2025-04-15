@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('barang.store') }}" class="form-horizontal">
            @csrf

            {{-- Kode barang --}}
            <div class="form-group row">
                <label for="barang_kode" class="col-1 col-form-label">Kode</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="barang_kode" name="barang_kode" value="{{ old('barang_kode') }}" required>
                    @error('barang_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Nama barang --}}
            <div class="form-group row">
                <label for="barang_nama" class="col-1 col-form-label">Nama</label>
                <div class="col-11">
                    <input type="text" class="form-control" id="barang_nama" name="barang_nama" value="{{ old('barang_nama') }}" required>
                    @error('barang_nama')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Kategori --}}
            <div class="form-group row">
                <label for="kategori_id" class="col-1 col-form-label">Kategori</label>
                <div class="col-11">
                    <select class="form-control" id="kategori_id" name="kategori_id" required>
                        <option value="">- Pilih Kategori -</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->kategori_id }}" {{ old('kategori_id') == $item->kategori_id ? 'selected' : '' }}>
                                {{ $item->kategori_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Harga beli --}}
            <div class="form-group row">
                <label for="harga_beli" class="col-1 col-form-label">Harga Beli</label>
                <div class="col-11">
                    <input type="number" class="form-control" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}" required>
                    @error('harga_beli')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Harga jual --}}
            <div class="form-group row">
                <label for="harga_jual" class="col-1 col-form-label">Harga Jual</label>
                <div class="col-11">
                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}" required>
                    @error('harga_jual')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Button --}}
            <div class="form-group row">
                <div class="col-11 offset-1">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ url('barang') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection