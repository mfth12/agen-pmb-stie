<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit data Non AKademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('nonakademiks.update', $nonakademik->id) }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Brosur</label>
                                <input type="file" class="form-control @error('brosur') is-invalid @enderror" name="brosur" >
                            
                                <!-- error message untuk image -->
                                @error('brosur')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-bold">Kegiatan</label>
                                {{-- <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan" value="{{ old('kegiatan') }}" placeholder=""> --}}
                                <input type="text" class="form-control @error('kegiatan') is-invalid @enderror" name="kegiatan" value="{{ old('kegiatan', $nonakademik->kegiatan) }}" placeholder="">
                                @error('kegiatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                         <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                     <label class="font-weight-bold">Kategori</label>
                                     <input type="text" class="form-control @error('kategori') is-invalid @enderror" name="kategori" value="{{ old('kategori', $nonakademik->kategori) }}" placeholder="">
                                    <!-- error message untuk title -->
                                 @error('kegiatan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                 </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                   <label class="font-weight-bold">Tahun Akademik</label>
                               
                                   <input type="text" class="form-control @error('ta') is-invalid @enderror" name="ta" value="{{ old('ta', $nonakademik->ta) }}" placeholder="">
                                   <!-- error message untuk description -->
                                   @error('ta')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                     </div>
                                    @enderror
                                </div>
                            </div>   
                        </div>

                            <div class="row">
                                
                                <div class="col-md-3">
                                    <div class="form-group mb-3">
                                        <label class="font-weight-bold">Biaya</label>
                                       
                                        <input type="text" class="form-control @error('biaya') is-invalid @enderror" name="biaya" value="{{ old('biaya', $nonakademik->biaya) }}" placeholder="">
                                        <!-- error message untuk stock -->
                                        @error('biaya')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-md btn-primary me-3">Update</button>
                            <button type="reset" class="btn btn-md btn-warning">Reset</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'description' );
    </script>
</body>
</html>