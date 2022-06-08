@extends('adminmaster')

@section('content')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800">Laporan Keuangan</h3>
</div>

<div class= "mb-3 box-header with-border">
    <button onclick="updatePeriode()" class="btn btn-success btn-xs btn-flat mr-3"><i class="fa fa-plus mr-2" aria-hidden="true"></i> Ubah Periode</button>
    <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-file-pdf-o mr-2" aria-hidden="true"></i> Export PDF</a>
</div>


<div class="row">
    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-success">Tabel Keuangan {{ $tanggalAwal }} hingga {{ $tanggalAkhir }}</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
            <table class="table table-stiped table-bordered table-keuangan">
                    <thead>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" width="5%">
                            No
                        </th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                            Tanggal
                        </th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                            Penjualan
                        </th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                            Pembelian
                        </th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                            Pengeluaran
                        </th>
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">
                        Pendapatan
                        </th>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

@includeIf('laporan.form')
@endsection
@push('scripts')

<script src="{{ asset('/AdminLTE-2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script>
    let table;

    $(function () {
        table = $('.table-keuangan').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'penjualan'},
                {data: 'pembelian'},
                {data: 'pengeluaran'},
                {data: 'pendapatan'}
            ],
            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });

    function updatePeriode() {
        $('#modal-form').modal('show');
    }
</script>
<script src="{{ asset('/ad2/AdminLTE-2/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/ad2/AdminLTE-2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
@endpush