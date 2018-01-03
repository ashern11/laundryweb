<div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="{{ Request::is('/') || Request::is('UbahSandi') || Request::is('Transaksi') ? 'active' : '' }}">
                        <a href="{{url('/')}}">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('Jenislaundry') ? 'active' : '' }}">
                        <a href="{{url('Jenislaundry')}}">
                            <i class="material-icons">list</i>
                            <span>Jenis Laundry</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('Pelanggan') ? 'active' : '' }}">
                        <a href="{{url('Pelanggan')}}">
                            <i class="material-icons">group</i>
                            <span>Pelanggan</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('Laporan') ? 'active' : '' }}">
                        <a href="{{url('Laporan')}}">
                            <i class="material-icons">assignment</i>
                            <span>Laporan</span>
                        </a>
                    </li>
                    <li class="{{ Request::is('CetakNota/*') ? 'active' : '' }}">
                        <a href="{{url('CetakNota/0')}}">
                            <i class="material-icons">print</i>
                            <span>Cetak</span>
                        </a>
                    </li>
                </ul>
            </div>