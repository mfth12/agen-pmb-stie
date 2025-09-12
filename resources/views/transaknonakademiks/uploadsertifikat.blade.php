<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Upload Sertifikat Internal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">
  <h6> UPLOAD SERTIFIKAT </h6>
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded">
          <div class="card-body">
            // POST before
            <form action="{{ route('uploadsertifikat') }}" method="POST" enctype="multipart/form-data">

              @csrf
              <div class="form-group mb-3">

                //kolom nim otomatis terisi dari login
                // tambahkan juga kolom nama mahasiswawanya

                <label class="font-weight-bold">NIM</label>
                <input type="text" class="form-control @error('id_peserta') is-invalid @enderror" name="id_peserta"
                  value="{{ old('id_peserta') }}" placeholder="">

                <!-- error message untuk title -->
                @error('id_peserta')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group mb-3">
                <label class="font-weight-bold">Judul di Sertifikat</label>
                <input type="text" class="form-control @error('id_non') is-invalid @enderror" name="id_non"
                  value="{{ old('id_non') }}" placeholder="">

                @error('id_non')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              {{-- //perlu tambahkan field/kolom: kategori,biaya,narsum,id_penyelenggara,skpi --}}
              Prasyarat untuk: <input type="text" name="kategori" value="" placeholder="">
              TA: <input type="text" name="ta" value="" placeholder="24251">
              Tanggal: <input type="date" name="tgl" value="" placeholder="">
              SKPI: <input type="text" name="skpi" value="" placeholder="ya/tdk">

              <div class="form-group mb-3">
                <label class="font-weight-bold">Penyelenggara</label>
                <input type="text" class="form-control @error('nilai') is-invalid @enderror" name="nilai"
                  value="{{ old('nilai') }}" placeholder="">

                <!-- error message untuk description -->
                @error('nilai')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="form-group mb-3">
                <label class="font-weight-bold">Status Validasi</label>
                <input type="text" class="form-control @error('lulus') is-invalid @enderror" name="lulus"
                  value="{{ old('lulus') }}" placeholder="">

                <!-- error message untuk description -->
                @error('lulus')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="font-weight-bold">No. Sertifikat</label>
                    <input type="number" class="form-control @error('no_sertifikat') is-invalid @enderror"
                      name="no_sertifikat" value="" placeholder="">

                    <!-- error message untuk stock -->
                    @error('no_sertifikat')
                      <div class="alert alert-danger mt-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="font-weight-bold">Upload Sertifikat</label>
                    <input type="file" class="form-control @error('file_sertifikat') is-invalid @enderror"
                      name="file_sertifikat">

                    <!-- error message untuk image -->
                    @error('file_sertifikat')
                      <div class="alert alert-danger mt-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>


              </div>
              {{-- //kolom tabel masih ragu: kategori,biaya,narsum,id_penyelenggara,skpi --}}

              <button type="submit" class="btn btn-md btn-primary me-3">save</button>
              <button type="reset" class="btn btn-md btn-warning">reset</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
    // CKEDITOR.replace( 'description' );
  </script>
</body>

</html>
