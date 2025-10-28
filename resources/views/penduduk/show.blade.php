<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail Penduduk - {{ $penduduk->nama }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .info-item {
            margin-bottom: 1rem;
        }
        .info-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 0.25rem;
        }
        .info-value {
            color: #212529;
        }
        .avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            margin: 0 auto 1rem;
        }
        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            .col-lg-8 {
                padding-left: 10px;
                padding-right: 10px;
            }
            .card-body {
                padding: 1rem;
            }
            .d-grid.gap-2.d-md-flex {
                flex-direction: column;
            }
            .d-grid .btn {
                margin-bottom: 0.5rem;
            }
            .row .col-md-6 {
                margin-bottom: 1rem;
            }
            .avatar {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }
            .card-header h1 {
                font-size: 1.25rem;
            }
            .info-label {
                font-size: 0.875rem;
            }
            .info-value {
                font-size: 0.875rem;
            }
            .card-title {
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
            <a href="{{ route('penduduk.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="h4 mb-0"><i class="fas fa-id-card"></i> Detail Penduduk</h1>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <div class="avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <h3 class="card-title mb-1">{{ $penduduk->nama }}</h3>
                            <p class="text-muted mb-0">NIK: {{ $penduduk->nik }}</p>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-birthday-cake text-primary me-2"></i>Tanggal Lahir</div>
                                    <div class="info-value">{{ $penduduk->tanggal_lahir->format('d F Y') }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-calendar-alt text-success me-2"></i>Umur</div>
                                    <div class="info-value">{{ $penduduk->umur ? $penduduk->umur . ' tahun' : '-' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-venus-mars text-info me-2"></i>Jenis Kelamin</div>
                                    <div class="info-value">
                                        @if($penduduk->jenis_kelamin == 'L')
                                            <span class="badge bg-primary"><i class="fas fa-mars"></i> Laki-laki</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fas fa-venus"></i> Perempuan</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-map-marker-alt text-warning me-2"></i>Alamat</div>
                                    <div class="info-value">{{ $penduduk->alamat }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-briefcase text-secondary me-2"></i>Pekerjaan</div>
                                    <div class="info-value">{{ $penduduk->pekerjaan ?: '-' }}</div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-ring text-danger me-2"></i>Status Perkawinan</div>
                                    <div class="info-value">{{ $penduduk->status_perkawinan ?: '-' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-pray text-primary me-2"></i>Agama</div>
                                    <div class="info-value">{{ $penduduk->agama ?: '-' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-graduation-cap text-success me-2"></i>Pendidikan</div>
                                    <div class="info-value">{{ $penduduk->pendidikan ?: '-' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-map text-info me-2"></i>Wilayah Jaga</div>
                                    <div class="info-value">{{ $penduduk->jaga ? 'Jaga ' . $penduduk->jaga : 'Tidak ada' }}</div>
                                </div>

                                <div class="info-item">
                                    <div class="info-label"><i class="fas fa-hashtag text-muted me-2"></i>ID Penduduk</div>
                                    <div class="info-value">{{ $penduduk->id }}</div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="{{ route('penduduk.edit', $penduduk->id) }}" class="btn btn-warning btn-custom">
                                <i class="fas fa-edit"></i> Edit Data
                            </a>
                            <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary btn-custom">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
