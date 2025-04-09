<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Kegiatan Non Akademik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <img src="{{ asset('public/brosurs'.$nonakademik->brosur) }}" class="rounded" style="width: 100%">
                        {{-- <h2>{{ $nonakademik->kegiatan }}, NaraSumber: --}}
                            {{-- {{ $nonakademik->narsum }} --}}
                        {{-- </h2> --}}
                        <hr/>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                     
                        <h2>{{ $nonakademik->kegiatan }}, NaraSumber:
                            {{ $nonakademik->narsum }}
                        </h2>
                        <hr/>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <h3>SYARAT: {{ $nonakademik->kategori }}, SKPI:  {{ ($nonakademik->skpi == 1) ? 'Ya' : 'Tidak' }}
                            @php // dd($nonakademik->skpi); 
                            @endphp
                            {{-- @if ($nonakademik->skpi == 0) {iya}
                            else {tidak}
                             @endif --}}
                            </h3>
                        <hr/>
                        <p>TA : {{ $nonakademik->ta }}</p>
                        <code>
                            <p> Tanggal : {!! $nonakademik->tglmulai !!}</p>
                        </code>
                        <hr/>
                        <p>Biaya : {{number_format($nonakademik->biaya,0,',','.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>