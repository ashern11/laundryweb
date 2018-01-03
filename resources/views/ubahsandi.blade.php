@extends('templates.index')
@section('content')
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">face</i> PROFILE
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#settings_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">settings</i> Ubah Password
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profile_with_icon_title">
                                    <form novalidate="novalidate">
                                            <label class="form-label">Nama Pengguna/Username</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="jumlah" maxlength="15" minlength="6" value="{{ Auth::user()->nama_pengguna }}" disabled>
                                                </div>
                                            </div>
                                            <label class="form-label">Nama Lengkap</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="jumlah" maxlength="15" minlength="6" value="{{ Auth::user()->nama_lengkap }}" disabled>
                                                </div>
                                            </div>
                                            <label class="form-label">Email</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="jumlah" maxlength="15" minlength="6" value="{{ Auth::user()->email }}" disabled>
                                                </div>
                                            </div>
                                            <label class="form-label">Dibuat</label>
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" class="form-control" id="jumlah" maxlength="15" minlength="6" value="{{ Auth::user()->created_at }}" disabled>
                                                </div>
                                            </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="settings_with_icon_title">
                                <form id="form_modal" novalidate="novalidate">
                                    <label class="form-label">Password lama</label>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="Passwordlama" maxlength="15" minlength="6" required>
                                        </div>
                                    </div>
                                    <label class="form-label">Password baru</label>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="password" class="form-control" id="Passwordbaru" maxlength="15" minlength="6" required>
                                        </div>
                                    </div>
                                    <label class="form-label">Konfirmasi Password Baru</label>
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="password" class="form-control" id="confim_Passwordbaru" maxlength="15" minlength="6" required>
                                            </div>
                                        </div>
                                    <button type="button" class="btn btn-primary waves-effect" id="btn_simpan" value="simpan">Simpan</button>
                                </form>
                                </div>
                            </div>
                        </div>
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

        //Simpan atau Ubah Data
        $("#btn_simpan").click(function (e) {
            e.preventDefault();     

            var formData = {
                Passwordlama : $('#Passwordlama').val(),
                Passwordbaru : $('#Passwordbaru').val(),
            }

            console.log(formData);
            $.ajax({
                type: "POST",
                url: "{{url('UbahSandi')}}",
                data: formData,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data);
                    $('#form_modal').trigger("reset");
                    showNotification(data['warna'], data['pesan'], "bottom", "center", "animated zoomIn", "animated zoomOut");
                },
                error: function (data) {
                    console.log('Error:', data);
                    showNotification("bg-red", "Gagal : Kontak Admin", "bottom", "center", "animated zoomIn", "animated zoomOut");
                }
            });
        });

    });

</script>
@endpush