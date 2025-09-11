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
          <h3 class="text-center my-4">Mahasiswa Aktif (Beda Database)</h3>
          <hr>
        </div>
        <div class="card border-0 shadow-sm rounded">
          <div class="card-body">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Prodi</th>
                  <th>SKS</th>
                  <th>Status</th>
                  {{-- <th>No. Hp</th> --}}
                  {{-- <th>Aksi</th> --}}
                </tr>
                {{-- ->select('transaknonkad.id','transaknonkad.id_non','transaknonkad.id_peserta', 'mahasiswa.NAMA', 'non_akademiks.kegiatan', 'non_akademiks.kegiatan')
            ->get(); --}}
              </thead>
              <tbody>
                @foreach ($mahasiswa as $s)
                  <tr>
                    <td>{{ $s->ID }}</td>
                    <td>{{ $s->NAMA }}</td>
                    <td>{{ $s->IDPRODI }}</td>
                    <td>{{ $s->SKS }}</td>
                    <td>{{ $s->STATUS }}</td>
                    <td>
                      <a href="/transaknonakademiks/view/{{ $s->ID }}" class="btn btn-warning btn-sm"><i
                          class="fa fa-pencil"> view</i></a>
                      <a href="/transaknonakademiks/edit/{{ $s->ID }}"
                        onclick="return confirm('Data tidak bisa di Edit');" class="btn btn-danger btn-sm"><i
                          class="fa fa-trash">edit</i></a>
                    </td>
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
