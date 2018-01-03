@extends('templates.index')
@push('css')
<link href="{{url('plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet">
@endpush

@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Transaksi
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Nota">Nota</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="tm_nota" class="form-control" type="text" value="{{ $nota }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Kasir">Kasir</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="nama_user" class="form-control" type="text" value="{{ Auth::user()->nama_lengkap }} ( {{ Auth::user()->nama_pengguna }} )" disabled>
                                                <input id="id_user" class="form-control" type="hidden" value="{{ Auth::user()->id_user }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Tanggal">Tanggal</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input id="tanggal" class="form-control" type="text" value="{{ $date }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="Pelanggan">Pelanggan</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <select id="id_pelanggan" class="form-control show-tick" data-show-subtext="true">
                                            @foreach($pelanggan as $item)
                                            <option value="{{$item->id_pelanggan}}" data-subtext="{{$item->telp}}">{{$item->nama}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="button" class="btn btn-primary m-t-15 waves-effect" id="btn_simpandata">Lanjutkan Transaksi</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Cucian</h2>
                            <ul class="header-dropdown m-r-0">
                                    <button type="button" class="btn bg-red waves-effect waves-float" id="btn_modal">
                                            <i class="material-icons">add_circle_outline</i>
                                            <span>Tambah Cucian</span>
                                    </button>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="dataCucian">
                                    <thead>
                                        <th>Jenis</th>
                                        <th>Jumlah</th>
                                        <th>Total</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tfoot>
                                    <th>TOTAL</th>
                                    <th>:</th>
                                    <th></th>
                                    <th>!</th>
                                    </tfoot>
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
                <form id="form_modal" novalidate="novalidate" onsubmit="return false">
                    <div class="modal-header">
                        <h4 class="modal-title" id="defaultModalLabel">Tambah Pelanggan</h4>
                    </div>
                    <div class="modal-body">
                        <label class="form-label">Jenis</label>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select id="id_jenis" class="form-control show-tick" data-show-subtext="true">
                                    @foreach($jenislaundry as $item)
                                    <option value="{{$item->id_jenis}}" data-subtext="{{$item->harga}}/{{$item->satuan}}">{{$item->jenis}}</option>
                                    @endforeach
                                </select>
                            </div>
                                    <div class="help-info">Min. 3, Max. 30 Karakter</div>
                        </div>
                        <label class="form-label">Jumlah</label>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="number" class="form-control" id="jumlah" maxlength="15" minlength="6" required>
                            </div>
                            <div class="help-info">Min 1</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect" id="btn_simpan" value="simpan">Simpan</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Tutup</button>
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

        var dataCucian = $('#dataCucian').DataTable({
            processing: true,
            serverSide: true,
            searching : false,
            ordering : false,
            paging : false,
            ajax: {
                url: '{{ url("dataTransaksiTmp") }}'
            },
            columns: [
            {data: 'jenis'},
            {data: 'jumlah'},
            {data: 'total'},
            {data: 'action'},
            ],
            footerCallback: function ( row, data, start, end, display ) {
            var api = this.api();
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
 
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
                         
            };

            // Total over all pages
 
                if (api.column(2).data().length){
                var total = api
                .column( 2 )
                .data()
                .reduce( function (a, b) {
                return intVal(a) + intVal(b);
                } ) }
                else{ total = 0};
                 
            // Update footer
            $( api.column(2).footer() ).html(
                'Rp'+total
            );
        }
        });


         //Menampilkan modal tambah
        $('#btn_modal').click(function(){
            $('#btn_simpan').val("simpan");
            $('#id_jenis').prop('disabled', false);
            $("#id_jenis").selectpicker('refresh');
            $('#form_modal').trigger("reset");
            $('#defaultModal').modal('show');
        });


        //Simpan atau Ubah Data
        $("#btn_simpan").click(function (e) {
            e.preventDefault();     

            var formData = {
                tm_nota : $('#tm_nota').val(),
                id_jenis : $('#id_jenis').val(),
                jumlah : $('#jumlah').val(),
            }

            var state = $('#btn_simpan').val();
            var type = "POST"; //membuat data baru
            var my_url = "{{url('dataCucian')}}";
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
                    dataCucian.ajax.reload(null,false);
                    $('#form_modal').trigger("reset");
                    $('#defaultModal').modal('hide');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

        //Munculkan modal untuk edit
        $(document).on('click','#edit_modal', function(){
            task_id = $(this).val();
            $.get('{{ url("dataCucian") }}'+ '/' + task_id, function (data) {
                //success data
                console.log(data);   
                $("#id_jenis").selectpicker('val', data.id_jenis);
                $('#id_jenis').prop('disabled', true);   
                $("#id_jenis").selectpicker('refresh');
                $('#jumlah').val(data.jumlah);
                $('#btn_simpan').val("Ubah");
            }); 
                $('#defaultModal').modal('show');
        });

        //Hapus
        $(document).on('click','#hapus_cucian', function(){
            task_id = $(this).val();
            $.get('{{ url("hapusCucian") }}'+ '/' + task_id, function (data) {
                dataCucian.ajax.reload(null,false);
            }); 
        });

        //Simpan semua data
        $("#btn_simpandata").click(function (e) {
            e.preventDefault();     
            var formData = {
                tm_nota : $('#tm_nota').val(),
                id_user : $('#id_user').val(),
                id_pelanggan : $('#id_pelanggan').val(),
            }
            console.log(formData);
            $.ajax({
                type: "POST",
                url: "{{url('simpanTransaksi')}}",
                data: formData,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    dataCucian.ajax.reload(null,false);
                    showNotification("bg-cyan", "Sukses", "bottom", "center", "animated zoomIn", "animated zoomOut");
                    window.location = '{{ url("/")}}' ;
                },
                error: function (data) {
                    console.log('Error:', data);
                    showNotification("bg-red", "Gagal: Tidak Ada Transaksi", "bottom", "center", "animated zoomIn", "animated zoomOut");
                }
            });
        });


    });

    </script>
@endpush