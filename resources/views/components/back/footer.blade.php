<footer class="main-footer">
  <div class="d-flex justify-content-between">
    <div>
     Copyright © {{ now()->year }}. {{ $konfigs->nama_sistem }} <a href="{{ $konfigs->website_resmi }}" target="_blank"
        style="color: darkslategray">{{ $konfigs->nama_lembaga }}</a>
      {{-- Anda ({{ auth()->user()->level->nama_role }}) --}}
    </div>
    <div>
      {{ config('app.version') }}
    </div>
  </div>
</footer>
