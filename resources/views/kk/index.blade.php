<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data KK Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .btn-custom {
            border-radius: 25px;
            padding: 10px 20px;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,.075);
        }
        .kk-section {
            margin-bottom: 2rem;
        }
        .kk-title {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        /* Custom table styling */
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .table thead {
            background-color: #343a40 !important;
        }
        .table thead th {
            color: #ffffff !important;
            background-color: #343a40 !important;
            border: 1px solid #343a40 !important;
            padding: 1rem;
            vertical-align: middle;
            font-weight: 700;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table thead th i {
            color: #ffffff !important;
        }
        .table tbody tr {
            transition: all 0.2s ease;
            background-color: #ffffff;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa !important;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .table tbody td {
            vertical-align: middle;
            border: 1px solid #dee2e6;
            padding: 1rem 0.75rem;
            font-size: 0.95rem;
            background-color: #ffffff;
        }
        .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }
        .table-bordered {
            border: 1px solid #dee2e6 !important;
        }
        .section-badge {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .badge-jaga1 {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            color: white;
        }
        .badge-jaga2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
        }
        .badge-no-jaga {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            .table-responsive {
                font-size: 0.875rem;
            }
            .btn-custom {
                padding: 8px 16px;
                font-size: 0.875rem;
            }
            .card-body {
                padding: 1rem;
            }
            .table-container {
                padding: 1rem;
                border-radius: 10px;
            }
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }
            .d-flex.justify-content-between .btn-group {
                width: 100%;
            }
            .d-flex.justify-content-between .btn-group .btn {
                width: 100%;
            }
            .btn-group {
                flex-direction: column;
                width: 100%;
            }
            .btn-group .btn {
                border-radius: 0.25rem !important;
                margin-bottom: 3px;
                width: 100%;
            }
            .row.mb-4 .col-md-3 {
                margin-bottom: 1rem;
            }
            .row.mb-4 .col-md-3 .p-3 {
                padding: 1rem !important;
            }
            .row.mb-4 .col-md-3 h3 {
                font-size: 1.5rem;
            }
            .section-badge {
                font-size: 0.95rem;
                padding: 0.4rem 1rem;
            }
            /* Make table scrollable on mobile */
            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            .table {
                min-width: 600px;
            }
            .table thead th {
                font-size: 0.8rem;
                padding: 0.75rem 0.5rem;
                white-space: nowrap;
            }
            .table tbody td {
                font-size: 0.85rem;
                padding: 0.75rem 0.5rem;
            }
        }
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 0.9rem;
            }
            .card-header h1 {
                font-size: 1.1rem;
            }
            .table-responsive {
                font-size: 0.75rem;
            }
            .badge {
                font-size: 0.75rem;
            }
            .kk-title {
                font-size: 1.25rem;
            }
            .section-badge {
                font-size: 0.85rem;
                padding: 0.35rem 0.85rem;
            }
            .btn-custom {
                font-size: 0.8rem;
                padding: 6px 12px;
            }
            /* Stack summary cards on very small screens */
            .row.mb-4 .col-md-3 {
                width: 50%;
                float: left;
            }
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('kk.index') }}">
                <i class="fas fa-users"></i> Sistem Pendataan Penduduk Desa
            </a>
            <div class="navbar-nav ms-auto">

            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="h4 mb-0"><i class="fas fa-home"></i> Data Kartu Keluarga (KK)</h1>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="{{ route('kk.create') }}" class="btn btn-success btn-custom">
                                <i class="fas fa-plus"></i> Tambah KK Baru
                            </a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-custom dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('kk.export') }}">
                                        <i class="fas fa-download"></i> Semua Data
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('kk.export', ['jaga' => '1']) }}">
                                        <i class="fas fa-download"></i> Jaga 1 Saja
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('kk.export', ['jaga' => '2']) }}">
                                        <i class="fas fa-download"></i> Jaga 2 Saja
                                    </a></li>
                                </ul>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($kks->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-home fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">Belum ada data KK</h4>
                                <p class="text-muted">Mulai tambahkan data KK pertama Anda.</p>
                            </div>
                        @else
                            @php
                                $totalPenduduk = $kks->sum(function($kk) { return $kk->penduduks->count(); });
                                $pendudukJaga1 = $kks->where('jaga', '1')->sum(function($kk) { return $kk->penduduks->count(); });
                                $pendudukJaga2 = $kks->where('jaga', '2')->sum(function($kk) { return $kk->penduduks->count(); });
                                
                                // Hitung jenis kelamin
                                $allPenduduks = $kks->flatMap(function($kk) { return $kk->penduduks; });
                                $totalLakiLaki = $allPenduduks->where('jenis_kelamin', 'L')->count();
                                $totalPerempuan = $allPenduduks->where('jenis_kelamin', 'P')->count();
                                
                                // Hitung anak-anak (umur < 18 tahun)
                                $totalAnak = $allPenduduks->filter(function($p) {
                                    return $p->tanggal_lahir && \Carbon\Carbon::parse($p->tanggal_lahir)->age < 18;
                                })->count();
                                
                                // Per Jaga
                                $pendudukJaga1Collection = $kks->where('jaga', '1')->flatMap(function($kk) { return $kk->penduduks; });
                                $lakiLakiJaga1 = $pendudukJaga1Collection->where('jenis_kelamin', 'L')->count();
                                $perempuanJaga1 = $pendudukJaga1Collection->where('jenis_kelamin', 'P')->count();
                                $anakJaga1 = $pendudukJaga1Collection->filter(function($p) {
                                    return $p->tanggal_lahir && \Carbon\Carbon::parse($p->tanggal_lahir)->age < 18;
                                })->count();
                                
                                $pendudukJaga2Collection = $kks->where('jaga', '2')->flatMap(function($kk) { return $kk->penduduks; });
                                $lakiLakiJaga2 = $pendudukJaga2Collection->where('jenis_kelamin', 'L')->count();
                                $perempuanJaga2 = $pendudukJaga2Collection->where('jenis_kelamin', 'P')->count();
                                $anakJaga2 = $pendudukJaga2Collection->filter(function($p) {
                                    return $p->tanggal_lahir && \Carbon\Carbon::parse($p->tanggal_lahir)->age < 18;
                                })->count();
                            @endphp
                            
                            <!-- Chart Statistik -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-chart-pie"></i> Statistik Penduduk</h5>
                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <div class="text-center">
                                                        <h6>Total Penduduk per Wilayah</h6>
                                                        <canvas id="chartWilayah" style="max-height: 250px;"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="text-center">
                                                        <h6>Jenis Kelamin</h6>
                                                        <canvas id="chartJenisKelamin" style="max-height: 250px;"></canvas>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="text-center">
                                                        <h6>Kategori Usia</h6>
                                                        <canvas id="chartUsia" style="max-height: 250px;"></canvas>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-chart-bar"></i> Ringkasan Data KK</h5>
                                            <div class="row text-center">
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3 bg-primary text-white rounded shadow-sm">
                                                        <h3>{{ $kks->count() }}</h3>
                                                        <small>Total KK</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3 bg-info text-white rounded shadow-sm">
                                                        <h3>{{ $totalPenduduk }}</h3>
                                                        <small>Total Penduduk</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3 bg-success text-white rounded shadow-sm">
                                                        <h3>{{ $totalLakiLaki }}</h3>
                                                        <small><i class="fas fa-mars"></i> Laki-laki</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3 bg-danger text-white rounded shadow-sm">
                                                        <h3>{{ $totalPerempuan }}</h3>
                                                        <small><i class="fas fa-venus"></i> Perempuan</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3 bg-warning text-dark rounded shadow-sm">
                                                        <h3>{{ $totalAnak }}</h3>
                                                        <small><i class="fas fa-child"></i> Anak-anak (&lt;18 th)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3 bg-secondary text-white rounded shadow-sm">
                                                        <h3>{{ $kks->where('jaga', '1')->count() }}</h3>
                                                        <small>KK Jaga 1</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3 bg-dark text-white rounded shadow-sm">
                                                        <h3>{{ $kks->where('jaga', '2')->count() }}</h3>
                                                        <small>KK Jaga 2</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-6 mb-3">
                                                    <div class="p-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border-radius: 0.25rem;">
                                                        <h3>{{ $totalPenduduk - $totalAnak }}</h3>
                                                        <small><i class="fas fa-user"></i> Dewasa (≥18 th)</small>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Detail per Jaga -->
                                            <hr class="my-4">
                                            <h6 class="mb-3"><i class="fas fa-info-circle"></i> Detail Penduduk per Wilayah Jaga</h6>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="card border-success">
                                                        <div class="card-header bg-success text-white">
                                                            <strong><i class="fas fa-map-marked-alt"></i> Jaga 1</strong>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row text-center">
                                                                <div class="col-4">
                                                                    <h4 class="text-primary">{{ $pendudukJaga1 }}</h4>
                                                                    <small class="text-muted">Total</small>
                                                                </div>
                                                                <div class="col-4">
                                                                    <h4 class="text-info">{{ $lakiLakiJaga1 }}</h4>
                                                                    <small class="text-muted"><i class="fas fa-mars"></i> L</small>
                                                                </div>
                                                                <div class="col-4">
                                                                    <h4 class="text-danger">{{ $perempuanJaga1 }}</h4>
                                                                    <small class="text-muted"><i class="fas fa-venus"></i> P</small>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="text-center">
                                                                <h5 class="text-warning">{{ $anakJaga1 }}</h5>
                                                                <small class="text-muted"><i class="fas fa-child"></i> Anak-anak</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="card border-warning">
                                                        <div class="card-header bg-warning text-dark">
                                                            <strong><i class="fas fa-map-marked-alt"></i> Jaga 2</strong>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="row text-center">
                                                                <div class="col-4">
                                                                    <h4 class="text-primary">{{ $pendudukJaga2 }}</h4>
                                                                    <small class="text-muted">Total</small>
                                                                </div>
                                                                <div class="col-4">
                                                                    <h4 class="text-info">{{ $lakiLakiJaga2 }}</h4>
                                                                    <small class="text-muted"><i class="fas fa-mars"></i> L</small>
                                                                </div>
                                                                <div class="col-4">
                                                                    <h4 class="text-danger">{{ $perempuanJaga2 }}</h4>
                                                                    <small class="text-muted"><i class="fas fa-venus"></i> P</small>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="text-center">
                                                                <h5 class="text-warning">{{ $anakJaga2 }}</h5>
                                                                <small class="text-muted"><i class="fas fa-child"></i> Anak-anak</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Tabel Jaga 1 -->
                            <div class="kk-section">
                                <div class="section-badge badge-jaga1">
                                    <i class="fas fa-map-marked-alt"></i> Wilayah Jaga 1
                                </div>
                                @php
                                    $kkJaga1 = $kks->where('jaga', '1');
                                @endphp
                                @if($kkJaga1->isEmpty())
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> Belum ada data KK untuk Jaga 1
                                    </div>
                                @else
                                    <div class="table-container">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;"><i class="fas fa-hashtag"></i> No</th>
                                                        <th style="width: 20%;"><i class="fas fa-user"></i> Kepala Keluarga</th>
                                                        <th style="width: 40%;"><i class="fas fa-map-marker-alt"></i> Alamat</th>
                                                        <th style="width: 15%;"><i class="fas fa-users"></i> Jumlah Anggota</th>
                                                        <th style="width: 20%;"><i class="fas fa-cogs"></i> Aksi</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                @foreach($kkJaga1 as $index => $kk)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $kk->kepala_keluarga }}</td>
                                                    <td>{{ $kk->alamat }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-info">{{ $kk->penduduks->count() }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('kk.show', $kk->id) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('kk.edit', $kk->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('kk.destroy', $kk->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data KK ini?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Tabel Jaga 2 -->
                            <div class="kk-section">
                                <div class="section-badge badge-jaga2">
                                    <i class="fas fa-map-marked-alt"></i> Wilayah Jaga 2
                                </div>
                                @php
                                    $kkJaga2 = $kks->where('jaga', '2');
                                @endphp
                                @if($kkJaga2->isEmpty())
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle"></i> Belum ada data KK untuk Jaga 2
                                    </div>
                                @else
                                    <div class="table-container">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 5%;"><i class="fas fa-hashtag"></i> No</th>
                                                        <th style="width: 20%;"><i class="fas fa-user"></i> Kepala Keluarga</th>
                                                        <th style="width: 40%;"><i class="fas fa-map-marker-alt"></i> Alamat</th>
                                                        <th style="width: 15%;"><i class="fas fa-users"></i> Jumlah Anggota</th>
                                                        <th style="width: 20%;"><i class="fas fa-cogs"></i> Aksi</th>
                                                    </tr>
                                                </thead>
                                            <tbody>
                                                @foreach($kkJaga2 as $index => $kk)
                                                <tr>
                                                    <td>{{ $index + 1 }}</td>
                                                    <td>{{ $kk->kepala_keluarga }}</td>
                                                    <td>{{ $kk->alamat }}</td>
                                                    <td class="text-center">
                                                        <span class="badge bg-info">{{ $kk->penduduks->count() }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('kk.show', $kk->id) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('kk.edit', $kk->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('kk.destroy', $kk->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data KK ini?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- KK Tanpa Jaga -->
                            @php
                                $kkTanpaJaga = $kks->whereNull('jaga')->merge($kks->where('jaga', ''));
                            @endphp
                            @if($kkTanpaJaga->isNotEmpty())
                            <div class="kk-section">
                                <div class="section-badge badge-no-jaga">
                                    <i class="fas fa-map-marked-alt"></i> Tanpa Wilayah Jaga
                                </div>
                                <div class="table-container">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 5%;"><i class="fas fa-hashtag"></i> No</th>
                                                    <th style="width: 20%;"><i class="fas fa-user"></i> Kepala Keluarga</th>
                                                    <th style="width: 40%;"><i class="fas fa-map-marker-alt"></i> Alamat</th>
                                                    <th style="width: 15%;"><i class="fas fa-users"></i> Jumlah Anggota</th>
                                                    <th style="width: 20%;"><i class="fas fa-cogs"></i> Aksi</th>
                                                </tr>
                                            </thead>
                                        <tbody>
                                            @foreach($kkTanpaJaga as $index => $kk)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $kk->kepala_keluarga }}</td>
                                                <td>{{ $kk->alamat }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">{{ $kk->penduduks->count() }}</span>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <a href="{{ route('kk.show', $kk->id) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        <a href="{{ route('kk.edit', $kk->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <form action="{{ route('kk.destroy', $kk->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data KK ini?')">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Chart Wilayah
        const ctxWilayah = document.getElementById('chartWilayah');
        if (ctxWilayah) {
            new Chart(ctxWilayah, {
                type: 'doughnut',
                data: {
                    labels: ['Jaga 1', 'Jaga 2', 'Tanpa Jaga'],
                    datasets: [{
                        label: 'Jumlah Penduduk',
                        data: [{{ $pendudukJaga1 }}, {{ $pendudukJaga2 }}, {{ $totalPenduduk - $pendudukJaga1 - $pendudukJaga2 }}],
                        backgroundColor: [
                            'rgba(40, 167, 69, 0.8)',
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(108, 117, 125, 0.8)'
                        ],
                        borderColor: [
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(108, 117, 125, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' orang';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Chart Jenis Kelamin
        const ctxJenisKelamin = document.getElementById('chartJenisKelamin');
        if (ctxJenisKelamin) {
            new Chart(ctxJenisKelamin, {
                type: 'pie',
                data: {
                    labels: ['Laki-laki', 'Perempuan'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [{{ $totalLakiLaki }}, {{ $totalPerempuan }}],
                        backgroundColor: [
                            'rgba(23, 162, 184, 0.8)',
                            'rgba(220, 53, 69, 0.8)'
                        ],
                        borderColor: [
                            'rgba(23, 162, 184, 1)',
                            'rgba(220, 53, 69, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' orang';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }

        // Chart Kategori Usia
        const ctxUsia = document.getElementById('chartUsia');
        if (ctxUsia) {
            new Chart(ctxUsia, {
                type: 'doughnut',
                data: {
                    labels: ['Anak-anak (<18 th)', 'Dewasa (≥18 th)'],
                    datasets: [{
                        label: 'Jumlah',
                        data: [{{ $totalAnak }}, {{ $totalPenduduk - $totalAnak }}],
                        backgroundColor: [
                            'rgba(255, 193, 7, 0.8)',
                            'rgba(102, 126, 234, 0.8)'
                        ],
                        borderColor: [
                            'rgba(255, 193, 7, 1)',
                            'rgba(102, 126, 234, 1)'
                        ],
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    let label = context.label || '';
                                    if (label) {
                                        label += ': ';
                                    }
                                    label += context.parsed + ' orang';
                                    return label;
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>
