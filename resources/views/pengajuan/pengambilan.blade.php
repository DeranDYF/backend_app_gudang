@extends('template/layout')
@section('content')

<div class="toolbar bg-transparent pt-6 mb-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex flex-column align-items-start me-3 mb-5 mb-lg-0">
            <h1 class="d-flex text-dark fw-bolder fs-3 flex-column mb-0">Pengambilan Barang
            </h1>
        </div>
        @if (Auth::user()->role->role_name == 'staff' || Auth::user()->role->role_name == 'admin')
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-pengambilan-add">Tambah
                Pengajuan</a>
            <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#modal-daftar-barang">Daftar barang</a>
        </div>
        @endif
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="row g-5">
            <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-center h-md-50 mb-5 mb-xl-10">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tb_pengambilan" class="table table-row-bordered gy-5 gs-7 border rounded">
                            <thead>
                                <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                    <th class="text-start">ID Pengambilan</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <!-- <th>Tanggal Pengajuan</th> -->
                                    <th>status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Daftar Barang -->
<div class="modal fade" id="modal-daftar-barang" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Daftar Barang On Stock</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="tb_barang" class="table table-row-bordered gy-5 gs-7 border rounded">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                <th class="text-start">No</th>
                                <th>Nama Barang</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="button" class="btn btn-light-danger text-danger text-hover-white font-medium waves-effect" data-bs-dismiss="modal" id="cancel-daftar-barang">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Daftar Barang -->

<!-- Modal Setting pengambilan Add -->
<div class="modal fade" id="modal-pengambilan-add" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Tambah pengajuan pengambilan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-pengambilan-add" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk menambah pengajuan pengambilan dapat dilakukan disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="barang" class="form-label fw-semibold">Nama Barang</label>
                                <select class="form-select" name="pengambilan-add-pengambilan-name" id="pengambilan-add-pengambilan-name" required>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                                <input type="number" min=1 class="form-control" name="pengambilan-add-pengambilan-jumlah" id="pengambilan-add-pengambilan-jumlah" required>
                                <input type="hidden" class="form-control" name="pengambilan-add-pengambilan-created" id="pengambilan-add-pengambilan-created" value="{{ Auth::user()->username }}" required>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-pengambilan-save">
                    Tambah
                </button>
                <button type="button" class="btn btn-light-danger text-danger text-hover-white font-medium waves-effect" data-bs-dismiss="modal" id="cancel-pengambilan-add">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Setting pengambilan Add -->

<!-- Modal Setting pengambilan Edit -->
<div class="modal fade" id="modal-pengambilan-edit" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Edit pengambilan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-pengambilan-edit" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk mengedit data pengambilan dapat dilakukan disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Nama Barang</label>
                                <input type="hidden" id="pengambilan-edit-pengambilan-id" name="pengambilan-edit-pengambilan-id">
                                <select class="form-select" name="pengambilan-edit-pengambilan-name" id="pengambilan-edit-pengambilan-name" required>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                                <input type="number" class="form-control" name="pengambilan-edit-pengambilan-jumlah" id="pengambilan-edit-pengambilan-jumlah">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-pengambilan-edit">
                    Edit
                </button>
                <button type="button" class="btn btn-light-danger text-danger text-hover-white font-medium waves-effect" data-bs-dismiss="modal" id="cancel-pengambilan-edit">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Setting pengambilan Edit -->

