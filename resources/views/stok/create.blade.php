@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ url('stok') }}" class="form-horizontal">
            @csrf

            {{-- Barang --}}
            <div class="form-group row">
                <label for="barang_id" class="col-1 control-label col-form-label">Nama Barang</label>
                <div class="col-11">
                    <select class="form-control" id="barang_id" name="barang_id" required>
                        <option value="">- Pilih Barang -</option>
                        @foreach($barang as $item)
                            <option value="{{ $item->barang_id }}" {{ old('barang_id') == $item->barang_id ? 'selected' : '' }}>
                                {{ $item->barang_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('barang_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- User --}}
            <div class="form-group row">
                <label for="user_id" class="col-1 control-label col-form-label">Nama User</label>
                <div class="col-11">
                    <select class="form-control" id="user_id" name="user_id" required>
                        <option value="">- Pilih User -</option>
                        @foreach($user as $item)
                            <option value="{{ $item->user_id }}" {{ old('user_id') == $item->user_id ? 'selected' : '' }}>
                                {{ $item->username }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Tanggal --}}
            <div class="form-group row">
                <label for="stok_tanggal" class="col-1 control-label col-form-label">Tanggal Stok</label>
                <div class="col-11">
                    <input type="date" class="form-control" id="stok_tanggal" name="stok_tanggal"
                        value="{{ old('stok_tanggal', date('Y-m-d')) }}" required>
                    @error('stok_tanggal')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Jumlah --}}
            <div class="form-group row">
                <label for="stok_jumlah" class="col-1 control-label col-form-label">Jumlah Stok</label>
                <div class="col-11">
                    <input type="number" class="form-control" id="stok_jumlah" name="stok_jumlah"
                        value="{{ old('stok_jumlah') }}" min="1" required>
                    @error('stok_jumlah')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Button --}}
            <div class="form-group row">
                <label class="col-1 control-label col-form-label"></label>
                <div class="col-11">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ url('stok') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection