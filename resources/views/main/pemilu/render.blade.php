<div class="card">
    <div class="card-header">
        <div class="card-title">Data Pemilu</div>
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
                <th>Tanggal Pemilu</th>
                <th>Hasil Pemilu</th>
                <th>Status</th>
                <th>Chart</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($data as $data)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data->tanggal_pemilu}}</td>
                    {{-- <td>{{$data->data_pemilu == null ? 'Belum ada suara masuk' : 'proses'}}</td> --}}
                    <td>
                        @if ($data->data_pemilu == null)
                            <span class="badge bg-warning">Belum ada suara masuk</span>
                        @else
                        @php
                            $data_pemilu = json_decode($data->data_pemilu)->result ?? false;
                        @endphp
                            @if ($data_pemilu == false)
                                <span class="badge bg-info">Mohon aktifkan hasil pada chart</span>
                            @else
                                <span class="badge bg-success check-result" style="cursor: pointer;">Lihat hasil</span>
                            @endif
                        @endif
                    </td>
                    <td>
                        <select name="status" id="status" class="form-control" data-id="{{$data->id_pemilu}}" data-status="{{$data->status}}">
                            <option value="1" {{$data->status == '1' ? 'selected' : ''}}>Aktif</option>
                            <option value="0" {{$data->status == '0' ? 'selected' : ''}}>Tidak Aktif</option>
                        </select>
                    </td>
                    <td>
                        @if ($data->data_pemilu == null)
                        <span class="badge bg-warning">Belum ada suara masuk</span>
                        @else
                        <select name="chart" id="chart" class="form-control" data-id="{{$data->id_pemilu}}" data-status="{{json_decode($data->data_pemilu)->result}}">
                            <option value="true" {{json_decode($data->data_pemilu)->result == true ? 'selected' : ''}}>Aktif</option>
                            <option value="false" {{json_decode($data->data_pemilu)->result == false ? 'selected' : ''}}>Tidak Aktif</option>
                        </select>
                        @endif
                    </td>
                    <td>
                        <button type="button" class="btn btn-success btn-sm btn-edit" data-id="{{$data->id_pemilu}}">
                            <i class="fa fa-edit"></i>
                        </button>
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