{{-- MULAI MODAL KONFIRMASI DELETE --}}
<div id="hapus-modal" class="modal fade shadow-md" tabindex="-1" role="dialog" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Peringatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Data yang dihapus tidak akan bisa kembali lagi. Anda yakin ingin menghapus?</p>
      </div>
      <div class="modal-footer bg-whitesmoke">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus</button>
      </div>
    </div>
  </div>
</div>


{{-- KONFIRMASI KELUAR SISTEM --}}
<div id="konfirmasi-keluar" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1"
  aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="btn-keluar" action="#" method="POST">
        @csrf
        @method('GET')
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Anda yakin ingin mengakhiri sesi ini dan keluar dari Sistem?
        </div>
        <div class="modal-footer">
          <button class="btn btn-default" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-danger" type="submit">Keluar</button>
        </div>
      </form>
    </div>
  </div>
</div>


{{-- FITUR BELUM TERSEDIA --}}
<div id="tidakTersedia" class="modal fade" data-backdrop="static" tabindex="-1" aria-labelledby="staticBackdropLabel"
  aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Pemberitahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Maaf, fitur ini sedang dalam pengembangan.
      </div>
      <div class="modal-footer">
        <button class="btn btn-default" type="button" data-dismiss="modal">Ok, saya mengerti</button>
      </div>
    </div>
  </div>
</div>
