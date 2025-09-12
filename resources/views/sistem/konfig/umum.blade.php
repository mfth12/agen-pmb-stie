@extends('sistem.konfig.index')

@section('konfig')
  <div class="card-body">
    <div class="tab-content">
      <form enctype="multipart/form-data" action="/konfig/store_umum/{{ $konfigs->konfig_id }}" method="POST"
        name="konfig_umum">
        @csrf
        <div class="row">
          <div class="col-md-8">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><i class="fas fa-building-columns mr-2"></i>Lembaga</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                {{-- @method('post') --}}
                <input type="hidden" name="konfig_id" value="{{ $konfigs->konfig_id }}">
                <div class="form-group row">
                  <label for="NAMA_SISTEM" class="col-sm-4 col-form-label">Nama Sistem</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control @error('NAMA_SISTEM') is-invalid @enderror" id="NAMA_SISTEM"
                      name="NAMA_SISTEM" value="{{ old('NAMA_SISTEM', konfigs('NAMA_SISTEM')) }}"
                      placeholder="{{ konfigs('NAMA_SISTEM') }}">
                    @error('NAMA_SISTEM')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="unik" class="col-sm-4 col-form-label">Nama
                    Unik</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control @error('unik') is-invalid @enderror" id="unik"
                      name="unik" value="{{ old('unik', $konfigs->unik) }}" placeholder="{{ $konfigs->unik }}">
                    @error('unik')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="nama_lembaga" class="col-sm-4 col-form-label">Nama Lembaga</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control @error('nama_lembaga') is-invalid @enderror"
                      id="nama_lembaga" name="nama_lembaga" value="{{ old('nama_lembaga', $konfigs->nama_lembaga) }}"
                      placeholder="{{ $konfigs->nama_lembaga }}">
                    @error('nama_lembaga')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="alamat_lembaga" class="col-sm-4 col-form-label">Alamat</label>
                  <div class="col-sm-8">
                    <textarea class="form-control @error('alamat_lembaga') is-invalid @enderror" id="alamat_lembaga" name="alamat_lembaga"
                      rows="4" placeholder="{{ $konfigs->alamat_lembaga }}">{{ old('alamat_lembaga', $konfigs->alamat_lembaga) }}</textarea>
                    @error('alamat_lembaga')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="email_resmi" class="col-sm-4 col-form-label">Email Resmi</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control @error('email_resmi') is-invalid @enderror"
                      value="{{ old('email_resmi', $konfigs->email_resmi) }}" id="email_resmi" name="email_resmi"
                      placeholder="{{ $konfigs->email_resmi }}">
                    @error('email_resmi')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group row">
                  <label for="website_resmi" class="col-sm-4 col-form-label">Website Resmi</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control @error('website_resmi') is-invalid @enderror"
                      value="{{ old('website_resmi', $konfigs->website_resmi) }}" id="website_resmi" name="website_resmi"
                      placeholder="{{ $konfigs->website_resmi }}">
                    @error('website_resmi')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="no_telp" class="col-sm-4 col-form-label">No
                    Telp / Whatsapp</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control @error('no_telp') is-invalid @enderror"
                      value="{{ old('no_telp', $konfigs->no_telp) }}" id="no_telp" name="no_telp"
                      placeholder="{{ $konfigs->no_telp }}">
                    @error('no_telp')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                    @enderror
                  </div>
                </div>
              </div>


              <div class="card-footer">
                <button type="submit" class="btn btn-primary float-right" id="simpan_umum">Simpan <i
                    class="fa-solid fa-floppy-disk ml-1"></i></button>
              </div>
            </div>
          </div>


          {{-- AKSES::SUPERADMIN --}}
          {{-- AKSES::SUPERADMIN --}}
          @can('akses_superadmin', 'akses_manager')
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fas fa-bookmark mr-2"></i>Logo dan favicon</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row d-flex">
                    <div class="col-md-6 mr-auto p-1">
                      <label for="logo_lembaga" class="form-label">Logo Lembaga:</label>
                      @if ($konfigs->logo_lembaga != null)
                        <input type="hidden" name="logoOld" value="{{ old('logo_lembaga', $konfigs->logo_lembaga) }}">
                        <img src="{{ old('logo_lembaga', asset('img/' . $konfigs->logo_lembaga)) }}"
                          class="logo-lihat frame-gambar img-fluid mb-3">
                        <a class="btn btn-md btn-outline-secondary mb-2" style="display:block"
                          onclick="document.getElementById('logo_lembaga').click()">Pilih
                          <i class="fa-solid fa-image ml-1"></i></a>
                      @else
                        <img class="logo-lihat frame-gambar img-fluid mb-3 ">
                        <a class="btn btn-md btn-outline-secondary mb-2" style="display:block"
                          onclick="document.getElementById('logo_lembaga').click()">Upload
                          <i class="fa-solid fa-circle-arrow-up ml-1"></i></a>
                      @endif

                      <input class="form-control @error('logo_lembaga') is-invalid @enderror" type="file"
                        id="logo_lembaga" name="logo_lembaga" style="display:none" onchange="lihatLogo()">
                      @error('logo_lembaga')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="col-md-6 p-1">
                      <label for="ikon" class="form-label">Favicon:</label>
                      @if ($konfigs->ikon != null)
                        <input type="hidden" name="ikonOld" value="{{ old('ikon', $konfigs->ikon) }}">
                        <img src="{{ old('ikon', asset('img/' . $konfigs->ikon)) }}"
                          class="ikon-lihat frame-gambar img-fluid mb-3">
                        <a class="btn btn-md btn-outline-secondary mb-2" style="display:block"
                          onclick="document.getElementById('ikon').click()">Pilih
                          <i class="fa-solid fa-image ml-1"></i></a>
                      @else
                        <img class="ikon-lihat frame-gambar img-fluid mb-3 ">
                        <a class="btn btn-md btn-outline-secondary mb-2" style="display:block"
                          onclick="document.getElementById('ikon').click()">Upload
                          <i class="fa-solid fa-circle-arrow-up ml-1"></i></a>
                      @endif

                      <input class="form-control @error('ikon') is-invalid @enderror" type="file" id="ikon"
                        name="ikon" style="display:none" onchange="lihatIkon()">
                      @error('ikon')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endcan

        </div>
      </form>
    </div>
  </div>
@endsection

@section('js_atas')
  {{-- kosong --}}
@endsection

@section('js_bawah')
  {{-- JAVASCRIPT --}}
  <script>
    //CSRF TOKEN PADA HEADER
    //Script ini wajib krn kita butuh csrf token setiap kali mengirim request post, patch, put dan delete ke server
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    });
  </script>
@endsection
