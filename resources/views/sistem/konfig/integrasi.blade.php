@extends('sistem.konfig.index')

@section('konfig')
  <div class="card-body">
    <form enctype="multipart/form-data" action="/konfig/store_integrasi_wagateway/{{ $konfigs->konfig_id }}" method="POST"
      name="konfig_integrasi" id="konfig_integrasi">
      @csrf
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa-brands fa-whatsapp mr-2"></i>Whatsapp Gateway</h3>
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
                <label for="wa_endpoint" class="col-sm-4 col-form-label">Endpoint</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('wa_endpoint') is-invalid @enderror" id="wa_endpoint"
                    name="wa_endpoint" value="{{ old('wa_endpoint', $konfigs->wa_endpoint) }}"
                    placeholder="{{ $konfigs->wa_endpoint ?? 'Belum ada input' }}">
                  @error('wa_endpoint')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
              <div class="form-group row">
                <label for="wa_session" class="col-sm-4 col-form-label">Sesi</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('wa_session') is-invalid @enderror" id="wa_session"
                    name="wa_session" value="{{ old('wa_session', $konfigs->wa_session) }}"
                    placeholder="{{ $konfigs->wa_session ?? 'Belum ada input' }}">
                  @error('wa_session')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="no_test_wa" class="col-sm-4 col-form-label">No Whatsapp</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control @error('no_test_wa') is-invalid @enderror" id="no_test_wa"
                    name="no_test_wa" placeholder="Nomor target uji coba">
                  <div class="text-muted small mt-1">
                    Gunakan (62) tanpa tanda '+' untuk awal nomor Indonesia
                  </div>
                  @error('no_test_wa')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
              </div>
            </div>


            <div class="card-footer">
              <button type="submit" class="btn btn-primary float-right" id="simpan_umum">Simpan
                <i class="fa-solid fa-floppy-disk ml-1"></i></button>
              <button type="button" class="btn btn-secondary float-right mr-1" id="uji_coba_btn" disabled>Uji Coba
                <i class="fa-solid fa-paper-plane ml-1"></i></button>
            </div>
          </div>
        </div>
        {{-- akhir --}}
      </div>
    </form>
  </div>
@endsection

@section('js_atas')
  {{-- kosong --}}
@endsection

@section('js_bawah')
  {{-- JAVASCRIPT --}}
  <script>
    //CSRF TOKEN PADA HEADER
    //Script ini wajib krn kita butuh csrf token setiap kali mengirim 
    $(document).ready(function() {
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      // Function to validate phone number and toggle button
      function validatePhoneNumber() {
        var noTestWa = $('#no_test_wa').val();
        var isValid = /^\d{10,15}$/.test(noTestWa);

        $('#uji_coba_btn').prop('disabled', !isValid);
      }

      // Attach validation to input event
      $('#no_test_wa').on('input', function() {
        validatePhoneNumber();
      });

      // Event handler for the Uji Coba button
      $('#uji_coba_btn').on('click', function() {
        var noTestWa = $('#no_test_wa').val();
        var $ujiCobaBtn = $('#uji_coba_btn');

        if (noTestWa) {
          // Ubah teks tombol dan tambahkan kelas loading
          $ujiCobaBtn.prop('disabled', true).html('Mengirim <i class="fa-solid fa-spinner fa-spin ml-1"></i>');
          // Proses ajax
          $.ajax({
            url: "{{ route('konfig.test_wa') }}",
            data: JSON.stringify({
              target: noTestWa
            }),
            contentType: "application/json", // Tentukan content type JSON
            type: "POST",
            dataType: 'json',
            timeout: 10000, // Set timeout to 10 detik
            success: function(response) {
              console.log(response.message);
              if (response.message) {
                iziToast.error({
                  title: 'Galat:',
                  message: response.message, // Menampilkan pesan dari response JSON
                  position: 'topCenter',
                  timeout: 4000,
                });
              } else {
                iziToast.success({
                  title: 'Oke.',
                  message: response.data.message, // Menampilkan pesan dari response JSON
                  position: 'topCenter',
                  timeout: 4000,
                });
              }
            },
            error: function(xhr, status, error) {
              console.log(xhr.responseJSON);
              if (status == 'timeout') {
                iziToast.error({
                  title: 'Timeout',
                  message: 'Permintaan memakan waktu terlalu lama. Silakan coba lagi.',
                  position: 'topCenter',
                  timeout: 4000,
                });
              } else {
                iziToast.error({
                  title: 'Kode ' + (xhr.responseJSON ? xhr.responseJSON.status : 'tidak diketahui'),
                  message: xhr.responseJSON ? xhr.responseJSON.message : `Terjadi kesalahan: ${error}`,
                  position: 'topCenter',
                  timeout: 4000,
                });
              }
            },
            complete: function() {
              // Kembalikan teks tombol ke Uji Coba dan aktifkan kembali tombolnya
              $ujiCobaBtn.prop('disabled', false).html(
                'Uji Coba <i class="fa-solid fa-paper-plane ml-1"></i>');
            }
          });
        } else {
          iziToast.warning({
            title: 'Peringatan.',
            message: 'Nomor WhatsApp untuk uji coba harus diisi.',
            position: 'topCenter',
            timeout: 4000,
          });
        }
      });
    });




    // Selesaikan NProgress saat AJAX request selesai dan gambar-gambar dalam tabel telah dimuat
    $(document).ajaxComplete(function(event, xhr, settings) {
      const $container = $('#konfig_integrasi'); // Gantilah dengan selector tabel Anda
      stopLoadingWhenImagesLoaded($container);
    });
  </script>
@endsection
