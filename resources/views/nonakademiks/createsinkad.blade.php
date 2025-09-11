<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add Kegiatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background: lightgray">

  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded">
          <div class="card-body">
            <form action="{{ route('nonakademiks.store') }}" method="POST" enctype="multipart/form-data">

              @csrf

              <div class="form-group mb-3">
                <label class="font-weight-bold">KEGIATAN</label>
                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan"
                  value="{{ old('kegiatan') }}" placeholder="">

                @error('kegiatan')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                @enderror
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group mb-3">
                    <label class="font-weight-bold">KATEGORI</label>
                    <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori"
                      value="{{ old('kategori') }}" placeholder="">

                    <!-- error message untuk title -->
                    @error('kegiatan')
                      <div class="alert alert-danger mt-2">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>

                  <div class="col-md-6">
                    <div class="form-group mb-3">
                      <label class="font-weight-bold">TA</label>
                      <input type="text" class="form-control @error('ta') is-invalid @enderror" name="ta"
                        value="{{ old('ta') }}" placeholder="">

                      <!-- error message untuk description -->
                      @error('ta')
                        <div class="alert alert-danger mt-2">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="font-weight-bold">BROSUR</label>
                        <input type="file" class="form-control @error('brosur') is-invalid @enderror" name="brosur">

                        <!-- error message untuk image -->
                        @error('brosur')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group mb-3">
                        <label class="font-weight-bold">BIAYA</label>
                        <input type="number" class="form-control @error('biaya') is-invalid @enderror" name="biaya"
                          value="{{ old('biaya') }}" placeholder="">

                        <!-- error message untuk stock -->
                        @error('biaya')
                          <div class="alert alert-danger mt-2">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    </div>
                  </div>

                  <button type="submit" class="btn btn-md btn-primary me-3">SAVE</button>
                  <button type="reset" class="btn btn-md btn-warning">RESET</button>

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
