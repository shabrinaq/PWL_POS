@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title ?? 'Penjualan' }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('penjualan/create') }}">Tambah</a>
            <button onclick="modalAction('{{ url('penjualan/create_ajax') }}')" class="btn btn-sm btn-success mt-1">
                Tambah Ajax
            </button>
        </div>
    </div>
    <div class="card-body">

        {{-- Alert messages --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        {{-- Filter Dropdown --}}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row align-items-center">
                    <label class="col-1 control-label col-form-label mb-0">Filter:</label>
                    <div class="col-3">
                        <select class="form-control" id="penjualan_filter" name="penjualan_filter">
                            <option value="">- Semua User -</option>
                            @foreach($users as $item)
                                <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabel Penjualan --}}
        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode Penjualan</th>
                    <th>Pembeli</th>
                    <th>User</th>
                    <th>Tanggal Penjualan</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

{{-- Modal untuk Tambah Ajax --}}
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog"
    data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>
@endsection

@push('js')
<script>
    // Fungsi untuk membuka modal
    function modalAction(url = '') {
        $('#myModal').load(url, function () {
            $('#myModal').modal('show');
        });
    }

    var dataPenjualan;

    $(document).ready(function () {
        // Reload datatable ketika filter berubah
        $('#penjualan_filter').change(function () {
            dataPenjualan.ajax.reload();
        });

        // Inisialisasi DataTable
        dataPenjualan = $('#table_penjualan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('penjualan/list') }}",
                type: "POST",
                data: function (d) {
                    d.user_id = $('#penjualan_filter').val();
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
                    data: "penjualan_kode",
                    className: "text-center"
                },
                {
                    data: "pembeli"
                },
                {
                    data: "user"
                },
                {
                    data: "penjualan_tanggal",
                    className: "text-center"
                },
                {
                    data: "aksi",
                    orderable: false,
                    searchable: false,
                    className: "text-center"
                }
            ]
        });
    });
</script>
@endpush
