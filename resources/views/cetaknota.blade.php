@extends('templates.index')
@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <h2>Cetak Nota</h2>
            </div>

            <div class="row clearfix" id="printpage">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Cetak Nota</h2>
                            <ul class="header-dropdown m-r-0">
                                <a href="#" id="alert">
                                    <button type="button" class="btn bg-red waves-effect waves-float">
                                            <i class="material-icons">print</i>
                                            <span>Print</span>
                                    </button>
                                </a>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="Nota">Nota</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-5">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="tm_nota" class="form-control" type="text" value="{{ $nota }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                    <button type="button" class="btn bg-blue waves-effect waves-float" id="refresh_nota">
                                            <i class="material-icons">refresh</i>
                                    </button>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="Kasir">Kasir</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="id_user" class="form-control" type="text" value="{{ $nama_lengkap }}" disabled>
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
                                        <div class="form-line">
                                            <input id="tanggal" class="form-control" type="text" value="{{ $nama }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="Pelanggan">Total Semua</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input id="tanggal" class="form-control" type="text" value="{{ $total }}" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-lg-1 col-md-1 col-sm-4 col-xs-1"></div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-10">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            
                                                <table class="table table-bordered table-striped table-hover dataTable" id="dataCucian">
                                                    <thead>
                                                        <tr>
                                                            <th>Jenis</th>
                                                            <th>Jumlah</th>
                                                            <th>Satuan</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Jenis</th>
                                                            <th>Jumlah</th>
                                                            <th>Satuan</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-1 col-sm-4 col-xs-1"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
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

        var id_nota = $('#tm_nota').val();
        var dataTransaksi = $('#dataCucian').DataTable({
            bAutoWidth : false,
            responsive: true,
            processing: true,
            serverSide: true,
            searching : false,
            paging : false,
            bInfo : false,
            ajax: {
                url: '{{ url("dataCucianNota") }}'+'/'+id_nota
            },
            columns: [
                {data: 'jenis'},
                {data: 'jumlah'},
                {data: 'satuan'},
                {data: 'total'},
            ], 
        });


    $('#refresh_nota').click(function(){
        window.location = '{{ url("CetakNota")}}'+'/'+ $('#tm_nota').val(); ;
    });

    });
    
    $("#alert").click(function(){
        $("#alert").hide();
        $('#refresh_nota').hide();
        var printContents = $('#printpage').html();
        var allLinks = $('head').clone().find('script').remove().end().html();
        var popupWin = window.open('', '_blank', 'width=500,height=500');
        popupWin.document.open();
        popupWin.document.write('<html><head>'+ allLinks + '</head><body onload="window.print()">' + printContents + '</body></html>');    
        popupWin.document.close();
        $("#alert").show();
        $('#refresh_nota').show();
    });

</script>
@endpush