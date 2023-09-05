<!doctype html>
<html lang="en">


<!-- Mirrored from 103.146.30.155:82/recruit/recruitCrew by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Jun 2023 09:01:01 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon"
        href="{{ asset('/') }}template_recruitment_crew/103.146.30.155:82/assets/img/favicons/favicon.ico">

    <title>Registrasi Calon Crew PT. Patria Maritime Lines</title>


    <!-- Bootstrap core CSS
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">     <link href="pricing.css" rel="stylesheet">-->
    <link rel="stylesheet"
        href="{{ asset('/') }}template_recruitment_crew/cdn.jsdelivr.net/npm/bootstrap%404.0.0/dist/css/bootstrap.min.css" />
    <!-- Custom styles for this template
    <link href="pricing.css" rel="stylesheet"> -->
    <!-- Bootstrap table-->
    <link rel="stylesheet"
        href="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/bootstraptable/bootstrap-table.css">

    <!-- Select2 CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('/') }}assets/css/select2.min.css"> --}}

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/adminlte320/plugins/fontawesome-free/css/all.min.css">

    <!-- Bootstrap Core JavaScript -->

    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/adminlte320/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <style>
        table,
        th {
            /* text-align: center; */
        }

        tr {
            /* text-align: center; */
        }

        ,
        ,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            /* text-align: center; */
        }

        body {
            background-image: linear-gradient(180deg, var(--bs-body-secondary-bg), var(--bs-body-bg) 100px, var(--bs-body-bg));
            background-color: #069;
        }

        .container {
            max-width: 960px;
        }

        .pricing-header {
            max-width: 700px;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .ban {
            background-image: url(../assets/img/ban.png);
            background-repeat: repeat-x;
        }

        .putih {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container py-3 putih">
        <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom ban">
            <h5 class="my-0 mr-md-auto font-weight-normal"><img alt="Brand"
                    src="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/img/LOGO_PML2.png"
                    height="80px">
                <!-- <span style="font-family:sans-serif;font-size:28px;font-weight:bold;">Patria Maritime Lines</span> -->
            </h5>
            <nav class="my-2 my-md-0 mr-md-3">
                <h1 class="display-4">Data Calon Crew</h1>
            </nav>

        </div>




        <div class="card mb-4 box-shadow">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Perhatian</h4>
            </div>
            <div class="card-body">
                <p class="lead">PENERIMAAN CREW DI PT. PATRIA MARITIME LINES TIDAK DIKENAKAN BIAYA (
                    <strong>GRATIS</strong> ), untuk pengaduan dapat menghubungi email berikut crewing@pml.co.id.
                </p>

            </div>
        </div>
        <form id="fcrewapp" action="http://103.146.30.155:82/recruit/submitapplycrew" method="post"
            enctype="multipart/form-data">
            <div class="card mb-4 box-shadow">

                <div class="card-body">

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6"><label for="cmbijasah">Pendidikan terakhir*</label>
                                <select name="cmbijasah" id="cmbijasah" class="form-control">
                                    <option value="ANT-I">ANT I</option>
                                    <option value="ANT-II">ANT II</option>
                                    <option value="ANT-IIIM">ANT III MANAJEMEN</option>
                                    <option value="ANT-IIIO">ANT III OPERASIONAL</option>
                                    <option value="ANT-IVM">ANT IV MANAJEMEN</option>
                                    <option value="ANT-IVO">ANT IV OPERASIONAL</option>
                                    <option value="ANT-V">ANT V MANAJEMEN</option>
                                    <option value="ANT-VO">ANT V OPERASIONAL</option>
                                    <option value="ANT-DA">ANT D ABLE (RASD)</option>
                                    <option value="ANT-DR">ANT D RATING (RFPNW)</option>
                                    <option value="ATT-I">ATT I</option>
                                    <option value="ATT-II">ATT II</option>
                                    <option value="ATT-IIIM">ATT III MANAJEMEN</option>
                                    <option value="ATT-IIIO">ATT III OPERASIONAL</option>
                                    <option value="ATT-IVM">ATT IV MANAJEMEN</option>
                                    <option value="ATT-IVO">ATT IV OPERASIONAL</option>
                                    <option value="ATT-V">ATT V MANAJEMEN</option>
                                    <option value="ATT-VO">ATT V OPERASIONAL</option>
                                    <option value="ATT-DA">ATT D ABLE (RASE)</option>
                                    <option value="ATT-DR">ATT D RATING (RFPWER)</option>
                                    <option value="BST">BST</option>
                                </select>
                            </div>
                            <div class="col-sm-6"><label for="txtlokasi">Lokasi Registrasi*</label>
                                <select name="txtlokasi" id="txtlokasi" class="form-control">
                                    <option value="KALIMANTAN SELATAN">KALIMANTAN SELATAN</option>
                                    <option value="DKI JAKARTA">DKI JAKARTA</option>
                                    <!-- <option value="JAWA BARAT">JAWA BARAT</option>
                                    <option value="BANTEN">BANTEN</option>
                                    <option value="KALIMANTAN TENGAH">KALIMANTAN TENGAH</option>
                                    <option value="KALIMANTAN TIMUR">KALIMANTAN TIMUR</option>
                                    <option value="JAWA TIMUR">JAWA TIMUR</option>
                                    <option value="JAWA TENGAH">JAWA TENGAH</option>
                                    <option value="SUMATERA SELATAN">SUMATERA SELATAN</option>
                                    <option value="KALIMANTAN BARAT">KALIMANTAN BARAT</option>
                                    <option value="KALIMANTAN UTARA">KALIMANTAN UTARA</option>
                                    <option value="SULAWESI UTARA">SULAWESI UTARA</option>
                                    <option value="SULAWESI TENGAH">SULAWESI TENGAH</option>
                                    <option value="SULAWESI SELATAN">SULAWESI SELATAN</option>
                                    <option value="SULAWESI TENGGARA">SULAWESI TENGGARA</option>
                                    <option value="SULAWESI BARAT">SULAWESI BARAT</option>
                                    <option value="DI YOGYAKARTA">DI YOGYAKARTA</option>
                                    <option value="ACEH">ACEH</option>
                                    <option value="SUMATERA UTARA">SUMATERA UTARA</option>
                                    <option value="SUMATERA BARAT">SUMATERA BARAT</option>
                                    <option value="RIAU">RIAU</option>
                                    <option value="JAMBI">JAMBI</option>
                                    <option value="BENGKULU">BENGKULU</option>
                                    <option value="LAMPUNG">LAMPUNG</option>
                                    <option value="KEPULAUAN BANGKA BELITUNG">KEPULAUAN BANGKA BELITUNG</option>
                                    <option value="KEPULAUAN RIAU">KEPULAUAN RIAU</option>
                                    <option value="BALI">BALI</option>
                                    <option value="NUSA TENGGARA BARAT">NUSA TENGGARA BARAT</option>
                                    <option value="NUSA TENGGARA TIMUR">NUSA TENGGARA TIMUR</option>
                                    <option value="GORONTALO">GORONTALO</option>
                                    <option value="MALUKU">MALUKU</option>
                                    <option value="MALUKU UTARA">MALUKU UTARA</option>
                                    <option value="PAPUA">PAPUA</option>
                                    <option value="PAPUA BARAT">PAPUA BARAT</option> -->

                                </select>
                                <!--<input name="txtlokasi" type="text" id="txtlokasi" size="50" class="form-control"/>-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="txtnama">Nama Lengkap *</label><input name="txtnama"
                                    type="text" id="txtnama" size="50" class="form-control" />
                                </select></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cmbJabatan">Jabatan/Posisi yang di lamar</label>
                                *
                                <select name="cmbJabatan" id="cmbJabatan" class="form-control">
                                </select>
                                <input name="txtminexp" type="hidden" id="txtminexp" />
                                <div id="lblminexp" name="lblminexp" style="color:#F66"></div>
                            </div>
                            <div class="col-sm-6">
                                <label for="txtnodoccoc">No Ijasah*</label>
                                <input name="txtnodoccoc" type="text" id="txtnodoccoc" class="form-control" />
                            </div>
                            <!--<div class="col-sm-6"><label for="dttglissuedcoc">Endorsment Date</label>-->
                            <!--<input type="date" name="dttglissuedcoc" id="dttglissuedcoc" class="form-control"/>
                                <div name="dttglissuedcoc" id="dttglissuedcoc" ></div> </div> -->

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="txtnodoccoe">Nomor Endors (untuk Perwira)</label>
                                <input name="txtnodoccoe" type="text" id="txtnodoccoe" class="form-control" />
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="dttglendors">Masa berlaku Endors (untuk Perwira)</label>

                                    <!--<input type="date" name="dttglendors" id="dttglendors" class="form-control"/>-->
                                    <!--<div name="dttglendors" id="dttglendors"></div>-->
                                    <div class="input-group date" id="dttglendors" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#dttglendors">
                                        <div class="input-group-append" data-target="#dttglendors"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="txttmplhr">Tempat Lahir*</label><input type="text"
                                    name="txttmplhr" id="txttmplhr" class="form-control" /></div>
                            <div class="col-sm-6">
                                <label for="dttgllhr">Tanggal Lahir*</label>
                                <!--<input type="date" name="dttgllhr" id="dttgllhr" class="form-control"/>-->
                                <!--<div name="dttgllhr" id="dttgllhr"></div>-->
                                <div class="input-group date" id="dttgllhr" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#dttgllhr">
                                    <div class="input-group-append" data-target="#dttgllhr"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="cmbgender">Gender</label><select name="cmbgender"
                                    id="cmbgender" class="form-control">
                                    <option value="-">-</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select></div>
                            <div class="col-sm-6"><label for="cmbagama">Agama</label><select name="cmbagama"
                                    id="cmbagama" class="form-control">
                                    <option value="-">-</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Katolik">Katolik</option>
                                    <option value="Hindu">Hindu</option>
                                    <option value="Budha">Budha</option>
                                    <option value="Kong Hu Cu">Kong Hu Cu</option>
                                    <option value="Lain">Lain</option>
                                </select></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="cmbstatus">Status</label><select name="cmbstatus"
                                    id="cmbstatus" class="form-control">
                                    {{-- <option value="-">-</option> --}}
                                    <option value="TK0">BELUM MENIKAH</option>
                                    <option value="K0">MENIKAH ANAK 0</option>
                                    <option value="K1">MENIKAH ANAK 1</option>
                                    <option value="K2">MENIKAH ANAK 2</option>
                                    <option value="K3">MENIKAH ANAK 3</option>
                                    <option value="TK1">LAJANG ANAK 1</option>
                                    <option value="TK2">LAJANG ANAK 2</option>
                                    <option value="TK3">LAJANG ANAK 3</option>
                                    <option value="CERAI">CERAI</option>
                                </select></div>
                        </div><br>
                        {{-- KELUARGA --}}
                        <div class="card mb-4 box-shadow">
                            <div class="card-header">Riwayat Pendidikan</div>
                            <!-- /.panel-heading -->
                            <div class="card-body">
                                {{-- <h2>Pendidikan Formal</h2> --}}
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th style="text-align: center">NAMA</th>
                                            <th style="text-align: center">ALAMAT LENGKAP</th>
                                            <th style="text-align: center">NO HP/TELP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr id="choose_ayahkandung">
                                            <td><b>Ayah Kandung</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="choose_ibukandung">
                                            <td><b>Ibu Kandung</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="choose_pasangan">
                                            <td><b>Pasangan</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="choose_anak1">
                                            <td><b>Anak 1</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="choose_anak2">
                                            <td><b>Anak 2</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="choose_anak3">
                                            <td><b>Anak 3</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="choose_anak4">
                                            <td><b>Anak 4</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                        <tr id="choose_anak5">
                                            <td><b>Anak 5</b></td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-sm-12"><input type="text" name="txtpayrek"
                                                        id="txtpayrek" class="form-control" />
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>

                                </table><br>
                                <div class="row" align="center">
                                    <div class="col-sm-12" align="right">Klik Tombol untuk simpan data -&gt;
                                        <input id="btnsimpanriwayatpendidikan" name="btnsimpanriwayatpendidikan"
                                            type="button" value="Simpan" class="btn btn-primary" /><br /> Ket :
                                        Untuk Tambah data lagi, harap
                                        isi di atas
                                        kembali
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- END KELUARGA --}}

                        <div class="row">
                            <div class="col-sm-6"><label for="txtktp">No. KTP*</label><input type="text"
                                    name="txtktp" id="txtktp" class="form-control" /></div>
                            <div class="col-sm-6"><label for="txttinggibdn">Tinggi Badan (cm)</label><input
                                    type="number" name="txttinggibdn" id="txttinggibdn" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="txtnpwp">No. NPWP</label><input type="text"
                                    name="txtnpwp" id="txtnpwp" class="form-control" /></div>
                            <div class="col-sm-6"><label for="txtbrtbdn">Berat Badan (kg)</label><input
                                    type="number" name="txtbrtbdn" id="txtbrtbdn" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="cmbgoldarah">Gol. Darah</label><select
                                    name="cmbgoldarah" id="cmbgoldarah" class="form-control">
                                    <option value="-">-</option>
                                    <option value="0">0</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="AB">AB</option>
                                </select></div>
                            <div class="col-sm-6"><label for="txttelp">No. HP / Telp*</label><input type="text"
                                    name="txttelp" id="txttelp" class="form-control" /></div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="cmbwp">Wearpack</label><select name="cmbwp"
                                    id="cmbwp" class="form-control">
                                    <option value="-">-</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                    <option value="XXXL">XXXL</option>
                                    <option value="XXXXL">XXXXL</option>

                                </select></div>
                            <div class="col-sm-6"><label for="cmbsepatu">Sepatu Safety</label><select
                                    name="cmbsepatu" id="cmbsepatu" class="form-control">
                                    <option value="-">-</option>
                                    <option value="38">38</option>
                                    <option value="39">39</option>
                                    <option value="40">40</option>
                                    <option value="41">41</option>
                                    <option value="42">42</option>
                                    <option value="43">43</option>
                                    <option value="44">44</option>
                                    <option value="45">45</option>
                                </select></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="alamat_ktp">Alamat Sesuai KTP</label>
                                <textarea name="alamat_ktp" cols="50" maxlength="250" id="alamat_ktp" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="alamat_domisili">Alamat Domisili</label>
                                <textarea name="alamat_domisili" cols="50" maxlength="250" id="alamat_domisili" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="txtorg">Organisasi pelaut yang diikuti</label>
                                <textarea name="txtorg" cols="50" maxlength="250" id="txtorg" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12"><label for="email">Email *</label><input type="email"
                                    name="txtemail" id="txtemail" class="form-control"
                                    placeholder="jane.doe@example.com">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- /.panel-Ijasah -->
            {{-- <div class="card mb-4 box-shadow">
                <div class="card-header">Keluarga yang bisa dihubungi</div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4"><label for="txtkelnama">Nama *</label><input type="text"
                                    name="txtkelnama" id="txtkelnama" class="form-control" /></div>
                            <div class="col-sm-4"><label for="txtkeltelp">No. HP/Telp *</label><input type="text"
                                    name="txtkeltelp" id="txtkeltelp" class="form-control" /></div>
                            <div class="col-sm-4"><label for="txtkelhubungan">Hubungan *</label><input type="text"
                                    name="txtkelhubungan" id="txtkelhubungan" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="txtkelalamat">Alamat*</label><input type="text"
                                    name="txtkelalamat" id="txtkelalamat" class="form-control" /></div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- /.panel-Ijasah -->
            <div class="card mb-4 box-shadow">
                <div class="card-header">Rekening Bank</div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6"><label for="txtpaybank">Bank *</label><input type="text"
                                    name="txtpaybank" id="txtpaybank" class="form-control" /></div>
                            <div class="col-sm-6"><label for="txtpaycabang">Cabang *</label><input type="text"
                                    name="txtpaycabang" id="txtpaycabang" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="txtpayrek">No Rekening *</label><input type="text"
                                    name="txtpayrek" id="txtpayrek" class="form-control" /></div>
                            <div class="col-sm-6"><label for="txtpaynama">Atas Nama *</label><input type="text"
                                    name="txtpaynama" id="txtpaynama" class="form-control" /></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.panel-Ijasah -->

            {{-- Riwayat Pendidikan --}}
            <div class="card mb-4 box-shadow">
                <div class="card-header">Riwayat Pendidikan</div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    {{-- <h2>Pendidikan Formal</h2> --}}
                    <table style="width: 100%;">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="text-align: center">NAMA SEKOLAH</th>
                                <th style="text-align: center">JURUSAN</th>
                                <th style="text-align: center">TEMPAT</th>
                                <th style="text-align: center">TAHUN LULUS</th>
                                <th style="text-align: center">KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>SLTP</b></td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>SLTA</b></td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>AKADEMI</b></td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>UNIV/INST</b></td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>MASTER</b></td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                                <td>
                                    <div class="col-sm-12"><input type="text" name="txtpayrek" id="txtpayrek"
                                            class="form-control" />
                                    </div>
                                </td>
                            </tr>
                        </tbody>

                    </table><br>
                    <div class="row" align="center">
                        <div class="col-sm-12" align="right">Klik Tombol untuk simpan data -&gt;
                            <input id="btnsimpanriwayatpendidikan" name="btnsimpanriwayatpendidikan" type="button"
                                value="Simpan" class="btn btn-primary" /><br /> Ket : Untuk Tambah data lagi, harap
                            isi di atas
                            kembali
                        </div>
                    </div>
                </div>
            </div>
            {{-- END Riwayat Pendidikan --}}

            <div class="card mb-4 box-shadow">
                <div class="card-header">Sertifikat COP yang dimiliki<input name="txtsescopid" type="hidden"
                        id="txtsescopid" class="form-control" /></div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">Sertifikat COP
                                </select>
                                <select name="cmbtypedocscop" id="cmbtypedocscop" style="width:150px"
                                    class="form-control">
                                    <option value="402880d13c1e7e7f013c1e7fa86c0001">BST</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0002">SCRB</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0003">AFF</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0004">MEFA</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0005">MC </option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0006">RADAR SIMULATOR</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0007">ARPA SIMULATOR</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0009">GMDSS</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0010">ORU</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0011">ERM</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0012">BRM</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0013">SSO</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0014">SAT</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0015">ECDIS</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0016">SDSD</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0017">ISM CODE</option>
                                    <option value="402880d13c1e7e7f013c1e7fa86c0018">MCU Standard DEPERLA</option>
                                    {{-- <option value="402880d13c1e7e7f013c1e7fa86c0019">OTHERS</option> --}}
                                </select>
                            </div>
                            <div class="col-sm-6"><label for="dttglissuedcop">Issued Date</label>
                                <!--<input type="date" name="dttglissuedcop" id="dttglissuedcop" class="form-control"/>-->
                                <!--<div name="dttglissuedcop" id="dttglissuedcop"></div>-->
                                <div class="input-group date" id="dttglissuedcop" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#dttglissuedcop">
                                    <div class="input-group-append" data-target="#dttglissuedcop"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="txtnodoccop">No Sertifikat *</label><input
                                    name="txtnodoccop" type="text" id="txtnodoccop" class="form-control" /></div>

                            <div class="col-sm-6"><label for="dttglexpcop">Masa Berlaku </label>

                                <!--<input type="date" name="dttglexpcop" id="dttglexpcop" class="form-control"/>-->
                                <!--<div name="dttglexpcop" id="dttglexpcop"></div>-->
                                <div class="input-group date" id="dttglexpcop" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#dttglexpcop">
                                    <div class="input-group-append" data-target="#dttglexpcop"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="txtissuedcop">Issued Place</label><input
                                    name="txtissuedcop" type="text" id="txtissuedcop" class="form-control" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="txtcertificate_others">Others</label><input
                                    name="txtcertificate_others" type="text" id="txtcertificate_others"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="row" align="center">
                            <div class="col-sm-12" align="right">Klik Tombol untuk simpan data -&gt;
                                <input id="btnsimpancop" name="btnsimpancop" type="button" value="Simpan"
                                    class="btn btn-primary" /><br /> Ket : Untuk Tambah data lagi, harap isi di atas
                                kembali
                            </div>
                        </div>
                    </div>

                    <div class="dataTable_wrapper">
                        <table id="table-cop" data-toggle="table"
                            data-url="http://103.146.30.155:82/recruit/sesscoplist" data-height="299"
                            data-search="false" data-pagination="true" data-show-columns="true">
                            <thead>
                                <tr>
                                    <th data-field="sescopid" data-visible="false"></th>
                                    <th data-field="sesTypedocscop" data-visible="false"></th>
                                    <th data-field="sesTypedocscoptxt" data-sortable="true">Seritifikat</th>
                                    <th data-field="sesNodoccop" data-sortable="true">Nomor</th>
                                    <th data-field="sesTglissuedcop" data-sortable="true">Issued Date</th>
                                    <th data-field="sesTglexpcop" data-sortable="true">Masa Berlaku</th>
                                    <th data-field="sesIssuedcop" data-sortable="true">Issued Place</th>
                                    <th data-field="operate" data-formatter="operateFormatter"
                                        data-events="operateEvents">opsi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.panel-Pengalaman -->
            <div class="card mb-4 box-shadow">
                <div class="card-header">Pengalaman Kerja<input name="txtsesworkexpid" type="hidden"
                        id="txtsesworkexpid" class="form-control" /></div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12"><label for="txtkapalworkexp">Kapal</label><input type="text"
                                    name="txtkapalworkexp" id="txtkapalworkexp" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="cmbJabatanworkexp">Jabatan</label>
                                </select><select name="cmbJabatanworkexp" id="cmbJabatanworkexp" style="width:150px"
                                    class="form-control">
                                    <option value="CADET">CADET</option>
                                    <option value="CK">JURU MASAK</option>
                                    <option value="OIL">JURU MINYAK</option>
                                    <option value="JM">JURUMUDI</option>
                                    <option value="KKM">KKM</option>
                                    <option value="MAS1">MASINIS I</option>
                                    <option value="MAS2">MASINIS II</option>
                                    <option value="MAS3">MASINIS III</option>
                                    <option value="MUL1">MUALIM I</option>
                                    <option value="MUL2">MUALIM II</option>
                                    <option value="NAKH">NAKHODA</option>
                                </select></div>

                            <div class="col-sm-6"><label for="txtpemilikworkexp">Pemilik/Perusahaan</label><input
                                    type="text" name="txtpemilikworkexp" id="txtpemilikworkexp"
                                    class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="txtmesinworkexp">Mesin Kapal</label><input
                                    name="txtmesinworkexp" type="text" id="txtmesinworkexp"
                                    class="form-control" /></div>
                            <div class="col-sm-3"><label for="txtgrtworkexp">GRT</label><input name="txtgrtworkexp"
                                    type="text" id="txtgrtworkexp" class="form-control" /></div>
                            <div class="col-sm-3"><label for="txthpworkexp">HP</label><input name="txthpworkexp"
                                    type="text" id="txthpworkexp" class="form-control" /></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="dttgldrworkexp">Dari</label>
                                <!--<input type="date" name="dttgldrworkexp" id="dttgldrworkexp" class="form-control"/>-->
                                <!--<div name="dttgldrworkexp" id="dttgldrworkexp"></div>-->
                                <div class="input-group date" id="dttgldrworkexp" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#dttgldrworkexp">
                                    <div class="input-group-append" data-target="#dttgldrworkexp"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6"><label for="dttglsmpworkexp">Sampai</label>
                                <!--<input type="date" name="dttglsmpworkexp" id="dttglsmpworkexp" class="form-control"/>-->
                                <!--<div name="dttglsmpworkexp" id="dttglsmpworkexp"></div>-->
                                <div class="input-group date" id="dttglsmpworkexp" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input"
                                        data-target="#dttglsmpworkexp">
                                    <div class="input-group-append" data-target="#dttglsmpworkexp"
                                        data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6"><label for="sbg_atasan">Sebagai Atasan</label><input
                                    name="sbg_atasan" type="text" id="sbg_atasan" class="form-control"
                                    placeholder="Nama atasan" /></div>
                            <div class="col-sm-6"><label for="sbg_bawahan">Sebagai Bawahan</label><input
                                    name="sbg_bawahan" type="text" id="sbg_bawahan" class="form-control"
                                    placeholder="Nama bawahan" /></div>
                            <div class="col-sm-12"><label for="salary">Salary</label><input name="salary"
                                    type="text" id="salary" class="form-control" placeholder="Rp. 00,-" />
                            </div>
                        </div>
                        <div class="row" align="center">
                            <div class="col-sm-12" align="right">Klik Tombol untuk simpan data -&gt;
                                <input id="btnsimpanworkexp" name="btnsimpanworkexp" type="button" value="Simpan"
                                    class="btn btn-primary" />
                                <br /> Ket : Untuk Tambah data lagi, harap isi di atas kembali
                            </div>
                        </div>
                    </div>

                    <div class="dataTable_wrapper">
                        <table id="table-workexp" data-toggle="table"
                            data-url="http://103.146.30.155:82/recruit/sessworkexplist" data-height="299"
                            data-search="false" data-pagination="true" data-show-columns="true">

                            <thead>
                                <tr>
                                    <th data-field="sesworkexpid" data-visible="false"></th>
                                    <th data-field="seskapalworkexp" data-sortable="true">Kapal</th>
                                    <th data-field="sesjabatanworkexp" data-visible="false"></th>
                                    <th data-field="sesjabatanworkexptxt" data-sortable="true">Jabatan</th>
                                    <th data-field="sespemilikworkexp" data-sortable="true">Pemilik/Perusahaan</th>
                                    <th data-field="sesgrtworkexp" data-sortable="true">GRT</th>
                                    <th data-field="seshpworkexp" data-sortable="true">HP</th>
                                    <th data-field="sestgldrworkexp" data-sortable="true">Dari</th>
                                    <th data-field="sestglsmpworkexp" data-sortable="true">Sampai</th>
                                    <th data-field="operate" data-formatter="operateFormatter2"
                                        data-events="operateEvents2">opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- /.panel-Minat Kerja -->
            <div class="card mb-4 box-shadow">
                <div class="card-header">Minat Kerja<input name="txtsesworkexpid" type="hidden"
                        id="txtsesworkexpid" class="form-control" /></div>
                <!-- /.panel-heading -->
                <div class="card-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6"><label for="cmbPosisitionworkApplied">Posisi yang di lamar</label>
                                <select name="cmbPosisitionworkApplied" id="cmbPosisitionworkApplied"
                                    class="form-control">
                                    <option value="MV">MOTHER VESSEL</option>
                                    <option value="TUGBARGE">TUG & BARGE</option>
                                </select>
                            </div>
                            <div class="col-sm-6"><label for="cmbJabatanwork">Jabatan yang di lamar</label>
                                <select name="cmbJabatanworkApplied" id="cmbJabatanworkApplied_tb"
                                    class="form-control choose_jbt_tb">
                                    <option value="NAKH">NAKHODA</option>
                                    <option value="MUL1">MUALIM I</option>
                                    <option value="MUL2">MUALIM II</option>
                                    <option value="KKM">KKM</option>
                                    <option value="MAS2">MASINIS II</option>
                                    <option value="MAS3">MASINIS III</option>
                                    <option value="JM">JURUMUDI</option>
                                    <option value="KOKI">KOKI</option>
                                </select>
                                <select name="cmbJabatanworkApplied" id="cmbJabatanworkApplied_mv"
                                    class="form-control choose_jbt_mv">
                                    <option value="NAKH">NAKHODA</option>
                                    <option value="MUL1">MUALIM I</option>
                                    <option value="MUL2">MUALIM II</option>
                                    <option value="MUL3">MUALIM III</option>
                                    <option value="KKM">KKM</option>
                                    <option value="MAS2">MASINIS II</option>
                                    <option value="MAS3">MASINIS III</option>
                                    <option value="MAS4">MASINIS IV</option>
                                    <option value="ELEC">ELECTRICIAN</option>
                                    <option value="BSN">BOSUN</option>
                                    <option value="MNDR">MANDOR</option>
                                    <option value="JM">JURUMUDI</option>
                                    <option value="KL1">KELASI I</option>
                                    <option value="KL2">KELASI II</option>
                                    <option value="OIL">JURU MINYAK</option>
                                    <option value="KOKI">KOKI</option>
                                    <option value="MB">MESS BOY</option>
                                    <option value="CD_DECK">CADET DECK</option>
                                    <option value="CD_MESIN">CADET MESIN</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12"><label for="alasan_melamar">Mengapa anda ingin bekerja di
                                    Perusahaan kami?</label>
                                <textarea name="alasan_melamar" cols="50" maxlength="250" id="alasan_melamar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12"><label for="alasan_melamar">Berapa gaji yang anda
                                    harapkan?</label>
                                <textarea name="alasan_melamar" cols="50" maxlength="250" id="alasan_melamar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12"><label for="alasan_melamar">Apakah ada fasilitas tambahan yang
                                    anda
                                    inginkan?</label>
                                <textarea name="alasan_melamar" cols="50" maxlength="250" id="alasan_melamar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12"><label for="alasan_melamar">Kapan anda dapat mulai
                                    bekerja?</label>
                                <textarea name="alasan_melamar" cols="50" maxlength="250" id="alasan_melamar" class="form-control"></textarea>
                            </div>
                            <div class="col-sm-12"><label for="alasan_melamar">Adakah kenalan di perusahaan
                                    kami?</label>
                                </select><select name="cmbreferensi" id="cmbreferensi" style="width:150px"
                                    class="form-control">
                                    <option value="YA">YA</option>
                                    <option value="TIDAK">TIDAK</option>
                                </select><br>
                                <textarea name="nm_ref" cols="50" maxlength="250" id="nm_ref" class="form-control"
                                    placeholder="Nama Kenalan"></textarea>
                            </div>
                        </div>
                        <div class="row" align="center">
                            <div class="col-sm-12" align="right">Klik Tombol untuk simpan data -&gt;
                                <input id="btnsimpanworkexp" name="btnsimpanworkexp" type="button"
                                    value="Simpan" class="btn btn-primary" />
                                <br /> Ket : Untuk Tambah data lagi, harap isi di atas kembali
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- /.panel-upload cv -->
            <div class="form-group">
                <label for="uploadFileCv">File CV *</label>
                <input id="uploadFileCv" type="file" name="uploadFileCv" class="form-control" />
            </div>
            {{-- <div class="row">
                <div class="col-sm-12"><label for="txtreferensi">Referensi</label><input name="txtreferensi"
                        type="text" class="form-control" id="txtreferensi" maxlength="10" />
                    (Nama person max:10 karakter)</div>
            </div> --}}
            <br />
            <!-- /.panel-submit -->
            <div class="form-group" align="center">
                <p>Dengan mengisi formulir ini,saya menyatakan bahwa data yang saya berikan adalah benar dan dapat
                    dipertanggungjawabkan.</p>
                <label class="check"><input type="checkbox" class="icheckbox" name="chkok"
                        id="chkok" />
                    Setuju</label><br />
                <br />
                <input id="btnsimpan" name="btnsimpan" type="button" value="Submit"
                    class="btn btn-primary" />
                <input id="btnbatal" name="btnbatal" type="button" value="Batal" class="btn btn-primary" />

            </div>


        </form>






        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">

                    <small class="d-block mb-3 text-muted">&copy; PT. Patria Maritime Lines 2023</small>
                </div>

            </div>
        </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster <script src="../../assets/js/vendor/popper.min.js"></script>-->
    <script src="{{ asset('/') }}template_recruitment_crew/code.jquery.com/jquery-3.2.1.js"></script>

    <script>
        window.jQuery || document.write(
            '<script src="../template_recruitment_crew/103.146.30.155_82/assets/js/vendor/jquery-slim.min.html"><\/script>'
        )
    </script>


    <script
        src="{{ asset('/') }}template_recruitment_crew/cdn.jsdelivr.net/npm/bootstrap%404.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <!-- <script src="https://unpkg.com/@popperjs/core@2"></script>-->
    <script src="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/bootstraptable/bootstrap-table.js">
    </script>

    <!-- Select2 JS -->
    {{-- <script src="{{ asset('/') }}assets/js/select2.min.js"></script> --}}

    <script type="text/javascript"
        src="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/js/ajaxfileupload.js"></script>

    <script src="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/js/function.js"></script>
    <!-- <script src="http://103.146.30.155:82/assets/js/moment.min.js"></script>-->
    <script
        src="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/adminlte320/plugins/moment/moment.min.js">
    </script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script
        src="{{ asset('/') }}template_recruitment_crew/103.146.30.155_82/assets/adminlte320/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <script>
        function operateFormatter(value, row, index) {
            return [
                '',
                '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
                'Hapus',
                '</a>'
            ].join('');
        }
        window.operateEvents = {
            'click .edit': function(e, value, row, index) {
                //alert('You click remove icon, row: ' + JSON.stringify(row));
                edittrcop(JSON.stringify(row));
            },
            'click .remove': function(e, value, row, index) {
                //alert('You click remove icon, row: ' + JSON.stringify(row));
                deltrcop(JSON.stringify(row));
            }
        };

        function operateFormatter2(value, row, index) {
            return [
                '',
                '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
                'hapus',
                '</a>'
            ].join('');
        }
        window.operateEvents2 = {
            'click .edit': function(e, value, row, index) {
                //alert('You click remove icon, row: ' + JSON.stringify(row));
                edittrworkexp(JSON.stringify(row));
            },
            'click .remove': function(e, value, row, index) {
                //alert('You click remove icon, row: ' + JSON.stringify(row));
                deltrworkexp(JSON.stringify(row));
            }
        };

        $(document).ready(function() {

            // $('#cmbijasah').select2({
            //     width: '100%',
            //     // height: '100%'
            // });

            // Validasi Status Pelamar
            $("#choose_ayahkandung").show();
            $("#choose_ibukandung").show();
            $("#choose_pasangan").hide();
            $("#choose_anak1").hide();
            $("#choose_anak2").hide();
            $("#choose_anak3").hide();
            $("#choose_anak4").hide();
            $("#choose_anak5").hide();
            $("#cmbstatus").on('change', function() {
                if ($(this).val() == "TK0") {
                    $("#choose_ayahkandung").show();
                    $("#choose_ibukandung").show();
                    $("#choose_pasangan").hide();
                    $("#choose_anak1").hide();
                    $("#choose_anak2").hide();
                    $("#choose_anak3").hide();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "K0") {
                    $("#choose_ayahkandung").hide();
                    $("#choose_ibukandung").hide();
                    $("#choose_pasangan").show();
                    $("#choose_anak1").hide();
                    $("#choose_anak2").hide();
                    $("#choose_anak3").hide();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "K1") {
                    $("#choose_ayahkandung").hide();
                    $("#choose_ibukandung").hide();
                    $("#choose_pasangan").show();
                    $("#choose_anak1").show();
                    $("#choose_anak2").hide();
                    $("#choose_anak3").hide();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "K2") {
                    $("#choose_ayahkandung").hide();
                    $("#choose_ibukandung").hide();
                    $("#choose_pasangan").show();
                    $("#choose_anak1").show();
                    $("#choose_anak2").show();
                    $("#choose_anak3").hide();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "K3") {
                    $("#choose_ayahkandung").hide();
                    $("#choose_ibukandung").hide();
                    $("#choose_pasangan").show();
                    $("#choose_anak1").show();
                    $("#choose_anak2").show();
                    $("#choose_anak3").show();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "TK1") {
                    $("#choose_ayahkandung").show();
                    $("#choose_ibukandung").show();
                    $("#choose_pasangan").hide();
                    $("#choose_anak1").show();
                    $("#choose_anak2").hide();
                    $("#choose_anak3").hide();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "TK2") {
                    $("#choose_ayahkandung").show();
                    $("#choose_ibukandung").show();
                    $("#choose_pasangan").hide();
                    $("#choose_anak1").show();
                    $("#choose_anak2").show();
                    $("#choose_anak3").hide();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "TK3") {
                    $("#choose_ayahkandung").show();
                    $("#choose_ibukandung").show();
                    $("#choose_pasangan").hide();
                    $("#choose_anak1").show();
                    $("#choose_anak2").show();
                    $("#choose_anak3").show();
                    $("#choose_anak4").hide();
                    $("#choose_anak5").hide();
                } else if ($(this).val() == "CERAI") {
                    $("#choose_ayahkandung").show();
                    $("#choose_ibukandung").show();
                    $("#choose_pasangan").hide();
                    $("#choose_anak1").show();
                    $("#choose_anak2").show();
                    $("#choose_anak3").show();
                    $("#choose_anak4").show();
                    $("#choose_anak5").show();
                }
            });
            // END Validasi Status Pelamar

            // Validasi Applied Posisi
            $(".choose_jbt_tb").hide();
            $("#cmbPosisitionworkApplied").on('change', function() {
                if ($(this).val() == "MV") {
                    $(".choose_jbt_tb").hide();
                    $(".choose_jbt_mv").show();
                    // $("#cmbJabatanworkApplied_tb").hide();
                } else if ($(this).val() == "TUGBARGE") {
                    $(".choose_jbt_tb").show();
                    $(".choose_jbt_mv").hide();
                    // $("#cmbJabatanworkApplied_mv").hide();
                }
            });
            // END Validasi Applied Posisi

            // validasi referensi
            $("#cmbreferensi").change(function() {
                if ($(this).val() == "YA") {
                    $("#nm_ref").show();
                } else {
                    $("#nm_ref").hide();
                }
            });
            // END validasi referensi

            var min_exp = 0;

            function _calculateAge(birthday) { // birthday is a date
                var ageDifMs = Date.now() - birthday.getTime();
                var ageDate = new Date(ageDifMs); // miliseconds from epoch
                return Math.abs(ageDate.getUTCFullYear() - 1970);
            }

            var dttgllhrval, dttglendorsval, dttglissuedcocval, dttglissuedcopval, dttglexpcopval,
                dttgldrworkexpval, dttglsmpworkexp;

            $('#dttgllhr').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                defaultDate: moment(),
                format: "DD-MM-yyyy"
            });
            $('#dttglendors').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                defaultDate: moment(),
                format: "DD-MM-yyyy"
            });
            $('#dttglissuedcop').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                defaultDate: moment(),
                format: "DD-MM-yyyy"
            });
            $('#dttglexpcop').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                defaultDate: moment(),
                format: "DD-MM-yyyy"
            });
            $('#dttgldrworkexp').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                defaultDate: moment(),
                format: "DD-MM-yyyy"
            });
            $('#dttglsmpworkexp').datetimepicker({
                icons: {
                    time: 'far fa-clock'
                },
                defaultDate: moment(),
                format: "DD-MM-yyyy"
            });

            //--global fx
            //var sescoc=[];
            var sescop = [];
            var sessworkexp = [];
            $(function() {
                /* deltrcoc = function (x) {
                		var obj = jQuery.parseJSON(x);
                		//alert(obj.sescocid);
                		$.ajax({
                			url             :'http://103.146.30.155:82/recruit/delsesscoc',
                			type:'POST',
                			dataType: 'json',
                			dataType: 'JSON',
                			data			: {
                				psescocid:obj.sescocid

                			},
                			success : function (data)
                			{
                				//alert(data.msg);
                				$('#table-ijasah').bootstrapTable('refresh');
                			}
                		});
                	  }*/
                edittrworkexp = function(x) {
                    var obj = jQuery.parseJSON(x);
                    //alert(obj.sescocid);

                    $("#txtsesworkexpid").val(obj.sesworkexpid);
                    $("#txtkapalworkexp").val(obj.seskapalworkexp);
                    $("#txtpemilikworkexp").val(obj.sespemilikworkexp);
                    $("#cmbJabatanworkexp").val(obj.sesjabatanworkexp);
                    $("#txtmesinworkexp").val(obj.sesmesinworkexp);
                    $("#txtgrtworkexp").val(obj.sesgrtworkexp);
                    $("#txthpworkexp").val(obj.seshpworkexp);
                    $("#dttgldrworkexp").val(obj.sestgldrworkexp);
                    $("#dttglsmpworkexp").val(obj.sestglsmpworkexp);

                }
                deltrworkexp = function(x) {
                    var obj = jQuery.parseJSON(x);
                    //alert(obj.sescocid);
                    $.ajax({
                        url: 'http://103.146.30.155:82/recruit/delsessworkexp',
                        type: 'POST',
                        dataType: 'json',
                        dataType: 'JSON',
                        data: {
                            psesworkexpid: obj.sesworkexpid

                        },
                        success: function(data) {
                            //alert(data.msg);
                            $('#table-workexp').bootstrapTable('refresh');
                        }
                    });
                }
                edittrcop = function(x) {
                    var obj = jQuery.parseJSON(x);
                    //alert(obj.sescocid);
                    $("#txtsescopid").val(obj.sescopid);
                    $("#cmbtypedocscop").val(obj.sesTypedocscop);
                    $("#txtnodoccop").val(obj.sesNodoccop);
                    $("#dttglissuedcop").val(obj.sesTglissuedcop);
                    $("#dttglexpcop").val(obj.sesTglexpcop);
                    $("#txtissuedcop").val(obj.sesIssuedcop);


                }
                deltrcop = function(x) {
                    var obj = jQuery.parseJSON(x);
                    //alert(obj.sescocid);
                    $.ajax({
                        url: 'http://103.146.30.155:82/recruit/delsesscop',
                        type: 'POST',
                        dataType: 'json',
                        dataType: 'JSON',
                        data: {
                            psescopid: obj.sescopid

                        },
                        success: function(data) {
                            //alert(data.msg);
                            $('#table-cop').bootstrapTable('refresh');
                        }
                    });
                }
            });

            //---listcoc
            /*$("#btntest").click(function () {
            	alert($('#dttgllhr').jqxDateTimeInput('value'));
            	//$("#dttglendors").jqxDateTimeInput({width: '300px'});
            	dttgllhrval=dateFormat($('#dttgllhr').jqxDateTimeInput('value'), "yyyy-mm-dd");
            	alert(dttgllhrval);
            	$('#dttglendors').jqxDateTimeInput({ value: new Date(dttgllhrval) });
            });		*/

            $("#btnbatal").click(function() {
                window.location.href = "{{ url('recruitment_crew') }}";
            });





            $("#btnsimpancop").click(function() {
                var isValid = true;
                var msg = "";
                //var startDt = dateFormat($('#dttglissuedcop').jqxDateTimeInput('value'), "yyyy-mm-dd");
                //var endDt = dateFormat($('#dttglexpcop').jqxDateTimeInput('value'), "yyyy-mm-dd");

                var startdate = $("#dttglissuedcop").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                var enddate = $("#dttglexpcop").datetimepicker('viewDate');
                var endDt = moment(enddate).format('YYYY-MM-DD');

                if ($("#txtnodoccop").val() == "") {
                    msg = msg + "- Nomor serifikat harus diisi.\n";
                    isValid = false;
                }
                //if ($('#dttglissuedcop').val() == "") {
                //	msg = msg + "- Tanggal issued serifikat harus diisi " + startDt + ".\n";
                //	isValid = false;
                //}
                //if ($('#dttglexpcop').val() == "") {
                //	msg = msg + "- Tanggal Exp serifikat harus diisi" + endDt + ".\n";
                //	isValid = false;
                //}
                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {
                    msg = msg + "- Tanggal Exp serifikat harus lebih dari tanggal issued.\n";
                    isValid = false;
                }

                if (isValid) {
                    //alert($("#txtsescopid").val());
                    if ($("#txtsescopid").val() == "") {
                        addcop();
                    } else {
                        editcop();
                    }
                } else {
                    alert(msg);
                }
            });

            $("#btnsimpanworkexp").click(function() {
                var isValid = true;
                var msg = "";
                //var startDt = dateFormat($('#dttgldrworkexp').jqxDateTimeInput('value'), "yyyy-mm-dd");
                //var endDt = dateFormat($('#dttglsmpworkexp').jqxDateTimeInput('value'), "yyyy-mm-dd");
                var startdate = $("#dttgldrworkexp").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                var enddate = $("#dttglsmpworkexp").datetimepicker('viewDate');
                var endDt = moment(enddate).format('YYYY-MM-DD');

                if ($("#txtkapalworkexp").val() == "") {
                    msg = msg + "- Kapal harus diisi.\n";
                    isValid = false;
                }
                if ($("#txtpemilikworkexp").val() == "") {
                    msg = msg + "- Pemilik/Perusahaan harus diisi.\n";
                    isValid = false;
                }

                /*if ($('#dttgldrworkexp').val() == "") {
                	msg = msg + "- Tanggal mulai bekerja harus diisi.\n";
                	isValid = false;
                }
                if ($('#dttglsmpworkexp').val() == "") {
                	msg = msg + "- Tanggal terakhir bekerja harus diisi.\n";
                	isValid = false;
                }*/
                if ((new Date(startDt).getTime() > new Date(endDt).getTime())) {
                    msg = msg + "- Tanggal terakhir bekerja harus lebih dari tanggal mulai.\n";
                    isValid = false;
                }

                if (isValid) {
                    if ($("#txtsesworkexpid").val() == "") {
                        addworkexp();
                    } else {
                        editworkexp();
                    }

                } else {
                    alert(msg);
                }
            });

            function addcop() {
                var startdate = $("#dttglissuedcop").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                var enddate = $("#dttglexpcop").datetimepicker('viewDate');
                var endDt = moment(enddate).format('YYYY-MM-DD');

                $.ajax({
                    url: 'http://103.146.30.155:82/recruit/addsesscop',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        pTypedocscop: $("#cmbtypedocscop option:selected").val(),
                        pTypedocscoptxt: $("#cmbtypedocscop option:selected").text(),
                        pNodoccop: $("#txtnodoccop").val(),
                        pTglissuedcop: startDt,
                        pTglexpcop: endDt,
                        pIssuedcop: $("#txtissuedcop").val()

                    },
                    success: function(data) {
                        sescop = data.sescop;
                        $('#table-cop').bootstrapTable('refresh');
                    }
                });
            }

            function editcop() {
                var startdate = $("#dttglissuedcop").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                var enddate = $("#dttglexpcop").datetimepicker('viewDate');
                var endDt = moment(enddate).format('YYYY-MM-DD');

                $.ajax({
                    url: 'http://103.146.30.155:82/recruit/editsesscop',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        psescopid: $("#txtsescopid").val(),
                        pTypedocscop: $("#cmbtypedocscop option:selected").val(),
                        pTypedocscoptxt: $("#cmbtypedocscop option:selected").text(),
                        pNodoccop: $("#txtnodoccop").val(),
                        pTglissuedcop: startDt,
                        pTglexpcop: endDt,
                        pIssuedcop: $("#txtissuedcop").val()

                    },
                    success: function(data) {
                        sescop = data.sescop;
                        $('#table-cop').bootstrapTable('refresh');
                        $("#txtsescopid").val('');
                    }
                });
            }

            function addworkexp() {
                var startdate = $("#dttgldrworkexp").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                var enddate = $("#dttglsmpworkexp").datetimepicker('viewDate');
                var endDt = moment(enddate).format('YYYY-MM-DD');

                $.ajax({
                    url: 'http://103.146.30.155:82/recruit/addsessworkexp',
                    type: 'POST',
                    dataType: 'json',
                    dataType: 'JSON',
                    data: {
                        pkapalworkexp: $("#txtkapalworkexp").val(),
                        ppemilikworkexp: $("#txtpemilikworkexp").val(),
                        pjabatanworkexp: $("#cmbJabatanworkexp option:selected").val(),
                        pjabatanworkexptxt: $("#cmbJabatanworkexp option:selected").text(),
                        pmesinworkexp: $("#txtmesinworkexp").val(),
                        pgrtworkexp: $("#txtgrtworkexp").val(),
                        phpworkexp: $("#txthpworkexp").val(),
                        ptgldrworkexp: startDt,
                        ptglsmpworkexp: endDt

                    },
                    success: function(data) {
                        sessworkexp = data.sessworkexp;
                        $('#table-workexp').bootstrapTable('refresh');
                    }
                });
            }

            function editworkexp() {
                var startdate = $("#dttgldrworkexp").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                var enddate = $("#dttglsmpworkexp").datetimepicker('viewDate');
                var endDt = moment(enddate).format('YYYY-MM-DD');

                $.ajax({
                    url: 'http://103.146.30.155:82/recruit/editworkexp',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        psesworkexpid: $("#txtsesworkexpid").val(),
                        pkapalworkexp: $("#txtkapalworkexp").val(),
                        ppemilikworkexp: $("#txtpemilikworkexp").val(),
                        pjabatanworkexp: $("#cmbJabatanworkexp option:selected").val(),
                        pjabatanworkexptxt: $("#cmbJabatanworkexp option:selected").text(),
                        pmesinworkexp: $("#txtmesinworkexp").val(),
                        pgrtworkexp: $("#txtgrtworkexp").val(),
                        phpworkexp: $("#txthpworkexp").val(),
                        ptgldrworkexp: startDt,
                        ptglsmpworkexp: endDt

                    },
                    success: function(data) {
                        sescop = data.sescop;
                        $('#table-workexp').bootstrapTable('refresh');
                        $("#txtsesworkexpid").val('');
                    }
                });
            }

            function uploadcvx() {
                var startdate = $("#dttgllhr").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                var enddate = $("#dttglendors").datetimepicker('viewDate');
                var endDt = moment(enddate).format('YYYY-MM-DD');

                //var hasil;
                //alert("2"+id);

                //alert("2"+id);
                if ($("#uploadFileCv").val() != "") {
                    //alert($("#uploadFilePic").val());
                    //alert(id);
                    $.ajaxFileUpload({
                        url: 'http://103.146.30.155:82/recruit/insertapplycrew2',
                        secureuri: false,
                        type: 'POST',
                        crossDomain: true,
                        fileElementId: 'uploadFileCv',
                        dataType: 'json',
                        crossDomain: true,
                        data: {
                            //pid:id
                            pJabatan: $("#cmbJabatan option:selected").val(),
                            pnama: $("#txtnama").val(),

                            ptmplhr: $("#txttmplhr").val(),
                            ptgllhr: startDt,
                            pgender: $("#cmbgender option:selected").val(),
                            pstatus: $("#cmbstatus option:selected").val(),
                            pktp: $("#txtktp").val(),
                            pnpwp: $("#txtnpwp").val(),
                            pgoldarah: $("#cmbgoldarah option:selected").val(),
                            ptelp: $("#txttelp").val(),
                            palamat: $("#txtalamat").val(),
                            pemail: $("#txtemail").val(),
                            pagama: $("#cmbagama option:selected").val(),
                            ptinggibdn: $("#txttinggibdn").val(),
                            pbrtbdn: $("#txtbrtbdn").val(),
                            pwp: $("#cmbwp option:selected").val(),
                            psepatu: $("#cmbsepatu option:selected").val(),
                            preferenceby: $("#txtreferensi").val(),
                            psesscop: sescop,
                            psessworkexp: sessworkexp,
                            //pracaptcha:$("#g-recaptcha-response").val(),
                            pijasah: $("#cmbijasah option:selected").val(),
                            ptglendors: endDt,
                            pnodoccoc: $("#txtnodoccoc").val(),
                            //ptglissuedcoc:dateFormat($('#dttglissuedcoc').jqxDateTimeInput('value'), "yyyy-mm-dd"),
                            pnodoccoe: $("#txtnodoccoe").val()
                        },
                        beforeSend: function() {
                            $("#wait").css("display", "block");
                            $("body").css("cursor", "wait");
                        },
                        error: function(data, status, e) {
                            //alert(data.msg);
                            $("body").css("cursor", "default");
                            document.getElementById("wait").style.display = "none";
                            //window.location.href="http://103.146.30.155:82/recruit/resultcrew?rid="+id;
                            hasil = 'error';
                        },
                        success: function(data, status) {
                            $("body").css("cursor", "default");
                            document.getElementById("wait").style.display = "none";
                            //alert(data);
                            //var obj = jQuery.parseJSON(data);
                            if (data.status == 'success') {
                                //alert(data.msg);
                                window.location.href =
                                    "http://103.146.30.155:82/recruit/resultcrew?rid=" + id;
                                hasil = 'success';

                            } else {
                                alert(data.msg);
                                hasil = 'error';
                            }
                        }
                    });

                }
                //alert(hasil);
                //return hasil;
            }


            $("#btnsimpan").click(function() {
                alert(
                    "PENERIMAAN CREW DI PT. PATRIA MARITIME LINES TIDAK DIKENAKAN BIAYA ( GRATIS ), untuk pengaduan dapat menghubungi email berikut crewing@pml.co.id"
                );
                //alert($('#table-workexp >tbody:last >tr').length);
                var isValid = true;
                var msg = "";
                if ($("#txtlokasi").val() == "") {
                    msg = msg + "- lokasi registrasi harus diisi.\n";
                    isValid = false;
                }
                if ($("#cmbijasah option:selected").val() == undefined) {
                    msg = msg + "- Pendidikan terakhir harus di pilih.\n";
                    isValid = false;
                }
                if ($("#cmbJabatan option:selected").val() == undefined) {
                    msg = msg + "- Jabatan / Posisi yang di lamar harus di pilih.\n";
                    isValid = false;
                }

                if ($('#chkok').prop('checked')) {
                    isValid = true;
                } else {
                    msg = msg + "- Anda harus menyetujui terms n conditions.\n";
                    isValid = false;
                }
                if ($("#txtnama").val() == "") {
                    msg = msg + "- Nama harus diisi.\n";
                    isValid = false;
                }
                if ($("#txttmplhr").val() == "") {
                    msg = msg + "- Tempat lahir harus diisi.\n";
                    isValid = false;
                }
                if ($("#txtktp").val() == "") {
                    msg = msg + "- No. KTP harus diisi.\n";
                    isValid = false;
                }

                if ($("#txttelp").val() == "") {
                    msg = msg + "- No. Telp harus diisi.\n";
                    isValid = false;
                }
                if ($("#txtemail").val() == "") {
                    msg = msg + "- Email harus diisi.\n";
                    isValid = false;
                }

                if ($("#txtkelnama").val() == "") {
                    msg = msg + "- Kontak Keluarga harus diisi.\n";
                    isValid = false;
                }
                if ($("#txtkeltelp").val() == "") {
                    msg = msg + "- Telp Kontak Keluarga harus diisi.\n";
                    isValid = false;
                }

                if ($("#txtkelhubungan").val() == "") {
                    msg = msg + "- Hubungan kontak Keluarga harus diisi.\n";
                    isValid = false;
                }
                if ($("#txtkelalamat").val() == "") {
                    msg = msg + "- Alamat Kontak Keluarga harus diisi.\n";
                    isValid = false;
                }

                if ($("#txtpaybank").val() == "") {
                    msg = msg + "- Bank harus diisi.\n";
                    isValid = false;
                }
                if ($("#txtpaycabang").val() == "") {
                    msg = msg + "- Cabang bank harus diisi.\n";
                    isValid = false;
                }

                if ($("#txtpayrek").val() == "") {
                    msg = msg + "- Nomor Rekening harus diisi.\n";
                    isValid = false;
                }
                if ($("#txtpaynama").val() == "") {
                    msg = msg + "- Nama Rekening bank harus diisi.\n";
                    isValid = false;
                }



                var startdate = $("#dttgllhr").datetimepicker('viewDate');
                var startDt = moment(startdate).format('YYYY-MM-DD');
                //var enddate = $("#dttglsmpworkexp").datetimepicker('viewDate');
                // var endDt = moment(enddate).format('YYYY-MM-DD');





                if (_calculateAge(new Date(startDt)) < 17) {
                    msg = msg + "- Anda belum cukup umur, perhatikan tanggal lahir anda.\n";
                    isValid = false;
                }
                if ($("#txtnodoccoc").val() == "") {
                    msg = msg + "- Nomor COC harus diisi.\n";
                    isValid = false;
                }
                if ($('#table-cop').bootstrapTable('getData').length < 1) {
                    msg = msg + "- Sertifikat COP yang dimilik Harus diisi.\n";
                    isValid = false;
                }
                if ($('#table-workexp').bootstrapTable('getData').length < 1) {
                    msg = msg + "- Data Pengalaman Kerja harus diisi.\n";
                    isValid = false;
                }
                if ($("#uploadFileCv").val() == "") {
                    msg = msg + "- CV harus di upload, pilih file CV anda.\n";
                    isValid = false;
                }

                if (isValid) {
                    alert($("#cmbJabatan option:selected").val());
                    //$("#btnsimpan").hide();
                    //insertData();
                    //uploadcvx();
                    //$( "#fcrewapp" ).submit();
                    if ($("#cmbJabatan option:selected").val() != undefined) {
                        //--cek minimal pengalaman
                        var minexp = 0;
                        var myexp = 0;
                        $.ajax({
                            url: 'http://103.146.30.155:82/recruit/cekexp',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                pjabatan: $("#cmbJabatan option:selected").val()

                            },
                            success: function(data) {
                                minexp = data.min_exp;
                                myexp = data.myexp;
                                //alert(minexp+" "+myexp);
                                if (minexp > myexp) {
                                    alert("- Jabatan / Posisi yang di lamar " + $(
                                            "#cmbJabatan option:selected").text() +
                                        ", minimal pengalaman " + (minexp / 365).toFixed(
                                            2) + " Tahun. \n Pengalaman anda " + (myexp /
                                            365)
                                        .toFixed(2) + " Thn");
                                    //isValid = false;
                                } else {
                                    $("#btnsimpan").hide();
                                    $("#fcrewapp").submit();
                                }
                            }
                        });


                    }
                } else {
                    alert(msg);
                }
            });
            $("#cmbijasah").change(function() {
                $("#cmbijasah option:selected").each(function() {
                    //alert($("#cmbijasah option:selected").val());
                    $.ajax({
                        url: 'http://103.146.30.155:82/recruit/getJabatanByCoc',
                        type: 'post',
                        data: {
                            cocId: $("#cmbijasah option:selected").val()
                        },
                        dataType: 'json',
                        success: function(response) {

                            var len = response.length;

                            $("#cmbJabatan").empty();
                            for (var i = 0; i < len; i++) {
                                var id = response[i]['jabatan_code'];
                                var name = response[i]['jabatan_name'];

                                $("#cmbJabatan").append("<option value='" + id + "'>" +
                                    name + "</option>");

                                //min_exp = 0;
                                //$("#txtminexp").val(0);
                                //$("#lblminexp").text("");
                            }
                            $("#cmbJabatan").val(0).trigger("change");
                        }
                    });
                });
            });
            $("#cmbijasah").val(0).trigger("change");
            if ($("#cmbijasah > option").length < 1) {
                alert("Pilihan PENDIDIKAN TERAKHIR kosong, mohon REFRESH halaman terlebih dahulu.");

            }

            $("#cmbJabatan").change(function() {
                $("#cmbJabatan option:selected").each(function() {
                    //alert($("#cmbijasah option:selected").val());
                    $.ajax({
                        url: 'http://103.146.30.155:82/recruit/getJabatanexp',
                        type: 'post',
                        data: {
                            jabatanId: $("#cmbJabatan option:selected").val()
                        },
                        dataType: 'json',
                        success: function(response) {

                            min_exp = response.min_exp;
                            $("#txtminexp").val(min_exp);
                            $("#lblminexp").text("Min Pengalaman " + min_exp +
                                " Tahun");
                        }
                    });
                });
            });
        });
    </script><!-- Page Content -->
</body>


<!-- Mirrored from 103.146.30.155:82/recruit/recruitCrew by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 09 Jun 2023 09:01:09 GMT -->

</html>
