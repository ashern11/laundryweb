@extends('templates.index')
@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <h2>JENIS LAUNDRY</h2>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Jenis Laundry</h2>
                            <ul class="header-dropdown m-r-0">
                                    <button type="button" class="btn bg-red waves-effect waves-float" id="btn_modal">
                                            <i class="material-icons">add_circle_outline</i>
                                            <span>Tambah</span>
                                    </button>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="dataJenisLaundry">
                                    <thead>
                                        <th>ID</th>
                                        <th>Jenis</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
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
                        <h4 class="modal-title" id="defaultModalLabel">Tambah Jenis Laundry</h4>
                    </div>
                    <div class="modal-body">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="jenis" maxlength="30" minlength="3" required>
                                        <label class="form-label">Jenis</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 Karakter</div>
                                </div>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="satuan" maxlength="30" minlength="3" required>
                                        <label class="form-label">Satuan</label>
                                    </div>
                                    <div class="help-info">Min. 3, Max. 30 Karakter</div>
                                </div>

                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="number" class="form-control" id="harga" required>
                                        <label class="form-label">Harga</label>
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
    $(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        dataJenislaundry = $('#dataJenisLaundry').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("dataJenislaundry") }}'
            },
            columns: [
            {data: 'id_jenis'},
            {data: 'jenis'},
            {data: 'satuan'},
            {data: 'harga', orderable: false, searchable: false},
            {data: 'action', orderable: false, searchable: false},
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
                jenis : $('#jenis').val(),
                satuan : $('#satuan').val(),
                harga : $('#harga').val(),
            }

            var state = $('#btn_simpan').val();
            var type = "POST"; //membuat data baru
            var my_url = "{{url('dataJenislaundry')}}";
            if (state == "Ubah"){
                type = "PUT"; //memperbaharui data yang sudah ada
                my_url += '/' + task_id;
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
                    dataJenislaundry.ajax.reload(null,false);
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
            $.get('{{ url("dataJenislaundry") }}'+ '/' + task_id, function (data) {
                //success data
                console.log(data);
                $('#jenis').val(data.jenis);
                $('#satuan').val(data.satuan);
                $('#harga').val(data.harga);
                $('#btn_simpan').val("Ubah");
            }); 
                $('#defaultModal').modal('show');
        });

    });
</script>
@endpush