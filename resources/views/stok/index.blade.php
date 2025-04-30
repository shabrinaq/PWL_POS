@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a href="{{ url('stok/create') }}" class="btn btn-sm btn-primary mt-1">Tambah</a>
            <button onclick="modalAction('{{ url('stok/create_ajax') }}')" class="btn btn-sm btn-success mt-1">Tambah Ajax</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="form-group row">
                    <label class="col-1 control-label col-form-label">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="barang_id" name="barang_id">
                            <option value="">- Semua Stok Barang -</option>
                            @foreach($barang as $item)
                                <option value="{{ $item->barang_id }}">{{ $item->barang_nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Nama User</th>
                    <th>Tanggal Stok</th>
                    <th>Jumlah Stok</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
    <div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog"
         data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
</div>
@endsection

@push('css')
@endpush

@push('js')
<script>
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    var dataStok;
    $(document).ready(function () {
        dataStok = $('#table_stok').DataTable({
            serverSide: true,
            ajax: {
                url: "{{ url('stok/list') }}",
                type: "POST",
                data: function (d) {
                    d.barang_id = $('#barang_id').val();
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "barang.barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "user.nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_tanggal",
                    className: "",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "stok_jumlah",
                    className: "",
                    orderable: true,
                    searchable: false
                },
                {
                    data: "aksi",
                    className: "",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#barang_id').on('change', function () {
            dataStok.ajax.reload();
        });
    });
</script>
@endpush