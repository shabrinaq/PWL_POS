@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        @if (!$stok)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                Data stok tidak ditemukan.
            </div>
            <a href="{{ url('stok') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ route('stok.update', $stok->stok_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')

                {{-- Nama Barang --}}
                <div class="form-group row">
                    <label for="barang_id" class="col-2 col-form-label">Nama Barang</label>
                    <div class="col-10">
                        <select class="form-control" name="barang_id" id="barang_id" required>
                            <option value="">- Pilih Barang -</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->barang_id }}" {{ old('barang_id', $stok->barang_id) == $item->barang_id ? 'selected' : '' }}>
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
                    <label for="user_id" class="col-2 col-form-label">Nama User</label>
                    <div class="col-10">
                        <select class="form-control" name="user_id" id="user_id" required>
                            <option value="">- Pilih User -</option>
                            @foreach($user as $item)
                                <option value="{{ $item->user_id }}" {{ old('user_id', $stok->user_id) == $item->user_id ? 'selected' : '' }}>
                                    {{ $item->username }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Jumlah Stok --}}
                <div class="form-group row">
                    <label for="stok_jumlah" class="col-2 col-form-label">Jumlah Stok</label>
                    <div class="col-10">
                        <input type="number" id="stok_jumlah" class="form-control" name="stok_jumlah" value="{{ old('stok_jumlah', $stok->stok_jumlah) }}" required>
                        @error('stok_jumlah')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Tanggal Stok --}}
                <div class="form-group row">
                    <label for="stok_tanggal" class="col-2 col-form-label">Tanggal Stok</label>
                    <div class="col-10">
                        <input type="date" id="stok_tanggal" class="form-control" name="stok_tanggal" value="{{ old('stok_tanggal', $stok->stok_tanggal) }}" required>
                        @error('stok_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                {{-- Button --}}
                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ url('stok') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection