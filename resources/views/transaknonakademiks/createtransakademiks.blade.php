<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Kegiatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('transaknonakademiks.store') }}" method="POST" enctype="multipart/form-data" >
                        
                            @csrf

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Kode Kegiatan</label>
                                {{-- <input type="text" class="form-control @error('id_non') is-invalid @enderror" name="id_non" value="{{$peserta[0]->kegiatan }}" placeholder=""> --}}
                                <select class="form-select" aria-label="Default select example">
                                    <option selected>-- Pilih --</option>
                                    @foreach($peserta as $s)
                                      <option value="{{$s->id}}">{{$s->kegiatan}}</option>
                                    @endforeach
                                </select>
                            
                                @error('id_non')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            <div class="form-group mb-3">

                                //kolom nim otomatis terisi dari login
                                // tambahkan juga kolom nama mahasiswawanya
                                
                                <label class="font-weight-bold">NIM</label>
                                <input type="text" class="form-control @error('id_peserta') is-invalid @enderror" name="id_peserta" value="{{ old('id_peserta') }}" placeholder="">
                            
                                <!-- error message untuk title -->
                                @error('id_peserta')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Kode Bayar</label>
                                <input type="text" class="form-control @error('kode_bayar') is-invalid @enderror" name="kode_bayar" value="{{ old('kode_bayar') }}" placeholder="">
                            
                                <!-- error message untuk description -->
                                @error('kode_bayar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Status Bayar</label>
                                <input type="text" class="form-control @error('status_bayar') is-invalid @enderror" name="status_bayar" value="{{ old('status_bayar') }}" placeholder="">
                            
                                <!-- error message untuk description -->
                                @error('status_bayar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
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