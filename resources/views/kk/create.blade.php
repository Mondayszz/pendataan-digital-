<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tambah KK Baru</title>
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
        .form-floating > label {
            padding: 1rem 0.75rem;
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
            <a class="navbar-brand" href="{{ route('kk.index') }}">
                <i class="fas fa-users"></i> Sistem Pendataan Penduduk Desa
            </a>
            <a href="{{ route('kk.index') }}" class="btn btn-outline-light btn-sm">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="h4 mb-0"><i class="fas fa-home"></i> Tambah KK Baru</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('kk.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="kepala_keluarga" class="form-label"><i class="fas fa-user"></i> Kepala Keluarga *</label>
                                <input type="text" class="form-control @error('kepala_keluarga') is-invalid @enderror" id="kepala_keluarga" name="kepala_keluarga" value="{{ old('kepala_keluarga') }}" required>
                                @error('kepala_keluarga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat" class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap *</label>
                                <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jaga" class="form-label"><i class="fas fa-map"></i> Wilayah Jaga</label>
                                <select class="form-select" id="jaga" name="jaga">
                                    <option value="">Tidak ada</option>
                                    <option value="1" {{ old('jaga') == '1' ? 'selected' : '' }}>Jaga 1</option>
                                    <option value="2" {{ old('jaga') == '2' ? 'selected' : '' }}>Jaga 2</option>
                                </select>
                            </div>

                            <hr>
                            <h5 class="mb-3"><i class="fas fa-users"></i> Anggota Keluarga</h5>

                            <div id="family-members">
                                <div class="family-member border rounded p-3 mb-3">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-user"></i> Nama Anggota Keluarga *</label>
                                            <input type="text" class="form-control" name="anggota[0][nama]" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-id-card"></i> NIK</label>
                                            <input type="text" class="form-control" name="anggota[0][nik]" minlength="10" maxlength="20">
                                            <small class="text-muted">Opsional. Minimal 10 digit, maksimal 20 digit</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-users"></i> Status dalam Keluarga *</label>
                                            <select class="form-select" name="anggota[0][status_keluarga]" required>
                                                <option value="">Pilih Status</option>
                                                <option value="Kepala Keluarga">Kepala Keluarga</option>
                                                <option value="Suami">Suami</option>
                                                <option value="Istri">Istri</option>
                                                <option value="Anak">Anak</option>
                                                <option value="Menantu">Menantu</option>
                                                <option value="Cucu">Cucu</option>
                                                <option value="Orang Tua">Orang Tua</option>
                                                <option value="Mertua">Mertua</option>
                                                <option value="Famili Lain">Famili Lain</option>
                                                <option value="Pembantu">Pembantu</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-ring"></i> Status Perkawinan</label>
                                            <input type="text" class="form-control" name="anggota[0][status_perkawinan]">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-venus-mars"></i> Jenis Kelamin *</label>
                                            <select class="form-select" name="anggota[0][jenis_kelamin]" required>
                                                <option value="">Pilih Jenis Kelamin</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-birthday-cake"></i> Tanggal Lahir *</label>
                                            <input type="date" class="form-control" name="anggota[0][tanggal_lahir]" required>
                                            <small class="text-muted">Umur: <span class="age-display">-</span> th</small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-graduation-cap"></i> Pendidikan</label>
                                            <input type="text" class="form-control" name="anggota[0][pendidikan]">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label"><i class="fas fa-briefcase"></i> Pekerjaan</label>
                                            <input type="text" class="form-control" name="anggota[0][pekerjaan]">
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm remove-member" style="display: none;">
                                        <i class="fas fa-trash"></i> Hapus Anggota
                                    </button>
                                </div>
                            </div>

                            <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="add-member">
                                <i class="fas fa-plus"></i> Tambah Anggota Keluarga
                            </button>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('kk.index') }}" class="btn btn-outline-secondary btn-custom me-md-2">
                                    <i class="fas fa-times"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success btn-custom">
                                    <i class="fas fa-save"></i> Simpan Data
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
        let memberCount = 1;

        function calcAgeFromDateStr(value) {
            if (!value) return '';
            const b = new Date(value);
            if (isNaN(b.getTime())) return '';
            const today = new Date();
            let age = today.getFullYear() - b.getFullYear();
            const m = today.getMonth() - b.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < b.getDate())) age--;
            return age < 0 ? 0 : age;
        }

        function wireAgeCalculator(memberEl) {
            const dateInput = memberEl.querySelector('input[type="date"][name*="[tanggal_lahir]"]');
            const ageSpan = memberEl.querySelector('.age-display');
            if (!dateInput || !ageSpan) return;
            const update = () => {
                const age = calcAgeFromDateStr(dateInput.value);
                ageSpan.textContent = age === '' ? '-' : age;
            };
            dateInput.addEventListener('input', update);
            update();
        }

        document.getElementById('add-member').addEventListener('click', function() {
            const container = document.getElementById('family-members');
            const newMember = document.querySelector('.family-member').cloneNode(true);

            // Update input names
            const inputs = newMember.querySelectorAll('input, select');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace('[0]', '[' + memberCount + ']'));
                    input.value = ''; // Clear values
                }
            });

            // Show remove button
            newMember.querySelector('.remove-member').style.display = 'block';

            container.appendChild(newMember);
            wireAgeCalculator(newMember);
            memberCount++;
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-member')) {
                e.target.closest('.family-member').remove();
            }
        });

        // Init for the first member block
        document.querySelectorAll('.family-member').forEach(wireAgeCalculator);
    </script>
</body>
</html>