<!-- Modal persetujuan -->
<div class="modal fade" id="modal-pengambilan-persetujuan" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Persetujuan pengajuan pengambilan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="post" class="mx-4" id="form-pengambilan-persetujuan" entype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="fallback">
                        <p class="card-subtitle mb-4">Untuk mengedit status pengajuan pengambilan dapat dilakukan
                            disini.</p>
                        <div class="row">
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Nama Barang</label>
                                <input type="hidden" id="pengambilan-persetujuan-pengambilan-id" name="pengambilan-persetujuan-pengambilan-id">
                                <select class="form-select" name="pengambilan-persetujuan-pengambilan-name" id="pengambilan-persetujuan-pengambilan-name" disabled>
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                                <input type="number" class="form-control" name="pengambilan-persetujuan-pengambilan-jumlah" id="pengambilan-persetujuan-pengambilan-jumlah" disabled>
                            </div>
                            <div class="mb-4">
                                <label for="nama" class="form-label fw-semibold">Persetujuan</label>
                                <select class="form-select" name="pengambilan-persetujuan" id="pengambilan-persetujuan">
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="jumlah" class="form-label fw-semibold">keterangan</label>
                                <input type="text" class="form-control" name="pengambilan-keterangan" id="pengambilan-keterangan">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-pengambilan-persetujuan">
                    Submit
                </button>
                <button type="button" class="btn btn-light-danger text-danger text-hover-white font-medium waves-effect" data-bs-dismiss="modal" id="cancel-pengambilan-persetujuan">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal persetujuan -->

<!-- Modal Detail -->
<div class="modal fade" id="modal-detail" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex align-items-center mx-4 mt-4">
                <h4 class="card-title fw-semibold">Detail</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="fallback">
                    <div class="row">
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-semibold">Kode Pengambilan</label>
                            <input type="text" class="form-control" name="pengambilan-detail-kode-pengambilan" id="pengambilan-detail-kode-pengambilan" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-semibold">Nama Barang</label>
                            <select class="form-select" name="pengambilan-detail-name" id="pengambilan-detail-name" disabled>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                            <input type="number" class="form-control" name="pengambilan-detail-jumlah" id="pengambilan-detail-jumlah" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="nama" class="form-label fw-semibold">Persetujuan</label>
                            <select class="form-select" name="pengambilan-detail-status" id="pengambilan-detail-status" disabled>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-semibold">Keterangan</label>
                            <input type="text" class="form-control" name="pengambilan-detail-keterangan" id="pengambilan-detail-keterangan" disabled>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer mx-4 mb-4">
                <button type="button" class="btn btn-light-danger text-danger text-hover-white font-medium waves-effect" data-bs-dismiss="modal" id="cancel-detail">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Detail -->

