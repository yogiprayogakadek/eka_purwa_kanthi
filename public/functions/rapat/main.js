function getData() {
    $.ajax({
        type: "get",
        url: "/rapat/render",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function tambah() {
    $.ajax({
        type: "get",
        url: "/rapat/create",
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

function absen(id_rapat) {
    $.ajax({
        type: "get",
        url: "/rapat/absen/" + id_rapat,
        dataType: "json",
        success: function (response) {
            $(".render").html(response.data);
        },
        error: function (error) {
            console.log("Error", error);
        },
    });
}

$(document).ready(function () {
    getData();

    $('body').on('click', '.btn-add', function () {
        tambah();
    });

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    // on save button
    $('body').on('click', '.btn-save', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formAdd')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/rapat/store",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-save').attr('disable', 'disabled')
                $('.btn-save').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-save').removeAttr('disable')
                $('.btn-save').html('Simpan')
            },
            success: function (response) {
                $('#formAdd').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formAdd').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $.ajax({
            type: "get",
            url: "/rapat/edit/" + id,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    });

    // on update button
    $('body').on('click', '.btn-update', function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let form = $('#formEdit')[0]
        let data = new FormData(form)
        $.ajax({
            type: "POST",
            url: "/rapat/update",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            beforeSend: function () {
                $('.btn-update').attr('disable', 'disabled')
                $('.btn-update').html('<i class="fa fa-spin fa-spinner"></i>')
            },
            complete: function () {
                $('.btn-update').removeAttr('disable')
                $('.btn-update').html('Simpan')
            },
            success: function (response) {
                $('#formEdit').trigger('reset')
                $(".invalid-feedback").html('')
                getData();
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function (error) {
                let formName = []
                let errorName = []

                $.each($('#formEdit').serializeArray(), function (i, field) {
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key)
                            if($('.'+key).val() == '') {
                                $('.' + key).addClass('is-invalid')
                                $('.error-' + key).html(value)
                            }
                        })
                        $.each(formName, function (i, field) {
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                }
            }
        });
    });

    $('body').on('click', '.btn-delete', function () {
        let id = $(this).data('id')
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data yang sudah dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "get",
                    url: "/rapat/delete/" + id,
                    dataType: "json",
                    success: function (response) {
                        $(".render").html(response.data);
                        getData();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                    },
                    error: function (error) {
                        console.log("Error", error);
                    },
                });
            }
        })
    });

    $('body').on('click', '.btn-print', function () {
        Swal.fire({
            title: 'Cetak data kategori?',
            text: "Laporan akan dicetak",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, cetak!'
        }).then((result) => {
            if (result.value) {
                var mode = "iframe"; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close,
                    popTitle: 'Sarpras',
                };
                $.ajax({
                    type: "GET",
                    url: "/rapat/print/",
                    dataType: "json",
                    success: function (response) {
                        document.title= 'Laporan - ' + new Date().toJSON().slice(0,10).replace(/-/g,'/')
                        $(response.data).find("div.printableArea").printArea(options);
                    }
                });
            }
        })
    });

    $('body').on('click', '.btn-notulen', function(){
        let id = $(this).data('id')
        let notulen = $(this).data('notulen')
        $('#modalNotulen').modal('show')
        $('#modalNotulen').find('#id_rapat').val(id)
        $('#modalNotulen').find('#notulen').val(notulen)
    });

    $('body').on('click', '.btn-update-notulen', function(){
        let id = $('#modalNotulen').find('#id_rapat').val()
        let notulen = $('#modalNotulen').find('#notulen').val()
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if(notulen == '') {
            $('#modalNotulen').find('#notulen').addClass('is-invalid')
            $('#modalNotulen').find('.error-notulen').html('Notulen harus diisi')
            $('#modalNotulen').find('#notulen').focus()
            return false
        } else {
            $.ajax({
                type: "POST",
                url: "/rapat/notulen",
                data: {
                    id_rapat: id,
                    notulen: notulen
                },
                success: function (response) {
                    $('#modalNotulen').modal('hide')
                    $('#modalNotulen').find('#notulen').removeClass('is-invalid')
                    $('#modalNotulen').find('.error-notulen').html('')
                    getData();
                    Swal.fire(
                        response.title,
                        response.message,
                        response.status
                    );
                    // $('#modalNotulen').find('#notulen').val(response.data)
                },
                error: function (error) {
                    console.log("Error", error);
                }
            })
        }
    });

    $('body').on('click', '.btn-absen', function(){
        let id = $(this).data('id')
        absen(id)
    });

    $('body').on('click', '.btn-proses-absensi', function(){
        let id_rapat = $('#id_rapat').val();
        let panjang = $('.absensi').length;
        let anggota = [];
        let absensi = [];
        Swal.fire({
            title: 'Proses absensi?',
            text: "Absensi akan diproses",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, proses!'
        }).then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                for(let i = 1; i <= (panjang/2); i++) {
                    absensi[i] = $('input[name=absensi_'+i+']:checked').attr('value');
                    anggota[i] = $('input[name=absensi_'+i+']:checked').data('user');
                }
                let form = $('#formAbsensi')[0]
                let data = new FormData(form)
                data.append('absensi', absensi)
                data.append('anggota', anggota)
                data.append('id_rapat', id_rapat)
                $.ajax({
                    type: "POST",
                    url: "/rapat/proses-absensi",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    beforeSend: function () {
                        $('.btn-proses-absensi').attr('disable', 'disabled')
                        $('.btn-proses-absensi').html('<i class="fa fa-spin fa-spinner"></i>')
                    },
                    complete: function () {
                        $('.btn-proses-absensi').removeAttr('disable')
                        $('.btn-proses-absensi').html('Simpan')
                    },
                    success: function (response) {
                        // console.log(response)
                        // $('#form').trigger('reset')
                        // $(".invalid-feedback").html('')
                        getData();
                        Swal.fire(
                            response.title,
                            response.message,
                            response.status
                        );
                    },
                    error: function (error) {
                        console.log("Error", error);
                    }
                });
            }
        })
    });

    $('body').on('click', '.detail-absen', function(){
        let id = $(this).data('id')
        $('#modalAbsen').find('#id_rapat').val(id)
        $('#modalAbsen').modal('show')
        $('#tableAbsen tbody').empty()
        // $('#tableAbsen #total').empty()
        $.get("/rapat/detail-absensi/"+id, function (response) {
            $('#modalAbsen').find('.modal-title').html('Detail Absensi - ' + response.rapat.perihal_rapat)
            $.each(response.data, function (index, value) { 
                let tr = '<tr>' +
                            '<td>'+value.no+'</td>' +
                            '<td>'+value.nama+'</td>' +
                            '<td>'+value.jabatan+'</td>' +
                            '<td>'+value.kehadiran+'</td>' +
                        '</tr>'
                $('#tableAbsen tbody').append(tr)
            });
            $('#tableAbsen #totalHadir').html(response.totalHadir + ' orang')
            $('#tableAbsen #totalTidakHadir').html((response.totalTidakHadir == 0 ? '-' : response.totalTidakHadir + ' orang'))
        });
    });

    $('body').on('click', '.btn-update-absen', function(){
        let id = $('#modalAbsen').find('#id_rapat').val()
        absen(id)
        $('#modalAbsen').modal('hide')
    });
});