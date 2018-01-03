@extends('templates.index')
@section('content')
       <div class="container-fluid">
            <div class="block-header">
                <h2>LAPORAN</h2>
            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Data Belum Lunas</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos" id="dataBelumLunas">
                                    <thead>
                                        <th>Tanggal</th>
                                        <th>Nota</th>
                                        <th>Kasir</th>
                                        <th>Pelanggan</th>
                                        <th>Total Bayar</th>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>


            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Data Lunas</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable" id="dataLunas">
                                    <thead>
                                		<tr>
	                                        <th>Tanggal</th>
	                                        <th>Nota</th>
	                                        <th>Kasir</th>
	                                        <th>Pelanggan</th>
	                                        <th>Total Bayar</th>
	                                	</tr>
                                    </thead>
                                    <tfoot>
                                		<tr>
	                                        <th>Tanggal</th>
	                                        <th>Nota</th>
	                                        <th>Kasir</th>
	                                        <th>Pelanggan</th>
	                                        <th>Total Bayar</th>
	                                	</tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
@endsection

@push('js')
<script src="plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
<script src="plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            })

        var dataBelumLunas = $('#dataBelumLunas').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy',
                {
                    extend: 'csvHtml5',
                    title: 'Data Belum Lunas'
                },
                {
                    extend: 'excelHtml5',
                    title: 'Data Belum Lunas'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Data Belum Lunas'
                },
                {
                    extend: 'print',
                    title: 'Data Belum Lunas'
                },
	        ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("laporanbelumlunas") }}'
            },
            columns: [
            {data: 'created_at'},
            {data: 'tm_nota'},
            {data: 'nama_lengkap'},
            {data: 'nama', orderable: false, searchable: false},
            {data: 'tm_total', orderable: false, searchable: false},
        ],
        });

        var dataLunas = $('#dataLunas').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy',
                {
                    extend: 'csvHtml5',
                    title: 'Data Lunas'
                },
                {
                    extend: 'excelHtml5',
                    title: 'Data Lunas'
                },
                {
                    extend: 'pdfHtml5',
                    title: 'Data Lunas'
                },
                {
                    extend: 'print',
                    title: 'Data Lunas'
                },
	        ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url("laporanlunas") }}'
            },
            columns: [
            {data: 'created_at'},
            {data: 'tm_nota'},
            {data: 'nama_lengkap'},
            {data: 'nama', orderable: false, searchable: false},
            {data: 'tm_total', orderable: false, searchable: false},
        	],
        });


      });
	</script>
@endpush