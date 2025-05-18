@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('penjualan.store') }}" class="form-horizontal">
            @csrf

            {{-- Kode Penjualan --}}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Kode Penjualan</label>
                <div class="col-10">
                    <input type="text" name="penjualan_kode" class="form-control" value="{{ old('penjualan_kode') }}" required placeholder="Kode Penjualan">
                    @error('penjualan_kode')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Pembeli --}}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Pembeli</label>
                <div class="col-10">
                    <input type="text" name="pembeli" class="form-control" value="{{ old('pembeli') }}" required placeholder="Nama Pembeli">
                    @error('pembeli')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- User --}}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">User</label>
                <div class="col-10">
                    <select name="user_id" class="form-control" required>
                        <option value="">-- Pilih User --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>
                                {{ $user->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- Tanggal Penjualan --}}
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Tanggal Penjualan</label>
                <div class="col-10">
                    <input type="date" name="penjualan_tanggal" class="form-control"
                           value="{{ old('penjualan_tanggal', date('Y-m-d')) }}" required>
                    @error('penjualan_tanggal')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            {{-- BUtton --}}
            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="{{ route('penjualan.index') }}" class="btn btn-sm btn-default ml-1">Kembali</a>
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
