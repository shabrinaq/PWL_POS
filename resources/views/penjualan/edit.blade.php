@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if (!$penjualan)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Error!</h5>
                Data penjualan tidak ditemukan.
            </div>
            <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
        @else
            <form method="POST" action="{{ route('penjualan.update', $penjualan->penjualan_id) }}" class="form-horizontal">
                @csrf
                @method('PUT')
                
                {{-- Kode Penjualan (readonly, jika kode di-generate otomatis) --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Kode Penjualan</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="penjualan_kode"
                               value="{{ old('penjualan_kode', $penjualan->penjualan_kode) }}" readonly>
                    </div>
                </div>
                
                {{-- Pembeli --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Pembeli</label>
                    <div class="col-10">
                        <input type="text" class="form-control" name="pembeli"
                               value="{{ old('pembeli', $penjualan->pembeli) }}" required>
                        @error('pembeli')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                {{-- Tanggal Penjualan --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">Tanggal Penjualan</label>
                    <div class="col-10">
                        <input type="date" class="form-control" name="penjualan_tanggal"
                               value="{{ old('penjualan_tanggal', $penjualan->penjualan_tanggal) }}" required>
                        @error('penjualan_tanggal')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                {{-- User --}}
                <div class="form-group row">
                    <label class="col-2 col-form-label">User</label>
                    <div class="col-10">
                        <select name="user_id" class="form-control" required>
                            <option value="">-- Pilih User --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->user_id }}" {{ old('user_id', $penjualan->user_id) == $user->user_id ? 'selected' : '' }}>
                                    {{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                {{-- Tombol Submit dan Kembali --}}
                <div class="form-group row">
                    <div class="col-10 offset-2">
                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
                    </div>
                </div>
            </form>
        @endif
    </div>
</div>
@endsection

@push('css')
<!-- Tambahkan CSS khusus jika diperlukan -->
@endpush

@push('js')
<!-- Tambahkan JS khusus jika diperlukan -->
@endpush
