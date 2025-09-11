@extends('sistem.konfig.index')

@section('konfig')
  <div class="card-body">
    <div class="row">
      <div class="col-md-12">
        {{-- Card Cadangkan --}}
        <div class="row">
          <div class="col-md-7">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-tools mr-2"></i>Konfigurasi & Spesifikasi</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-hover table-sm table-bordered" id="specs-table">
                    <tbody>
                      <tr>
                        <th scope="row">Web Server</th>
                        <td><span id="web_server">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">PHP Version</th>
                        <td><span id="php_version">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">MySQL Version</th>
                        <td><span id="db_version">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">Laravel Version</th>
                        <td><span id="laravel_version">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">Upload Max Filesize</th>
                        <td><span id="upload_max_filesize">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">Post Max Size</th>
                        <td><span id="post_max_size">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">Database Size</th>
                        <td><span id="db_size">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">Total Tables</th>
                        <td><span id="total_tables">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">Total Rows</th>
                        <td><span id="total_rows">Memuat..</span></td>
                      </tr>
                      <tr>
                        <th scope="row">Total Relations</th>
                        <td><span id="relations_count">Memuat..</span></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <button class="btn btn-primary float-right mt-2" id="backup-btn">
                  <i class="fas fa-download mr-2"></i>Cadangkan
                </button>
              </div>

            </div>
          </div>

          {{-- Card Pulihkan  --}}
          <div class="col-md-5">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-database mr-2"></i>Pemulihan Basis Data</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <form id="restore-form" method="POST" action="{{ route('konfig.restore') }}"
                  enctype="multipart/form-data">
                  @csrf
                  <div class="form-group">
                    <label for="backup_file">Unggah SQL</label>
                    <input type="file" name="backup_file" id="backup_file"
                      class="form-control @error('backup_file') is-invalid @enderror" required>

                    {{-- Tampilkan error jika ada --}}
                    @error('backup_file')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-success float-right mt-3">
                    <i class="fas fa-cloud-arrow-up mr-2"></i>Pulihkan
                  </button>
                </form>
              </div>

            </div>
          </div>
        </div>

        {{-- Card Daftar Backup  --}}
        <div class="card mt-3">
          <div class="card-header">
            <h3 class="card-title"><i class="fas fa-bars-progress mr-2"></i>Cadangan Basis Data</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered table-sm">
                <thead>
                  <tr class="text-center">
                    <th>No.</th>
                    <th class="text-left">Nama Berkas</th>
                    <th>Ukuran</th>
                    <th>Dibuat</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($backups as $backup)
                    <tr>
                      <td class="text-center">{{ $backup['no'] }}</td>
                      <td>{{ $backup['name'] }}</td>
                      <td class="text-center text-nowrap">{{ $backup['size'] }}</td>
                      <td class="text-center">{{ $backup['created_at_readable'] }}</td>
                      <td class="text-center">{{ $backup['created_at'] }}</td>
                      <td class="text-center text-nowrap">
                        <a href="{{ $backup['download_url'] }}" class="btn btn-sm btn-default mr-1"
                          onclick="return confirm('Unduh berkas cadangan ini?')">Unduh</a>
                        <form action="{{ $backup['delete_url'] }}" method="POST" style="display:inline-block;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-default text-danger"
                            onclick="return confirm('Hapus berkas ini?')">Hapus</button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="5" class="text-center">Tidak ada file backup ditemukan</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

@section('js_bawah')
  <script>
    // Load Specs
    fetch('{{ route('konfig.specs') }}')
      .then(response => response.json())
      .then(data => {
        document.getElementById('db_version').textContent = data.db_version;
        document.getElementById('php_version').textContent = data.php_version;
        document.getElementById('web_server').textContent = data.web_server;
        document.getElementById('laravel_version').textContent = data.laravel_version;
        document.getElementById('db_size').textContent = data.db_size;
        document.getElementById('total_tables').textContent = data.total_tables;
        document.getElementById('total_rows').textContent = data.total_rows;
        document.getElementById('relations_count').textContent = data.relations_count;
        document.getElementById('upload_max_filesize').textContent = data.upload_max_filesize;
        document.getElementById('post_max_size').textContent = data.post_max_size;
      });

    // Event listener untuk tombol backup
    document.getElementById('backup-btn').addEventListener('click', function(event) {
      // Tampilkan konfirmasi kepada pengguna sebelum memulai backup
      const userConfirmed = confirm('Lakukan proses cadangan dan unduh berkasnya?');
      if (!userConfirmed) {
        event.preventDefault(); // Batalkan proses jika user menolak
        return;
      }

      // Kirim permintaan POST ke endpoint backup
      fetch('{{ route('konfig.backup') }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Sertakan token CSRF untuk keamanan
          }
        })
        .then(response => response.json()) // Ambil respons dalam format JSON
        .then(data => {
          if (data.success) {
            // Redirect browser ke URL unduhan
            window.location.href = data.download_url;
          } else {
            // Tampilkan pesan error jika backup gagal
            alert('Proses cadangan gagal: ' + data.error);
          }
        })
        .catch(err => {
          // Tampilkan pesan error jika ada masalah dengan request
          alert('Terjadi kesalahan saat memproses cadangan: ' + err.message);
        });
    });
  </script>
@endsection
