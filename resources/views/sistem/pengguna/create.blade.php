@extends('components.theme.back')

@section('container')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">Tambah Pengguna Baru</h2>
          <div class="page-pretitle">Tambah pengguna baru ke sistem</div>
        </div>
        <div class="col-auto">
          <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i>
            Kembali
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-body">
              <form action="{{ route('pengguna.store') }}" method="POST">
                @csrf

                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Nama Lengkap *</label>
                      <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                        value="{{ old('nama') }}" required>
                      @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Email *</label>
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required>
                      @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Username *</label>
                      <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        value="{{ old('username') }}" required>
                      @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Nomor HP *</label>
                      <input type="text" name="nomor_hp" class="form-control @error('nomor_hp') is-invalid @enderror"
                        value="{{ old('nomor_hp') }}" required>
                      @error('nomor_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Role *</label>
                      <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $role)
                          <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                            {{ ucfirst($role->name) }}
                          </option>
                        @endforeach
                      </select>
                      @error('role')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Status</label>
                      <select name="status" class="form-select">
                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Password *</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        required>
                      @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label class="form-label">Konfirmasi Password *</label>
                      <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                  </div>
                </div>

                <div class="mt-4">
                  <button type="submit" class="btn btn-primary">Simpan Pengguna</button>
                  <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Batal</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
