@empty($stok)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                Data yang anda cari tidak ditemukan
            </div>
            <a href="{{ url('/stok') }}" class="btn btn-warning">Kembali</a>
        </div>
    </div>
</div>
@else
<form action="#" id="form-show">
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Data Stok</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input value="{{ $stok->barang->barang_nama ?? '-' }}" type="text" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Nama User</label>
                    <input value="{{ $stok->user->nama ?? '-' }}" type="text" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Tanggal Stok</label>
                    <input value="{{ $stok->stok_tanggal }}" type="date" class="form-control" disabled>
                </div>
                <div class="form-group">
                    <label>Jumlah</label>
                    <input value="{{ $stok->stok_jumlah }}" type="number" class="form-control" disabled>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Kembali</button>
            </div>
        </div>
    </div>
</form>
@endempty