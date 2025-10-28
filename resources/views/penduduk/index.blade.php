<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Data Penduduk Desa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
        .jaga-section {
            margin-bottom: 2rem;
        }
        .jaga-title {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: bold;
            margin-bottom: 1rem;
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
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }
            .btn-group {
                flex-direction: column;
                width: 100%;
            }
            .btn-group .btn {
                border-radius: 0 !important;
                margin-bottom: 2px;
            }
            .btn-group .btn:first-child {
                border-top-left-radius: 0.375rem !important;
                border-top-right-radius: 0.375rem !important;
            }
            .btn-group .btn:last-child {
                border-bottom-left-radius: 0.375rem !important;
                border-bottom-right-radius: 0.375rem !important;
            }
            .row.mb-4 .col-md-2 {
                margin-bottom: 1rem;
            }
            .row.mb-4 .col-md-2 .p-3 {
                padding: 1rem !important;
            }
            .row.mb-4 .col-md-2 h3 {
                font-size: 1.5rem;
            }
        }
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }
            .table-responsive {
                font-size: 0.75rem;
            }
            .badge {
                font-size: 0.75rem;
            }
            .jaga-title {
                font-size: 1.25rem;
            }
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="{{ route('penduduk.index') }}">
                <i class="fas fa-users"></i> Sistem Pendataan Penduduk Desa
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="h4 mb-0"><i class="fas fa-list"></i> Data Penduduk</h1>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <a href="{{ route('penduduk.create') }}" class="btn btn-success btn-custom">
                                <i class="fas fa-plus"></i> Tambah Penduduk Baru
                            </a>
                            <a href="{{ route('penduduk.export') }}" class="btn btn-primary btn-custom">
                                <i class="fas fa-file-excel"></i> Export ke Excel
                            </a>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($penduduks->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">Belum ada data penduduk</h4>
                                <p class="text-muted">Mulai tambahkan data penduduk pertama Anda.</p>
                            </div>
                        @else
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><i class="fas fa-chart-bar"></i> Ringkasan Data Penduduk</h5>
                                            <div class="row text-center">
                                                <div class="col-md-2">
                                                    <div class="p-3 bg-primary text-white rounded shadow-sm">
                                                        <h3>{{ $penduduks->flatten()->count() }}</h3>
                                                        <small>Total Penduduk</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="p-3 bg-info text-white rounded shadow-sm">
                                                        <h3>{{ $penduduks->flatten()->where('jenis_kelamin', 'L')->count() }}</h3>
                                                        <small>Laki-laki</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="p-3 bg-secondary text-white rounded shadow-sm">
                                                        <h3>{{ $penduduks->flatten()->where('jenis_kelamin', 'P')->count() }}</h3>
                                                        <small>Perempuan</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="p-3 bg-success text-white rounded shadow-sm">
                                                        <h3>{{ $penduduks->flatten()->where('umur', '<=', 17)->count() }}</h3>
                                                        <small>Anak-anak (≤17)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="p-3 bg-warning text-dark rounded shadow-sm">
                                                        <h3>{{ $penduduks->flatten()->whereBetween('umur', [18, 59])->count() }}</h3>
                                                        <small>Dewasa (18-59)</small>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="p-3 bg-light text-dark rounded shadow-sm border">
                                                        <h3>{{ $penduduks->flatten()->where('umur', '>=', 60)->count() }}</h3>
                                                        <small>Lansia (≥60)</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row text-center mt-2">
                                                <div class="col-md-12">
                                                    <div class="p-2 bg-info text-white rounded">
                                                        <h4>{{ $penduduks->keys()->filter()->count() }}</h4>
                                                        <small>Jumlah Jaga</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @foreach($penduduks as $kkNo => $pendudukList)
                                <div class="jaga-section">
                                    <h3 class="jaga-title">
                                        <i class="fas fa-home"></i> KK: {{ $kkNo }}
                                    </h3>

                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <thead class="table-secondary">
                                                <tr>
                                                    <th><i class="fas fa-hashtag"></i> ID</th>
                                                    <th><i class="fas fa-user"></i> Nama</th>
                                                    <th><i class="fas fa-id-card"></i> NIK</th>
                                                    <th><i class="fas fa-birthday-cake"></i> Tanggal Lahir</th>
                                                    <th><i class="fas fa-venus-mars"></i> Jenis Kelamin</th>
                                                    <th><i class="fas fa-map"></i> Alamat</th>
                                                    <th><i class="fas fa-briefcase"></i> Pekerjaan</th>
                                                    <th><i class="fas fa-calendar-alt"></i> Umur</th>
                                                    <th><i class="fas fa-ring"></i> Status</th>
                                                    <th><i class="fas fa-pray"></i> Agama</th>
                                                    <th><i class="fas fa-graduation-cap"></i> Pendidikan</th>
                                                    <th><i class="fas fa-cogs"></i> Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendudukList as $penduduk)
                                                <tr>
                                                    <td>{{ $penduduk->id }}</td>
                                                    <td><strong>{{ $penduduk->nama }}</strong></td>
                                                    <td>{{ $penduduk->nik }}</td>
                                                    <td>{{ $penduduk->tanggal_lahir->format('d-m-Y') }}</td>
                                                    <td class="text-center">
                                                        @if($penduduk->jenis_kelamin == 'L')
                                                            <span class="badge bg-primary"><i class="fas fa-mars"></i> Laki-laki</span>
                                                        @else
                                                            <span class="badge bg-danger"><i class="fas fa-venus"></i> Perempuan</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $penduduk->alamat }}</td>
                                                    <td>{{ $penduduk->pekerjaan ?: '-' }}</td>
                                                    <td>{{ $penduduk->umur ? $penduduk->umur . ' tahun' : '-' }}</td>
                                                    <td>{{ $penduduk->status_perkawinan ?: '-' }}</td>
                                                    <td>{{ $penduduk->agama ?: '-' }}</td>
                                                    <td>{{ $penduduk->pendidikan ?: '-' }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('penduduk.show', $penduduk->id) }}" class="btn btn-sm btn-outline-info" title="Lihat Detail">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="btn btn-sm btn-outline-warning" title="Edit">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('penduduk.destroy', $penduduk->id) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
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
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
