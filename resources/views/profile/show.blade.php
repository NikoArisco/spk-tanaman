@extends('adminlte::page')

@section('title', 'Profil Saya')

@section('content_header')
    <h1>Profil Saya</h1>
@stop

@section('content')
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="row">
        <div class="col-md-4">
            <!-- Profile Card -->
            <div class="card card-primary card-outline">
                <div class="card-body box-profile text-center">
                    <div class="text-center mb-3">
                        <img class="profile-user-img img-fluid img-circle"
                             src="https://ui-avatars.com/api/?name={{ urlencode($user->nama) }}&background=28a745&color=fff&size=128"
                             alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $user->nama }}</h3>
                    <p class="text-muted text-center">{{ '@' . $user->username }}</p>

                    <ul class="list-group list-group-unbordered mb-3">
                        <li class="list-group-item">
                            <b>Peran System:</b> <a class="float-right badge {{ $user->peran == 'Admin' ? 'bg-danger' : 'bg-success' }}">{{ $user->peran }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>Terdaftar Sejak:</b> <a class="float-right text-muted">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</a>
                        </li>
                    </ul>

                    <form action="{{ route('logout') }}" method="POST" class="mt-3">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-block" onclick="return confirm('Anda yakin ingin keluar dari sistem?')">
                            <i class="fas fa-sign-out-alt mr-1"></i> Keluar / Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-user-edit mr-1"></i> Perbarui Profil & Keamanan</h3>
                </div>
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <h5 class="text-success"><i class="fas fa-id-card mr-1"></i> Informasi Pengguna</h5>
                        <hr>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                   value="{{ old('nama', $user->nama) }}" required>
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror"
                                   value="{{ old('username', $user->username) }}" required>
                            @error('username')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <h5 class="text-danger mt-4"><i class="fas fa-lock mr-1"></i> Ubah Password (Opsional)</h5>
                        <p class="text-muted small">Biarkan kosong jika Anda tidak ingin mengubah password.</p>
                        <hr>

                        <div class="form-group">
                            <label for="current_password">Password Saat Ini</label>
                            <input type="password" name="current_password" id="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   placeholder="Masukkan password saat ini jika mau ganti password">
                            @error('current_password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password Baru</label>
                                    <input type="password" name="password" id="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Minimal 8 karakter">
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                           class="form-control" placeholder="Ulangi password baru">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
