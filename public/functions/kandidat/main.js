function getData() {
    $.ajax({
        type: "get",
        url: "/kandidat/render",
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
        url: "/kandidat/create",
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
    var i = 0;

    $('body').on('click', '.btn-add', function () {
        i = 0;
        setTimeout(() => {
            $('.group-hide').hide();
        }, 300)
        tambah();
    });

    $('body').on('click', '.btn-data', function () {
        getData();
    });

    $('body').on('click', '.btn-add-misi', function(){
        i++;
        var html = '<div class=row>'+
                        '<div class="col-md-10">' +
                            '<div class="form-group">' +
                                // '<label>Misi'+i+'</label>' +
                                '<textarea class="form-control misi'+i+'" name="misi['+i+']" id="misi'+i+'" placeholder="masukkan misi kandidat"></textarea>' +
                                '<div class="invalid-feedback error-misi'+i+'"></div>' +
                            '</div>' +
                        '</div>' +
                        '<div class="col-md-2">' +
                            '<div class="form-group">' +
                                '<button class="btn btn-danger btn-delete-misi"><i class="fa fa-trash"></i></button>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

        $('.group-misi').append(html);
    })

    $('body').on('click', '.btn-delete-misi', function(){
        $(this).closest('.row').remove();
    });

    $('body').on('change', '#nama', function(){
        var id = $(this).val();
        if(id == '') {
            $('.group-hide').hide();
        } else {
            $('.group-hide').show();
            $.get("/kandidat/detail-kandidat/"+id, function (data) {
                console.table(data);
                $('#tempat-lahir').val(data.tempat_lahir);
                $('#tanggal-lahir').val(data.tanggal_lahir);
                $('#alamat').val(data.alamat);
                $('#jenis-kelamin').val(data.jenis_kelamin);
                $('#no-hp').val(data.no_hp);
            });
        }
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
            url: "/kandidat/store",
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
                    // formName.push((field.name.replace(/\[\d+\]/g, '')).replace('.', ''))
                    formName.push(field.name.replace(/\[|\]/g, ''))
                });
                // console.log(formName)
                if (error.status == 422) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function (key, value) {
                            errorName.push(key.replace('.', ''))
                            if($('.'+key.replace('.', '')).val() == '') {
                                $('.'+key.replace('.', '')).addClass('is-invalid');
                                $('.error-'+key.replace('.', '')).html(value);
                            }
                        });
                        $.each(formName, function (i, field) {
                            // if(!errorName.includes(field)) {
                            //     $('.'+field).removeClass('is-invalid');
                            //     $('.error-'+field).html('');
                            // }
                            $.inArray(field, errorName) == -1 ? $('.'+field).removeClass('is-invalid') : $('.'+field).addClass('is-invalid');
                        });
                    }
                    // console.log(errorName);
                }
            }
        });
    });

    $('body').on('click', '.btn-edit', function () {
        let id = $(this).data('id')
        $.ajax({
            type: "get",
            url: "/kandidat/edit/" + id,
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
            url: "/kandidat/update",
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
                    url: "/kandidat/delete/" + id,
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
                    url: "/kandidat/print/",
                    dataType: "json",
                    success: function (response) {
                        document.title= 'Laporan - ' + new Date().toJSON().slice(0,10).replace(/-/g,'/')
                        $(response.data).find("div.printableArea").printArea(options);
                    }
                });
            }
        })
    });

    // on change status
    $('body').on('change', '#status', function() {
        let idPengumuman = $(this).data('id');
        let currentStatus = $(this).data('status');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/kandidat/change-status",
            data: {
                id_pengumuman: idPengumuman,
                status: $(this).val()
            },
            success: function(response) {
                if(response.status != 'success') {
                    $('#status').val(currentStatus);
                }
                getData();
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            },
            error: function(response) {
                Swal.fire(
                    response.title,
                    response.message,
                    response.status
                );
            }
        });
    });
});