@extends('adminmaster')

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3 class="h3 mb-0 text-gray-800">Daftar Suplier</h3>
</div>

<form action="" method="post" class="form-horizontal">
    @csrf
    @method('post')

    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Memeber</h5>
        </div>
        <div class="modal-body">
            <div class="form-group row">
                <label for="nama" class="col-lg-2 col-lg-offset-1 control-label">Nama</label>
                <div class="col-lg-6">
                    <input type="text" name="nama" id="nama" class="form-control" required autofocus>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="telepon" class="col-lg-2 col-lg-offset-1 control-label">Telepon</label>
                <div class="col-lg-6">
                    <input type="text" name="telepon" id="telepon" class="form-control" required>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-lg-2 col-lg-offset-1 control-label">Alamat</label>
                <div class="col-lg-6">
                    <textarea name="alamat" id="alamat" rows="3" class="form-control"></textarea>
                    <span class="help-block with-errors"></span>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </div>
    </div>
</form>

<div class="card shadow mt-4 mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"><div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-12 col-md-6"><div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div></div></div><div class="row"><div class="col-sm-12"><table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                <thead>
                    <tr role="row">
                        <th class="sorting sorting_asc" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 5%;">No</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" >Kategory</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" >Alamat</th>
                        <th class="sorting" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" aria-label="Office: activate to sort column ascending" >Action</th>
                </thead>
                <tbody>
                    @foreach ($supplier as $row)
                        <tr>
                            <td>{{$row->id_supplier}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->alamat}}</td>
                            <td>
                                <form action="{{ route('supplier.destroy',$row->id_supplier) }}" method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </div>
                <div class="row">
                <div class="col-sm-12 col-md-7">
            <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
        </div>
    </div>
</div>

@endsection