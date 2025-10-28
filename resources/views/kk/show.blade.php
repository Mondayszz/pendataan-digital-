<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Detail KK - {{ $kk->kepala_keluarga }}</title>
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
        .info-label {
            font-weight: bold;
            color: #666;
        }
        /* Responsive untuk mobile */
        @media (max-width: 768px) {
            .container {
                padding-left: 10px;
                padding-right: 10px;
            }
            .btn-custom {
                padding: 8px 16px;
                font-size: 0.875rem;
            }
            .card-body {
                padding: 1rem;
            }
            .table-responsive {
                font-size: 0.875rem;
            }
            .btn-group {
                flex-direction: column;
                width: 100%;
            }
            .btn-group .btn {
                border-radius: 0.375rem !important;
                margin-bottom: 0.5rem;
            }
        }
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }
            .card-header h1 {
                font-size: 1.25rem;
            }
            .badge {
                font-size: 0.75rem;
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
            <a href="{{ route('kk.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h1 class="h4 mb-0"><i class="fas fa-home"></i> Detail Kartu Keluarga</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="info-label"><i class="fas fa-user"></i> Kepala Keluarga</td>
                                        <td>: {{ $kk->kepala_keluarga }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label"><i class="fas fa-map-marker-alt"></i> Alamat</td>
                                        <td>: {{ $kk->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label"><i class="fas fa-map"></i> Wilayah Jaga</td>
                                        <td>: {{ $kk->jaga ?: '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="info-label"><i class="fas fa-users"></i> Jumlah Anggota</td>
                                        <td>: <span class="badge bg-info">{{ $kk->penduduks->count() }}</span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('kk.edit', $kk->id) }}" class="btn btn-warning btn-custom">
                                        <i class="fas fa-edit"></i> Edit KK
                                    </a>
                                    <form action="{{ route('kk.destroy', $kk->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data KK ini beserta semua anggotanya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-custom">
                                            <i class="fas fa-trash"></i> Hapus KK
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="mb-0"><i class="fas fa-users"></i> Daftar Anggota Keluarga</h5>
                    </div>
                    <div class="card-body">
                        @if($kk->penduduks->isEmpty())
                            <div class="text-center py-5">
                                <i class="fas fa-user-friends fa-3x text-muted mb-3"></i>
                                <h4 class="text-muted">Belum ada anggota keluarga</h4>
                                <p class="text-muted">Tambahkan anggota keluarga melalui menu Data Penduduk.</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th><i class="fas fa-hashtag"></i> No</th>
                                            <th><i class="fas fa-user"></i> Nama</th>
                                            <th><i class="fas fa-id-card"></i> NIK</th>
                                            <th><i class="fas fa-users"></i> Status Keluarga</th>
                                            <th><i class="fas fa-venus-mars"></i> JK</th>
                                            <th><i class="fas fa-birthday-cake"></i> Tanggal Lahir</th>
                                            <th><i class="fas fa-briefcase"></i> Pekerjaan</th>
                                            <th><i class="fas fa-hourglass-half"></i> Umur</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($kk->penduduks as $index => $penduduk)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $penduduk->nama }}</td>
                                            <td>{{ $penduduk->nik }}</td>
                                            <td>
                                                @if($penduduk->status_keluarga == 'Kepala Keluarga')
                                                    <span class="badge bg-primary">{{ $penduduk->status_keluarga }}</span>
                                                @else
                                                    {{ $penduduk->status_keluarga }}
                                                @endif
                                            </td>
                                            <td>
                                                @if($penduduk->jenis_kelamin == 'L')
                                                    <i class="fas fa-mars text-primary"></i> L
                                                @else
                                                    <i class="fas fa-venus text-danger"></i> P
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->format('d/m/Y') }}</td>
                                            <td>{{ $penduduk->pekerjaan ?: '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->age }} th</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
