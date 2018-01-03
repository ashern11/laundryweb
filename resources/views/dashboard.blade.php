@extends('templates.index')
@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Daftar Transaksi</h2>
                            <ul class="header-dropdown m-r-0">
                                <a href="{{ url('Transaksi') }}">
                                    <button type="button" class="btn bg-red waves-effect waves-float">
                                            <i class="material-icons">add_circle_outline</i>
                                            <span>Tambah Pesanan</span>
                                    </button>
                                </a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="dataTransaksi">
                                    <thead>
                                        <th>Tanggal</th>
                                        <th>Nota</th>
                                        <th>Kasir</th>
                                        <th>Pelanggan</th>
                                        <th>Total Bayar</th>
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
                                <label class="form-label">NOTA</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="tm_nota" maxlength="30" minlength="3" disabled="">
                                    </div>
                                </div>
                                <label class="form-label">Detail</label>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <div class="table-responsive">
                                            <table class="table table-hover dashboard-task-infos" id="dataCucian">
                                                <thead>
                                                    <th>Jenis</th>
                                                    <th>Jumlah</th>
                                                    <th>Satuan</th>
                                                    <th>Total</th>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect" id="btn_bayar" value="simpan">Bayar</button>
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

        var dataTransaksi = $('#dataTransaksi').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("dataTransaksi") }}'
            },
            columns: [
            {data: 'created_at'},
            {data: 'tm_nota'},
            {data: 'nama_lengkap'},
            {data: 'nama', orderable: false, searchable: false},
            {data: 'tm_total', orderable: false, searchable: false},
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
        $("#btn_bayar").click(function (e) {
            e.preventDefault();     
            $.ajax({
                type: "PUT",
                url: "{{url('bayar')}}" + '/' + task_id,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    dataTransaksi.ajax.reload(null,false);
                    $('#defaultModal').modal('hide');
                    showNotification("bg-cyan", "Sukses", "bottom", "center", "animated zoomIn", "animated zoomOut");
                    window.location = '{{ url("CetakNota")}}'+'/'+ task_id ;
                },
                error: function (data) {
                    console.log('Error:', data);
                    showNotification("bg-red", "Gagal", "bottom", "center", "animated zoomIn", "animated zoomOut");
                }
            });
        });

        //Munculkan modal untuk edit
        $(document).on('click','#edit_modal', function(){
            task_id = $(this).val();
            $('#dataCucian').DataTable({
                destroy : true,
                processing: true,
                serverSide: true,
                searching : false,
                paging : false,
                bInfo : false,
                ajax: {
                    url: '{{ url("detailCucian") }}'+ '/' + task_id
                },
                columns: [
                    {data: 'jenis'},
                    {data: 'jumlah'},
                    {data: 'satuan'},
                    {data: 'total'},
                ]
            }); 
            $('#tm_nota').val(task_id);
            $('#defaultModal').modal('show');
        });

    });

</script>
@endpush