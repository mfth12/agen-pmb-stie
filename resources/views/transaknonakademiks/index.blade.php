<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data nonakademiks - Sinkad-stiepembangunan.ac.id</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Data Kegiatan Non Akademik</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <!-- <a href="{{ route('nonakademiks.create') }}" class="btn btn-md btn-success mb-3">Add Kegiatan</a> -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Kode Kegiatan</th>
                                    <th>Nim</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>Nama Kegiatan</th>
                                    {{-- <th>No. Hp</th> --}}
                                    {{-- <th>Aksi</th> --}}
                                  </tr>
                                  {{-- ->select('transaknonkad.id','transaknonkad.id_non','transaknonkad.id_peserta', 'mahasiswa.NAMA', 'non_akademiks.kegiatan', 'non_akademiks.kegiatan')
            ->get(); --}}
                            </thead>
                            <tbody>
                                @foreach($peserta as $s) 
                                <tr>
                                  <td>{{$s->id}}</td>
                                  <td>{{$s->id_non}}</td>
                                  <td>{{$s->id_peserta}}</td>
                                  <td>{{$s->NAMA}}</td>
                                  <td>{{$s->kegiatan}}</td>
                                
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

</body>
</html>