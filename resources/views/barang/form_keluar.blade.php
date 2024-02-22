@extends('template/layout')
@section('content')
<div class="toolbar bg-transparent pt-6 mb-5" id="kt_toolbar">
    <div id="kt_toolbar_container" class="container-xxl d-flex flex-stack">
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex flex-column align-items-start me-3 mb-5 mb-lg-0">
            <h1 class="d-flex text-dark fw-bolder fs-3 flex-column mb-0">Form Keluar
            </h1>
        </div>
    </div>
</div>
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        <div class="row">
            <div class="col-5">
                <div class="card card-flush">
                    <div class="card-body">
                        <h1 class="d-flex text-dark fw-bolder fs-6 flex-column mb-4">Input Form Keluar
                        </h1>
                        <form action="post" id="form-keluar-add" entype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="fallback">
                                <div class="row">
                                    <div class="mb-4">
                                        <label for="nama" class="form-label fw-semibold">Nama</label>
                                        <select class="form-select" name="keluar-add-name" id="keluar-add-name">
                                        </select>
                                        <input type="hidden" class="form-control" name="keluar-add-created" value="{{ Auth::user()->username }}" id="keluar-add-created">
                                    </div>
                                    <div class="mb-4">
                                        <label for="jumlah" class="form-label fw-semibold">Jumlah</label>
                                        <input type="number" min=1 class="form-control" name="keluar-add-jumlah" id="keluar-add-jumlah" required>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary font-medium waves-effect" id="btn-keluar-add">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-7">
                <div class="card card-flush">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tb_keluar" class="table table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                        <th class="text-start">Kode</th>
                                        <th>Jumlah Pengajuan</th>
                                        <th>Jumlah Keluar</th>
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
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modal-detail-keluar" tabindex="-1" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                            <label for="kode" class="form-label fw-semibold">Kode Keluar</label>
                            <input type="text" class="form-control" name="keluar-detail-kode-keluar" id="keluar-detail-kode-keluar" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="kode" class="form-label fw-semibold">Kode Pengambilan</label>
                            <input type="text" class="form-control" name="keluar-detail-kode-pengambilan" id="keluar-detail-kode-pengambilan" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah Pengajuan</label>
                            <input type="number" class="form-control" name="keluar-detail-kode-jumlah-pengajuan" id="keluar-detail-kode-jumlah-pengajuan" disabled>
                        </div>
                        <div class="mb-4">
                            <label for="jumlah" class="form-label fw-semibold">Jumlah Keluar</label>
                            <input type="number" class="form-control" name="keluar-detail-kode-jumlah-keluar" id="keluar-detail-kode-jumlah-keluar" disabled>
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

<script>
    $(document).ready(function() {
        var tb_keluar = $("#tb_keluar").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_"
            },
            ajax: {
                url: "{{ route('get_all_keluar')}}",
                type: "GET",
                dataSrc: "",
            },
            columns: [{
                    data: "kode_keluar",
                    render: function(data, type, row, meta) {
                        return '<a href="" data-id="' + row.id + '"' +
                            'class="text-primary" data-bs-toggle="modal" data-bs-target="#modal-detail-keluar">' +
                            data + '</a>';
                    }
                },
                {
                    data: "jumlah_pengajuan",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + ' Unit</p>';
                    }
                },
                {
                    data: "jumlah",
                    render: function(data, type, row) {
                        return '<p class="text-muted">' + data + ' Unit</p>';
                    }
                },
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

        $.ajax({
            url: "{{ route('get_all_pengambilan_keluar')}}",
            dataType: 'json',
            success: function(data) {
                $('#keluar-add-id-pengambilan').val(data.id);
                $.each(data, function(key,
                    value) {
                    var option = $(
                            "<option></option>"
                        )
                        .attr(
                            "value",
                            JSON.stringify([value.id, value.id_barang])
                        )
                        .text(value.nama_barang);
                    $('#keluar-add-name')
                        .append(
                            option);
                });
            }
        });



        $('#btn-keluar-add').click(function() {
            let button = $(this);
            button.prop('disabled', true);
            button.html(
                "<span class='spinner-border spinner-border-sm me-1' keluar='status' aria-hidden='true'></span> Please wait..."
            );
            let valid = true;
            let msg = '';
            $('#form-keluar-add :input[required]').each(function(index, element) {
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
                let form_data = new FormData($('#form-keluar-add')[0]);

                $.ajax({
                    type: "POST",
                    url: "{{ route('add_keluar')}}",
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
                            button.text('Submit');
                            $('#keluar-add-jumlah').val('');
                            tb_keluar.ajax.reload();
                        } else {
                            console.log(response);
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

        $('#modal-detail-keluar').on('show.bs.modal', function(e) {
            let id = $(e.relatedTarget).data('id');
            $.ajax({
                type: "GET",
                url: "{{ url('get_keluar_by_id') }}" + '/' + id,
                dataType: "JSON",
                success: function(response) {
                    $('#keluar-detail-kode-keluar').val(response[0].kode_keluar);
                    $('#keluar-detail-kode-pengambilan').val(response[0].kode_pengambilan);
                    $('#keluar-detail-kode-jumlah-pengajuan').val(response[0].jumlah_pengajuan);
                    $('#keluar-detail-kode-jumlah-keluar').val(response[0].jumlah);
                }
            });
        });

        $('#modal-detail-keluar').on('hide.bs.modal', function(e) {
            $('#keluar-detail-kode-keluar').val('');
            $('#keluar-detail-kode-pengambilan').val('');
            $('#keluar-detail-kode-jumlah-pengajuan').val('');
            $('#keluar-detail-kode-jumlah-keluar').val('');
        });

    });
</script>


@endsection