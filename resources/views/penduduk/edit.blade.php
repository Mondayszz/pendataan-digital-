<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Data Penduduk</title>
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
            .btn-custom {
                padding: 8px 16px;
                font-size: 0.875rem;
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
        }
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1rem;
            }
            .card-header h1 {
                font-size: 1.25rem;
            }
            .form-label {
                font-size: 0.875rem;
            }
            .form-control, .form-select {
                font-size: 0.875rem;
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
                        <h1 class="h4 mb-0"><i class="fas fa-edit"></i> Edit Data Penduduk</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('penduduk.update', $penduduk->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="nama" class="form-label"><i class="fas fa-user"></i> Nama Lengkap *</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $penduduk->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="nik" class="form-label"><i class="fas fa-id-card"></i> NIK *</label>
                                    <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $penduduk->nik) }}" required maxlength="16" pattern="[0-9]{16}">
                                    @error('nik')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tanggal_lahir" class="form-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir *</label>
                                    <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir->format('Y-m-d')) }}" required>
                                    @error('tanggal_lahir')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="umur" class="form-label"><i class="fas fa-calendar-alt"></i> Umur</label>
                                    <input type="text" class="form-control" id="umur" name="umur" value="{{ $penduduk->umur ? $penduduk->umur . ' tahun' : '' }}" readonly placeholder="Otomatis terisi">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="jenis_kelamin" class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin *</label>
                                <select class="form-select @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="L" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ old('jenis_kelamin', $penduduk->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap *</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $penduduk->alamat) }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan" class="form-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="status_perkawinan" class="form-label"><i class="fas fa-ring"></i> Status Perkawinan</label>
                                    <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" value="{{ old('status_perkawinan', $penduduk->status_perkawinan) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="agama" class="form-label"><i class="fas fa-pray"></i> Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama" value="{{ old('agama', $penduduk->agama) }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="pendidikan" class="form-label"><i class="fas fa-graduation-cap"></i> Pendidikan</label>
                                    <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ old('pendidikan', $penduduk->pendidikan) }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="kk_id" class="form-label"><i class="fas fa-home"></i> Kartu Keluarga (KK)</label>
                                <select class="form-select" id="kk_id" name="kk_id">
                                    <option value="">Pilih KK</option>
                                    @foreach($kks as $kk)
                                        <option value="{{ $kk->id }}" {{ old('kk_id', $penduduk->kk_id) == $kk->id ? 'selected' : '' }}>
                                            {{ $kk->no_kk }} - {{ $kk->kepala_keluarga }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="status_keluarga" class="form-label"><i class="fas fa-users"></i> Status dalam Keluarga</label>
                                <select class="form-select" id="status_keluarga" name="status_keluarga">
                                    <option value="">Pilih Status</option>
                                    <option value="Kepala Keluarga" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                                    <option value="Istri" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Istri' ? 'selected' : '' }}>Istri</option>
                                    <option value="Anak" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Anak' ? 'selected' : '' }}>Anak</option>
                                    <option value="Menantu" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Menantu' ? 'selected' : '' }}>Menantu</option>
                                    <option value="Cucu" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Cucu' ? 'selected' : '' }}>Cucu</option>
                                    <option value="Orang Tua" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Orang Tua' ? 'selected' : '' }}>Orang Tua</option>
                                    <option value="Mertua" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Mertua' ? 'selected' : '' }}>Mertua</option>
                                    <option value="Famili Lain" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Famili Lain' ? 'selected' : '' }}>Famili Lain</option>
                                    <option value="Pembantu" {{ old('status_keluarga', $penduduk->status_keluarga) == 'Pembantu' ? 'selected' : '' }}>Pembantu</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="jaga" class="form-label"><i class="fas fa-map"></i> Wilayah Jaga</label>
                                <select class="form-select" id="jaga" name="jaga">
                                    <option value="" {{ old('jaga', $penduduk->jaga) == '' ? 'selected' : '' }}>Tidak ada</option>
                                    <option value="1" {{ old('jaga', $penduduk->jaga) == '1' ? 'selected' : '' }}>Jaga 1</option>
                                    <option value="2" {{ old('jaga', $penduduk->jaga) == '2' ? 'selected' : '' }}>Jaga 2</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('penduduk.show', $penduduk->id) }}" class="btn btn-outline-secondary btn-custom me-md-2">
                                    <i class="fas fa-eye"></i> Lihat Detail
                                </a>
                                <a href="{{ route('penduduk.index') }}" class="btn btn-outline-secondary btn-custom me-md-2">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success btn-custom">
                                    <i class="fas fa-save"></i> Update Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('tanggal_lahir').addEventListener('change', function() {
            const tanggalLahir = new Date(this.value);
            const today = new Date();
            let umur = today.getFullYear() - tanggalLahir.getFullYear();
            const monthDiff = today.getMonth() - tanggalLahir.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < tanggalLahir.getDate())) {
                umur--;
            }

            document.getElementById('umur').value = umur > 0 ? umur + ' tahun' : '';
        });
    </script>
</body>
</html>
