@extends('components.theme.back')

@section('container')
  <div class="page-header d-print-none">
    <div class="container-xl">
      <div class="row g-2 align-items-center">
        <div class="col">
          <h2 class="page-title">Manajemen Pengguna</h2>
          <div class="page-pretitle">Daftar semua pengguna agen PMB</div>
        </div>
        <div class="col-auto ms-auto d-print-none">
          @can('user_create')
            <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
              <i class="ti ti-plus"></i>
              Tambah Pengguna
            </a>
          @endcan
        </div>
      </div>
    </div>
  </div>

  <div class="page-body">
    <div class="container-xl">
      <div class="card">
        <div class="card-body">
          <!-- Filter Form -->
          <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
              <input type="text" name="cari" class="form-control" placeholder="Cari nama, email, username..."
                value="{{ request('cari') }}">
            </div>
            <div class="col-md-3">
              <select name="role" class="form-select">
                <option value="">Semua Role</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                    {{ ucfirst($role->name) }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3">
              <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
              </select>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
          </form>

          <!-- Users Table -->
          <div class="table-responsive">
            <table class="table table-vcenter table-bordered table-striped">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Terakhir Login</th>
                  <th class="text-center">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($pengguna as $user)
                  <tr>
                    <td>
                      <div class="d-flex align-items-center">
                        <span class="avatar avatar-sm me-2"
                          style="background-image: url({{ $user->avatar ? env('URL_ASSET_SIAKAD') . '/' . Auth::user()->avatar : asset('img/default.png') }})">
                        </span>
                        {{-- src="{{ Auth::user()->avatar ? env('URL_CDN_SIAKAD') . '/' . Auth::user()->avatar : asset('img/default.png') }}" --}}
                        {{ $user->name }}
                      </div>
                    </td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->username }}</td>
                    <td>
                      <span class="badge bg-primary">{{ $user->getRoleNames()->first() }}</span>
                    </td>
                    <td>
                      <span class="badge {{ $user->status == 'active' ? 'bg-success' : 'bg-danger' }}">
                        {{ $user->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                      </span>
                    </td>
                    <td>{{ $user->last_logged_in ? $user->last_logged_in->format('d/m/Y H:i') : 'Belum pernah' }}</td>
                    <td class="text-center">
                      <div class="btn-list justify-content-center">
                        <a href="{{ route('pengguna.show', $user) }}" class="btn btn-sm btn-info" title="Detail">
                          <i class="ti ti-eye"></i>
                        </a>
                        @can('user_edit')
                          <a href="{{ route('pengguna.edit', $user) }}" class="btn btn-sm btn-warning" title="Edit">
                            <i class="ti ti-edit"></i>
                          </a>
                        @endcan
                        @can('user_delete')
                          @if (!$user->hasRole('superadmin') && $user->user_id != auth()->id())
                            <form action="{{ route('pengguna.destroy', $user) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Hapus pengguna ini?')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                <i class="ti ti-trash"></i>
                              </button>
                            </form>
                          @endif
                        @endcan
                      </div>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="7" class="text-center text-muted">Tidak ada data pengguna</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="mt-4">
            {{ $pengguna->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
