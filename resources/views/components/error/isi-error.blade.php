<div class="container-tight py-4">
  <div class="empty">
    @yield('container')

    <div class="empty-action">
      <a href="{{ url()->previous() }}" class="btn btn-primary btn-4">
        <i class="ti ti-arrow-back-up fs-2 me-2"></i>
        Kembali
      </a>
    </div>
  </div>
</div>