<div id="userRole" data-role="{{ Auth::user()->role->role_name }}"></div>
<script>
    $(document).ready(function() {

        var tb_barang = $("#tb_barang").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_"
            },
            ajax: {
                url: "{{ route('get_all_barang_pengambilan')}}",
                type: "GET",
                dataSrc: "",
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return '<p class="text-muted">' + (meta.row + 1) + '</p>';
                    }
                },
                {
                    data: "nama_barang",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + '</p>';
                    }
                },
                {
                    data: "jumlah",
                    render: function(data, type, row) {
                        if (data >= 1) {
                            return '<span class="badge bg-success"> On Stock </span>';
                        } else {
                            return '<p class="text-muted"></p>';
                        }
                    }
                }

            ],
            autoWidth: true,
            lengthChange: false,
            "searching": true,
            "dom": "<'row'" +
                "<'col-sm-12 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-12 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });

        var tb_pengambilan = $("#tb_pengambilan").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_"
            },
            ajax: {
                url: "{{ route('get_all_pengambilan')}}",
                type: "GET",
                dataSrc: "",
            },
            columns: [{
                    data: "kode_pengambilan",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data +
                            '</p>';
                    }
                },
                {
                    data: "nama_barang",
                    render: function(data, type, row) {
                        return '<a data-id="' + row.id +
                            'href="" class="text-primary" data-bs-toggle="modal" data-bs-target="#modal-detail">' +
                            data + '</a>';
                    }
                },
                {
                    data: "jumlah",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + ' Unit</p>';
                    }
                },
                // {
                //     data: "created_at",
                //     render: function(data, type, row) {
                //         return '<div class="text-muted">' + moment(data)
                //             .format('D MMMM YYYY') + '</div>';
                //     }
                // },
                {
                    data: "status",
                    render: function(data, type, row) {
                        if (data === 'Menunggu Persetujuan') {
                            return '<span class="badge bg-secondary text-dark">' + data + '</span>';
                        } else if (data === 'Di Setujui') {
                            return '<span class="badge bg-success">' + data + '</span>';
                        } else {
                            return '<span class="badge bg-danger">' + data + '</span>';
                        }

                    }
                },
                {
                    render: function(data, type, row) {
                        var userRole = document.getElementById('userRole').getAttribute(
                            'data-role');
                        var isDisabled = row.status === 'Di Setujui' ||
                            row.status === 'Di Tolak' && userRole === 'admin' ? 'disabled' : '';
                        var btn = '';

                        if (userRole === 'keeper' || userRole === 'admin') {
                            btn += '<button data-id="' + row.id +
                                '"class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal-pengambilan-persetujuan"' +
                                isDisabled + '>' +
                                '<span class="svg-icon svg-icon-3">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                                '<path d="M19.5,10.5 L21,10.5 C21.8284271,10.5 22.5,11.1715729 22.5,12 C22.5,12.8284271 21.8284271,13.5 21,13.5 L19.5,13.5 C18.6715729,13.5 18,12.8284271 18,12 C18,11.1715729 18.6715729,10.5 19.5,10.5 Z M16.0606602,5.87132034 L17.1213203,4.81066017 C17.7071068,4.22487373 18.6568542,4.22487373 19.2426407,4.81066017 C19.8284271,5.39644661 19.8284271,6.34619408 19.2426407,6.93198052 L18.1819805,7.99264069 C17.5961941,8.57842712 16.6464466,8.57842712 16.0606602,7.99264069 C15.4748737,7.40685425 15.4748737,6.45710678 16.0606602,5.87132034 Z M16.0606602,18.1819805 C15.4748737,17.5961941 15.4748737,16.6464466 16.0606602,16.0606602 C16.6464466,15.4748737 17.5961941,15.4748737 18.1819805,16.0606602 L19.2426407,17.1213203 C19.8284271,17.7071068 19.8284271,18.6568542 19.2426407,19.2426407 C18.6568542,19.8284271 17.7071068,19.8284271 17.1213203,19.2426407 L16.0606602,18.1819805 Z M3,10.5 L4.5,10.5 C5.32842712,10.5 6,11.1715729 6,12 C6,12.8284271 5.32842712,13.5 4.5,13.5 L3,13.5 C2.17157288,13.5 1.5,12.8284271 1.5,12 C1.5,11.1715729 2.17157288,10.5 3,10.5 Z M12,1.5 C12.8284271,1.5 13.5,2.17157288 13.5,3 L13.5,4.5 C13.5,5.32842712 12.8284271,6 12,6 C11.1715729,6 10.5,5.32842712 10.5,4.5 L10.5,3 C10.5,2.17157288 11.1715729,1.5 12,1.5 Z M12,18 C12.8284271,18 13.5,18.6715729 13.5,19.5 L13.5,21 C13.5,21.8284271 12.8284271,22.5 12,22.5 C11.1715729,22.5 10.5,21.8284271 10.5,21 L10.5,19.5 C10.5,18.6715729 11.1715729,18 12,18 Z M4.81066017,4.81066017 C5.39644661,4.22487373 6.34619408,4.22487373 6.93198052,4.81066017 L7.99264069,5.87132034 C8.57842712,6.45710678 8.57842712,7.40685425 7.99264069,7.99264069 C7.40685425,8.57842712 6.45710678,8.57842712 5.87132034,7.99264069 L4.81066017,6.93198052 C4.22487373,6.34619408 4.22487373,5.39644661 4.81066017,4.81066017 Z M4.81066017,19.2426407 C4.22487373,18.6568542 4.22487373,17.7071068 4.81066017,17.1213203 L5.87132034,16.0606602 C6.45710678,15.4748737 7.40685425,15.4748737 7.99264069,16.0606602 C8.57842712,16.6464466 8.57842712,17.5961941 7.99264069,18.1819805 L6.93198052,19.2426407 C6.34619408,19.8284271 5.39644661,19.8284271 4.81066017,19.2426407 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"/>' +
                                '</svg>' +
                                '</span>' +
                                '</button>';
                        }
                        if (userRole === 'staff' || userRole === 'admin') {
                            btn += '<button data-id="' + row.id +
                                '"class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#modal-pengambilan-edit"' +
                                isDisabled + '>' +
                                '<span class="svg-icon svg-icon-3">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                                '<path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />' +
                                '<path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />' +
                                '</svg>' +
                                '</span>' +
                                '</button>' +
                                '<button data-id="' + row.id +
                                '"class="btn btn-icon btn-active-light-primary w-30px h-30px btn-delete-pengambilan" data-kt-permissions-table-filter="delete_row">' +
                                '<span class="svg-icon svg-icon-3">' +
                                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">' +
                                '<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />' +
                                '<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />' +
                                '<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />' +
                                '</svg>' +
                                '</span>' +
                                '</button>';
                        }
                        return btn;
                    },
                    className: 'text-center',
                    sortable: false
                }
            ],
            autoWidth: true,
            lengthChange: false,
            "searching": true,
            "dom": "<'row'" +
                "<'col-sm-12 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-12 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });

        $('#modal-pengambilan-edit').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_pengambilan_by_id') }}" + '/' + id,
                dataType: "JSON",
                success: function(response) {
                    $('#pengambilan-edit-pengambilan-id').val(response.id);
                    // $('#pengambilan-edit-pengambilan-name').val(response.pengambilan_name);
                    $('#pengambilan-edit-pengambilan-jumlah').val(response.jumlah);
                    $.ajax({
                        url: "{{ route('get_all_barang_pengambilan')}}",
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key,
                                value) {
                                var option = $(
                                        "<option></option>"
                                    )
                                    .attr(
                                        "value",
                                        value.id
                                    )
                                    .text(value.nama_barang);
                                if (value.id ==
                                    response
                                    .id_role) {
                                    option.attr(
                                        "selected",
                                        "selected"
                                    );
                                }
                                $('#pengambilan-edit-pengambilan-name')
                                    .append(
                                        option);
                            });
                        }
                    });
                }
            });
        });

        $('#modal-pengambilan-edit').on('hide.bs.modal', function(e) {
            $('#form-pengambilan-edit')[0].reset();
        });

        $('#modal-detail').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_pengambilan_by_id') }}" + '/' + id,
                dataType: "JSON",
                success: function(response) {
                    console.log(response);
                    var optionDiSetujui = $('<option>').val('Di Setujui').text('Di Setujui');
                    var optionDiTolak = $('<option>').val('Di Tolak').text('Di Tolak');
                    var optionMenungguPersetujuan = $('<option>').val('Menunggu Persetujuan')
                        .text('Menunggu Persetujuan');
                    $('#pengambilan-detail-status').append(optionDiSetujui);
                    $('#pengambilan-detail-status').append(optionDiTolak);
                    $('#pengambilan-detail-status').append(optionMenungguPersetujuan);
                    if (response.status === 'Di Tolak') {
                        $('#pengambilan-detail-status option[value="Di Tolak"]').prop(
                            'selected', true);
                    } else if (response.status === 'Di Setujui') {
                        $('#pengambilan-detail-status option[value="Di Setujui"]').prop(
                            'selected', true);
                    } else if (response.status === 'Menunggu Persetujuan') {
                        $('#pengambilan-detail-status option[value="Menunggu Persetujuan"]')
                            .prop(
                                'selected', true);
                    }
                    $('#pengambilan-detail-kode-pengambilan').val(response.kode_pengambilan);
                    $('#pengambilan-detail-jumlah').val(response.jumlah);
                    $.ajax({
                        url: "{{ route('get_all_barang_pengambilan')}}",
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key,
                                value) {
                                var option = $(
                                        "<option></option>"
                                    )
                                    .attr(
                                        "value",
                                        value.id
                                    )
                                    .text(value.nama_barang);
                                if (value.id ==
                                    response
                                    .id_role) {
                                    option.attr(
                                        "selected",
                                        "selected"
                                    );
                                }
                                $('#pengambilan-detail-name')
                                    .append(
                                        option);
                            });
                        }
                    });
                }
            });
        });

        $('#modal-pengambilan-edit').on('hide.bs.modal', function(e) {
            $('#form-pengambilan-edit')[0].reset();
        });

        $('#btn-pengambilan-edit').click(function() {
            let button = $(this);
            button.prop('disabled', true);
            button.html(
                "<span class='spinner-border spinner-border-sm me-1' pengambilan='status' aria-hidden='true'></span> Please wait..."
            );

            let valid = true;
            let msg = '';

            $('#form-pengambilan-edit :input[required]').each(function(index,
                element) {
                $(this).removeClass('is-invalid');
                $(this).next('span').removeClass('is-invalid');
                if ($(this).val() == '') {
                    $(this).addClass('is-invalid');
                    $(this).next('span').addClass('is-invalid');
                    msg = 'Please complete the data';
                    valid = false;
                }
            });
            if (valid) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('edit_pengambilan') }}",
                    data: $('#form-pengambilan-edit').serializeArray(),
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.msg,
                                "Success", {
                                    progressBar: true
                                });
                            button.prop('disabled', false);
                            button.text('Edit');
                            $('#modal-pengambilan-edit').modal(
                                'hide');
                            tb_pengambilan.ajax.reload();
                        } else {
                            toastr.error(response.msg, "Failed", {
                                progressBar: true
                            });
                            button.prop('disabled', false);
                            button.text('Edit');
                        }
                    }
                });
            } else {
                toastr.warning(msg, "Warning", {
                    progressBar: true
                });
                button.prop('disabled', false);
                button.text('Edit');
            }
        });

        $('body').on('click', '.btn-delete-pengambilan', function() {
            let id = $(this).data('id');
            console.log(id);
            Swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Data Pengajuan pengambilan yang dihapus tidak dapat kembali!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                customClass: {
                    confirmButton: 'btn btn-danger',
                    cancelButton: 'btn btn-secondary'
                },
            }).then((result) => {
                if (result.isConfirmed) {

                    let button = $(this);
                    button.prop('disabled', true);

                    let csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: "POST",
                        url: "{{ url('delete_pengambilan') }}" + '/' + id,
                        dataType: "JSON",
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(response.msg,
                                    "Success", {
                                        progressBar: true
                                    });
                                tb_pengambilan.ajax.reload();
                            } else {
                                toastr.error(response.msg,
                                    "Failed", {
                                        progressBar: true
                                    });
                                button.prop('disabled',
                                    false);
                                button.text('Reset');
                            }
                        }
                    });
                }
            });
        });


        $('#modal-pengambilan-add').on('show.bs.modal', function(e) {
            $('#form-pengambilan-add')[0].reset();
            $.ajax({
                url: "{{ route('get_all_barang_pengambilan')}}",
                dataType: 'json',
                success: function(data) {
                    $.each(data, function(key,
                        value) {
                        var option = $(
                                "<option></option>"
                            )
                            .attr(
                                "value",
                                value.id
                            )
                            .text(value.nama_barang);
                        $('#pengambilan-add-pengambilan-name')
                            .append(
                                option);
                    });
                }
            });
        });

        $('#modal-pengambilan-add').on('hide.bs.modal', function(e) {
            $('#form-pengambilan-add')[0].reset();
            $('#pengambilan-add-pengambilan-name').empty();
        });

        $('#btn-pengambilan-save').click(function() {
            let button = $(this);
            button.prop('disabled', true);
            button.html(
                "<span class='spinner-border spinner-border-sm me-1' pengambilan='status' aria-hidden='true'></span> Please wait..."
            );
            let valid = true;
            let msg = '';
            $('#form-pengambilan-add :input[required]').each(function(index, element) {
                $(this).removeClass('is-invalid');
                $(this).next('span').removeClass('is-invalid');
                if ($(this).val() == '') {
                    $(this).addClass('is-invalid');
                    $(this).next('span').addClass('is-invalid');
                    msg = 'Please complete the data';
                    valid = false;
                }
            });

            if (valid) {
                let form_data = new FormData($('#form-pengambilan-add')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('add_pengambilan')}}",
                    data: form_data,
                    cache: false,
                    contentType: false,
                    processData: false,
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            console.log(response);
                            toastr.success(response.msg, "Success", {
                                progressBar: true
                            });
                            button.prop('disabled', false);
                            button.text('Tambah');
                            $('#modal-pengambilan-add').modal(
                                'hide');
                            tb_pengambilan.ajax.reload();
                        } else {
                            console.log(response);
                            toastr.error(response.msg, "Failed", {
                                progressBar: true
                            });
                            button.prop('disabled', false);
                            button.text('Tambah');
                        }
                    }
                });
            } else {
                toastr.warning(msg, "Warning", {
                    progressBar: true
                });

                button.prop('disabled', false);
                button.text('Tambah');
            }
        });

        $('#modal-pengambilan-persetujuan').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_pengambilan_by_id') }}" + '/' + id,
                dataType: "JSON",
                success: function(response) {
                    $('#pengambilan-persetujuan-pengambilan-id').val(response.id);
                    $.ajax({
                        url: "{{ route('get_all_barang_pengambilan')}}",
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key,
                                value) {
                                var option = $(
                                        "<option></option>"
                                    )
                                    .attr(
                                        "value",
                                        value.id
                                    )
                                    .text(value.nama_barang);
                                if (value.id === response.id_barang) {
                                    option.attr("selected", "selected");
                                }
                                $('#pengambilan-persetujuan-pengambilan-name')
                                    .append(
                                        option);
                            });
                        }
                    });
                    $('#pengambilan-persetujuan-pengambilan-jumlah').val(response.jumlah);
                    var optionDiSetujui = $('<option>').val('Di Setujui').text('Di Setujui');
                    var optionDiTolak = $('<option>').val('Di Tolak').text('Di Tolak');
                    $('#pengambilan-persetujuan').append(optionDiSetujui);
                    $('#pengambilan-persetujuan').append(optionDiTolak);
                    if (response.status === 'Di Tolak') {
                        $('#pengambilan-persetujuan option[value="Di Tolak"]').prop(
                            'selected', true);
                    } else if (response.status === 'Di Setujui') {
                        $('#pengambilan-persetujuan option[value="Di Setujui"]').prop(
                            'selected', true);
                    }

                }
            });
        });

        $('#modal-pengambilan-persetujuan').on('hide.bs.modal', function(e) {
            $('#form-pengambilan-persetujuan')[0].reset();
            $('#pengambilan-persetujuan-pengambilan-name').empty();
            $('#pengambilan-persetujuan').empty();

        });

        $('#btn-pengambilan-persetujuan').click(function() {
            let button = $(this);
            button.prop('disabled', true);
            button.html(
                "<span class='spinner-border spinner-border-sm me-1' pengambilan='status' aria-hidden='true'></span> Please wait..."
            );

            let valid = true;
            let msg = '';

            $('#form-pengambilan-persetujuan :input[required]').each(function(index,
                element) {
                $(this).removeClass('is-invalid');
                $(this).next('span').removeClass('is-invalid');
                if ($(this).val() == '') {
                    $(this).addClass('is-invalid');
                    $(this).next('span').addClass('is-invalid');
                    msg = 'Please complete the data';
                    valid = false;
                }
            });
            if (valid) {
                $.ajax({
                    type: "POST",
                    url: "{{ url('update-persetujuan') }}",
                    data: $('#form-pengambilan-persetujuan').serializeArray(),
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.msg,
                                "Success", {
                                    progressBar: true
                                });
                            button.prop('disabled', false);
                            button.text('Submit');
                            $('#modal-pengambilan-persetujuan').modal(
                                'hide');
                            tb_pengambilan.ajax.reload();
                        } else {
                            toastr.error(response.msg, "Failed", {
                                progressBar: true
                            });
                            button.prop('disabled', false);
                            button.text('Submit');
                        }
                    }
                });
            } else {
                toastr.warning(msg, "Warning", {
                    progressBar: true
                });
                button.prop('disabled', false);
                button.text('Submit');
            }
        });

    });
</script>


@endsection