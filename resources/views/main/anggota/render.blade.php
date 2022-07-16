<div class="card">
    <div class="card-header">
        <div class="card-title">Data Anggota</div>
        <div class="card-options">
            {{-- <button class="btn btn-success btn-print">
                <i class="fa fa-print"></i> Cetak
            </button> --}}

            <button class="btn btn-primary btn-add" style="margin-left: 2px">
                <i class="fa fa-plus"></i> Tambah
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-striped" id="tableData">
            <thead>
                <th>No</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>No. Hp</th>
                <th>Alamat</th>
                <th>Foto</th>
                <th>Status</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->nama}}</td>
                    <td>{{$data->tempat_lahir}}</td>
                    <td>{{$data->tanggal_lahir}}</td>
                    <td>{{$data->no_hp}}</td>
                    <td>{{$data->alamat}}</td>
                    <td>
                        <img src="{{asset($data->foto)}}" class="img-rounded" width="100px">
                    </td>
                    <td>
                        <select name="status" id="status" class="form-control" data-id="{{$data->id_user}}" data-status="{{$data->is_active}}">
                            <option value="1" {{$data->is_active == '1' ? 'selected' : ''}}>Aktif</option>
                            <option value="0" {{$data->is_active == '0' ? 'selected' : ''}}>Tidak Aktif</option>
                        </select>
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm btn-edit" data-id="{{$data->id_user}}">
                            <i class="fa fa-edit"></i>
                        </button>
                        {{-- <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="{{$data->id_data}}">
                            <i class="fa fa-trash"></i>
                        </button> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>