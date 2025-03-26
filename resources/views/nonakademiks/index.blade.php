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
                        <a href="{{ route('nonakademiks.create') }}" class="btn btn-md btn-success mb-3">Add Kegiatan</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">JUDUL</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">TA</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Brosur</th>
                                    <th scope="col">BIAYA</th>
                                    <th scope="col" AKSI="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nonakademiks as $nonakademik)
                                    <tr>
                                        <td>{{ $nonakademik->id }}</td>
                                        <td>{{ $nonakademik->kegiatan }}</td>
                                        <td>{{ $nonakademik->kategori }}</td>
                                        <td>{{ $nonakademik->ta }}</td>
                                        <td>{{ $nonakademik->tglmulai }}</td>
                                            {{-- storage/app/public/image --}}
                                        <td class="text-center">
                                            <img src="{{ asset('storage/brosurs/'.$nonakademik->brosur) }}" class="rounded" style="width: 150px">
                                        </td>
                                        {{-- <td>{{ $nonakademik->semester }}</td> --}}

                                        <td>{{ number_format($nonakademik->biaya,0,',','.') }}</td>

                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('nonakademiks.destroy', $nonakademik->id) }}" method="POST">
                                                <a href="{{ route('nonakademiks.show', $nonakademik->id) }}" class="btn btn-sm btn-dark">Show</a>
                                                <a href="{{ route('nonakademiks.edit', $nonakademik->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data nonakademiks belum Tersedia.
                                    </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $nonakademiks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        //message with sweetalert
        @if(session('success'))
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif(session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

    </script>

</body>
</html>