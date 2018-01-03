@extends('templates.index')
@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <h2>PELANGGAN</h2>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Pelanggan</h2>
                            <ul class="header-dropdown m-r-0">
                                    <button type="button" class="btn bg-red waves-effect waves-float" id="btn_modal">
                                            <i class="material-icons">add_circle_outline</i>
                                            <span>Tambah</span>
                                    </button>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="dataPelanggan">
                                    <thead>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Telp</th>
                                        <th>Aksi</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
        <!-- Default Size -->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form id="form_modal" novalidate="novalidate">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Tambah Pelanggan</h4>
                    </div>
                    <div class="modal-body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="nama" maxlength="30" minlength="3" required>
                                        <label class="form-label">Nama</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 Karakter</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <textarea id="alamat" cols="30" rows="5" class="form-control no-resize" required=""></textarea>
                                        <label class="form-label">Alamat</label>
                                    </div>
                                    <div class="help-info">Min. Value: 5, Max. Value: 100</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="no_hp" maxlength="15" minlength="6" required>
                                        <label class="form-label">No HP</label>
                                    </div>
                                    <div class="help-info">Min. 6, Max. 15 Karakter</div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect" id="btn_simpan" value="simpan">Simpan</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
@endsection

@push('js')
<script type="text/javascript">
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

        var dataPelanggan = $('#dataPelanggan').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("dataPelanggan") }}'
            },
            columns: [
            {data: 'id_pelanggan', name: 'id_pelanggan'},
            {data: 'nama', name: 'nama'},
            {data: 'alamat', name: 'alamat'},
            {data: 'telp', name: 'telp', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        });

        //Menampilkan modal tambah
        $('#btn_modal').click(function(){
            $('#btn_simpan').val("simpan");
            $('#form_modal').trigger("reset");
            $('#defaultModal').modal('show');
        });


            //Simpan atau Ubah Data
               //create new task / update existing task
        $("#btn_simpan").click(function (e) {
            e.preventDefault();     

            var formData = {
                nama : $('#nama').val(),
                alamat : $('#alamat').val(),
                telp : $('#no_hp').val(),
            }

            var state = $('#btn_simpan').val();
            var type = "POST"; //membuat data baru
            var my_url = "{{url('dataPelanggan')}}";
            var alert = "Data Pelanggan berhasil ditambah";
            if (state == "Ubah"){
                type = "PUT"; //memperbaharui data yang sudah ada
                my_url += '/' + task_id;
                alert = "Data Pelanggan berhasil diubah";
            }

            console.log(formData);
            console.log(state);
            $.ajax({
                type: type,
                url: my_url,
                data: formData,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    dataPelanggan.ajax.reload(null,false); 
                    $('#form_modal').trigger("reset");
                    $('#defaultModal').modal('hide');
                    if($.isEmptyObject(data.error)){
                        showNotification("bg-cyan", data.success, "bottom", "center", "animated zoomIn", "animated zoomOut");
                    }else{
                        printErrorMsg(data.error);
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                    showNotification("bg-red", "Gagal: Kontak Admin", "bottom", "center", "animated zoomIn", "animated zoomOut");
                }
            });
        });

        function printErrorMsg (msg) {
            $.each( msg, function( key, value ) {
                showNotification("bg-red", value, "bottom", "center", "animated zoomIn", "animated zoomOut");
            });
        }

        //Munculkan modal untuk edit
        $(document).on('click','#edit_modal', function(){
            task_id = $(this).val();
            $.get('{{ url("dataPelanggan") }}'+ '/' + task_id, function (data) {
                //success data
                console.log(data);
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#no_hp').val(data.telp);
                $('#btn_simpan').val("Ubah");
            }); 
                $('#defaultModal').modal('show');
        });

    });

</script>
@endpush