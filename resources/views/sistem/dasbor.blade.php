@extends('components.theme.back')

@section('container')
  <div class="content-wrapper">
    {{-- Content Header (Page header) --}}
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dasbor
              @can('akses_superadmin')
                Superadmin
              @endcan
              @can('akses_manager')
                Manajer
              @endcan
              @can('akses_keuangan')
                Keuangan
              @endcan
              @can('akses_atasan')
                Atasan
              @endcan
              @can('akses_pegawai')
                Pegawai
              @endcan
            </h1>
            {{-- <h1 class="m-0">Selamat datang {{ auth()->user()->nama. ", asal ". auth()->user()->detail->asal }} </h1> --}}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{ Breadcrumbs::render() }}
            </ol>
          </div>
        </div>
      </div>
    </div>
    @php
      use App\Models\Presensi;
      use App\Models\Perizinan;
      use App\Models\Percutian;
      use App\Models\Penilaian;
    @endphp

    {{-- Main content --}}
    <section class="content">
      <div class="container">
        {{-- ----------------------------------- --}}
        {{-- DASBOR UNTUK SUPERADMIN dan MANAGER --}}
        {{-- DASBOR UNTUK SUPERADMIN dan MANAGER --}}
        @can('akses_superadmin_manager')
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>
                    <span class="counter" data-target="{{ $jml_presensi }}">{{ floor($jml_presensi / 2) }}</span>
                  </h3>
                  <p>Kehadiran</p>
                </div>
                <div class="icon">
                  <i class="fas fa-fingerprint"></i>
                </div>
                <a href="{{ route('presensi.index') }}" class="small-box-footer">Pantau
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_pengguna }}">{{ floor($jml_pengguna / 2) }}</span></h3>
                  <p>Pengguna</p>
                </div>
                <div class="icon">
                  <i class="fa fa-user-group"></i>
                </div>
                <a href="{{ route('pengguna.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_nilai }}">{{ floor($jml_nilai / 2) }}</span></h3>
                  <p>Penilaian</p>
                </div>
                <div class="icon">
                  <i class="fas fa-star"></i>
                </div>
                <a href="{{ route('penilaian.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_gaji }}">{{ floor($jml_gaji / 2) }}</span></h3>
                  <p>Gaji</p>
                </div>
                <div class="icon">
                  <i class="fas fa-sack-dollar"></i>
                </div>
                <a href="{{ route('gaji.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-2 col-4">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_izin }}">{{ floor($jml_izin / 2) }}</span></h3>
                  <p>Perizinan</p>
                </div>
                <div class="icon">
                  <i class="fas fa-hand-holding-droplet"></i>
                </div>
                <a href="{{ route('perizinan.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-2 col-4">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_cuti }}">{{ floor($jml_cuti / 2) }}</span></h3>
                  <p>Percutian</p>
                </div>
                <div class="icon">
                  <i class="fas fa-hand-holding-medical"></i>
                </div>
                <a href="{{ route('percutian.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-2 col-4">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_dinas }}">{{ floor($jml_dinas / 2) }}</span></h3>
                  <p>Tugas Dinas</p>
                </div>
                <div class="icon">
                  <i class="fas fa-hand-holding-heart"></i>
                </div>
                <a href="{{ route('perdinasan.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-2 col-4">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3>
                    <span class="counter" data-target="{{ $jml_jadwal_pengguna }}">
                      {{ floor($jml_jadwal_pengguna / 2) }}</span>
                  </h3>
                  <p>Jadwal</p>
                </div>
                <div class="icon">
                  <i class="far fa-clock"></i>
                </div>
                <a href="{{ route('jadwal.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-2 col-4">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_saran }}">{{ floor($jml_saran / 2) }}</span></h3>
                  <p>Saran</p>
                </div>
                <div class="icon">
                  <i class="fas fa-inbox"></i>
                </div>
                <a href="{{ route('kotaksaran.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{--  --}}
            <div class="col-lg-2 col-4">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_unit_kerja }}">{{ floor($jml_unit_kerja / 2) }}</span>
                  </h3>
                  <p>Unit Kerja</p>
                </div>
                <div class="icon">
                  <i class="fas fa-briefcase"></i>
                </div>
                <a href="{{ route('unitkerja.index') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
            {{-- akhir --}}
          </div>
        @endcan

        {{-- -------------------- --}}
        {{-- DASBOR UNTUK ATASAN --}}
        {{-- DASBOR UNTUK ATASAN --}}
        @can('akses_atasan')
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><span class="counter"
                      data-target="{{ $jml_presensi_anda }}">{{ floor($jml_presensi_anda / 2) }}</span></h3>
                  <p>Kehadiran Anda</p>
                </div>
                <div class="icon">
                  <i class="fas fa-fingerprint"></i>
                </div>
                <a href="{{ route('presensi.pribadi') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  @php
                    $unit = App\Models\UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                    if ($unit) {
                        $pengguna = App\Models\Pengguna::where('unitkerja', $unit->unitkerja_id)
                            ->pluck('user_id')
                            ->toArray();
                        $list_penilaian = App\Models\Penilaian::with('yg_dinilai')
                            ->whereIn('yg_dinilai_id', array_merge($pengguna, [auth()->user()->user_id]))
                            ->orderBy('created_at', 'DESC')
                            ->get();
                    } else {
                        $list_penilaian = []; // Handle case when $unit is not found
                    }
                  @endphp
                  <h3>
                    @if ($list_penilaian)
                      <span class="counter" data-target="{{ $list_penilaian->count() }}">
                        {{ floor($list_penilaian->count() / 2) }}</span>
                    @else
                      --
                    @endif
                  </h3>
                  <p>Penilaian Anda & Anggota</p>
                </div>
                <div class="icon">
                  <i class="fas fa-star"></i>
                </div>
                <a href="{{ route('penilaian.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  @php
                    $unit = App\Models\UnitKerja::where('ketua_id', auth()->user()->user_id)->first();
                    if ($unit) {
                        $pengguna = App\Models\Pengguna::where('unitkerja', $unit->unitkerja_id)
                            ->pluck('user_id')
                            ->toArray();
                        $list_percutian = App\Models\Percutian::with('pengguna')
                            ->whereIn('pengguna_id', array_merge($pengguna, [auth()->user()->user_id]))
                            ->orderBy('cuti_id', 'DESC')
                            ->get();
                    } else {
                        $list_percutian = []; // Handle case when $unit is not found
                    }
                  @endphp
                  @if ($list_percutian)
                    <h3><span class="counter" data-target="{{ $list_percutian->count() }}">
                        {{ floor($list_percutian->count() / 2) }}</span></h3>
                  @else
                    <h3>--</h3>
                  @endif
                  <p>Cuti Anda dan Anggota</p>
                </div>
                <div class="icon">
                  <i class="fas fa-clipboard-list"></i>
                </div>
                <a href="{{ route('percutian.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            {{--  --}}
            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="--">--</span></h3>
                  <p>Gaji</p>
                </div>
                <div class="icon">
                  <i class="fas fa-sack-dollar"></i>
                </div>
                <a href="{{ route('maintenance') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
          </div>
        @endcan

        {{-- -------------------- --}}
        {{-- DASBOR UNTUK PEGAWAI --}}
        {{-- DASBOR UNTUK PEGAWAI --}}
        @can('akses_pegawai')
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><span class="counter" data-target="{{ $jml_presensi_anda }}">
                      {{ floor($jml_presensi_anda / 2) }}</span></h3>
                  <p>Kehadiran Anda</p>
                </div>
                <div class="icon">
                  <i class="fas fa-fingerprint"></i>
                </div>
                <a href="{{ route('presensi.pribadi') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  @php
                    $penilaian_anda = Penilaian::where('yg_dinilai_id', auth()->user()->user_id)->get();
                  @endphp
                  <h3><span class="counter" data-target="{{ $penilaian_anda->count() }}">
                      {{ floor($penilaian_anda->count() / 2) }}</span></h3>
                  <p>Penilaian Anda</p>
                </div>
                <div class="icon">
                  <i class="fas fa-star"></i>
                </div>
                <a href="{{ route('perizinan.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  @php
                    $cuti_anda = Percutian::where('pengguna_id', auth()->user()->user_id)->get();
                  @endphp
                  <h3><span class="counter" data-target="{{ $cuti_anda->count() }}">
                      {{ floor($cuti_anda->count() / 2) }}</span></h3>
                  <p>Data Cuti Anda</p>
                </div>
                <div class="icon">
                  <i class="fas fa-clipboard-list"></i>
                </div>
                <a href="{{ route('percutian.index') }}" class="small-box-footer">Detail <i
                    class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>

            {{--  --}}
            <div class="col-lg-3 col-6">
              <div class="small-box bg-secondary">
                <div class="inner">
                  <h3><span class="counter" data-target="--">--</span></h3>
                  <p>Gaji Anda</p>
                </div>
                <div class="icon">
                  <i class="fas fa-sack-dollar"></i>
                </div>
                <a href="{{ route('maintenance') }}" class="small-box-footer">Detail
                  <i class="fas fa-arrow-circle-right ml-1"></i></a>
              </div>
            </div>
          </div>
        @endcan


        {{-- ROW UNTUK TO DO LIST DAN BERITA --}}
        <div class="row">
          {{-- SECTION UNTUK TODO-LIST --}}
          <section class="col-lg-5 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">To-Do List</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div id="todo-list">
                  <ul class="list-group" id="todo-items">
                    <!-- AJAX akan mengisi tugas di sini -->
                  </ul>
                </div>
                <div id="bagian-task" class="input-group ">
                  <input type="text" id="new-task" class="form-control" placeholder="Tugas baru">
                  <div class="input-group-append">
                    <button class="btn btn-primary" id="add-task">
                      Tambah
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </section>

          @if ($adalahKetuaUnit == true)
            {{-- SECTION UNTUK KETUA UNIT DAN ANGGOTANYA --}}
            <section class="col-lg-7 connectedSortable">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">
                    Anggota Unit
                  </h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <table id="table_anggota_unit" class="table table-sm table-hover table-borderless">
                    <thead>
                      <tr>
                        <th class="text-center" style="width: 1px">No.</th>
                        <th class="text-left" style="min-width: 100px">Nama</th>
                        <th class="text-right" style="max-width: 80px">Diakses</th>
                        @can('akses_superadmin_manager')
                          <th class="text-center" style="width: 1px">Aksi</th>
                        @endcan
                      </tr>
                    </thead>
                    <tbody>
                      @php $n = 0; @endphp
                      @foreach ($anggota_unit as $anggota)
                        @php $n++; @endphp
                        <tr>
                          <td class="text-center text-nowrap" style="width: 1px">{{ $n }}</td>
                          <td class="text-left text-nowrap">{{ $anggota->nama }}</td>
                          <td class="text-right text-nowrap">
                            {{ \Carbon\Carbon::parse($anggota->last_login_at)->diffForHumans() }}</td>
                          @can('akses_superadmin_manager')
                            <td class="text-center">
                              @if ($anggota->user_id == auth()->user()->user_id)
                                <i>Anda</i>
                              @else
                                <a href="/pengguna/{{ $anggota->user_id }}" data-toggle="tooltip" data-placement="left"
                                  title="Lihat Profil" id="{{ $anggota->user_id }}"
                                  class="lihat btn btn-sm text-center"><i class="fas fa-eye fa-sm"></i>
                                </a>
                              @endif
                            </td>
                          @endcan
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
          @endif


        </div>
      </div>
    </section>
  </div>
@endsection

@section('style')
  <style>
    .text-decoration-line-through {
      text-decoration: line-through;
      color: gray;
      /* Opsional: Beri warna untuk memperjelas */
      font-style: italic;
      /* Opsional: Tambahkan gaya miring untuk tugas selesai */
    }

    #todo-items .delete-task {
      display: none;
      /* Sembunyikan tombol Delete secara default */
    }

    #todo-items li:hover .delete-task {
      display: inline-block;
      /* Tampilkan tombol Delete saat hover */
    }

    /* #table_anggota_unit_filter {
                                width: 100%;
                                margin-bottom: 10px;
                              }

                              #table_anggota_unit_filter input {
                                width: 100%;
                                padding: 5px 10px;
                              } */
  </style>
@endsection

@section('js_atas')
  {{-- kosong --}}
@endsection

@section('js_bawah')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
  <script>
    //MULAI DATATABLE
    $(document).ready(function() {
      $('#table_anggota_unit').DataTable({
        dom: '<"top"f>rt<"bottom"i><"clear">', // Hanya menampilkan search bar (f) dan pagination (p)
        scrollX: true,
        info: false,
        autoWidth: false,
        ordering: false,
        language: {
          "zeroRecords": "Anggota tidak ditemukan",
          "infoFiltered": " ",
          "search": "Cari:",
          "emptyTable": "Tidak memiliki anggota",
          "thousands": ".",
          "paginate": {
            "first": "<<",
            "last": ">>",
            "next": ">",
            "previous": "<"
          },
        },
      });
    });


    document.addEventListener('DOMContentLoaded', function() {
      const counters = document.querySelectorAll('.counter');

      counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        const startValue = Math.floor(target / 2); // Mulai dari 50 angka sebelum nilai target
        const duration = 1300; // Durasi animasi dalam milidetik

        anime({
          targets: counter,
          innerHTML: [startValue, target],
          easing: 'linear',
          duration: duration,
          round: 1, // Membulatkan angka agar tidak ada desimal
        });
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
      loadTodos();

      const newTaskInput = document.getElementById('new-task');
      const addTaskButton = document.getElementById('add-task');
      const inputGroup = document.getElementById('bagian-task');

      // Tambah tugas dengan tombol "Tambah"
      addTaskButton.addEventListener('click', addTask);

      // Tambah tugas dengan tombol "Enter"
      newTaskInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
          addTask();
        }
      });

      // Load semua tugas
      function loadTodos() {
        fetch('/todos')
          .then(response => response.json())
          .then(todos => {
            const list = document.getElementById('todo-items');
            list.innerHTML = '';
            todos.forEach(todo => appendTodoItem(todo));

            if (todos.length === 0) {
              inputGroup.classList.remove('mt-4');
            } else {
              inputGroup.classList.add('mt-4');
            }
          });
      }

      // Fungsi untuk menambahkan tugas baru
      function addTask() {
        const task = newTaskInput.value.trim();
        if (!task) {
          iziToast.error({
            message: 'Tugas tidak boleh kosong',
            position: 'topCenter',
          });
          return;
        }

        fetch('/todos', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
              task
            }),
          })
          .then(response => response.json())
          .then(todo => {
            newTaskInput.value = '';
            newTaskInput.focus();
            appendTodoItem(todo);
          });
      }

      // Tambah elemen tugas ke DOM
      function appendTodoItem(todo) {
        const list = document.getElementById('todo-items');
        const item = document.createElement('li');
        item.className = 'list-group-item d-flex justify-content-between align-items-center';
        item.dataset.id = todo.id;
        item.innerHTML = `
            <span class="${todo.is_completed ? 'text-decoration-line-through' : ''}">
                ${todo.task}
            </span>
            <div class="text-nowrap">
                <button class="btn btn-sm btn-default complete-task text-nowrap">
                    ${todo.is_completed
                        ? '<span class="text-secondary mr-1">Ulangi</span><i class="fas fa-rotate-left"></i>'
                        : '<span class="text-success mr-1">Selesai</span><i class="fas fa-check" style="color: green"></i>'}
                </button>
                <button class="btn btn-sm btn-default delete-task">
                    <i class="fas fa-trash-can"></i>
                </button>
            </div>
        `;

        // Toggle selesai
        item.querySelector('.complete-task').addEventListener('click', function() {
          fetch(`/todos/${todo.id}`, {
              method: 'PATCH',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
              },
            })
            .then(response => response.json())
            .then(updatedTodo => {
              const taskText = item.querySelector('span');
              taskText.classList.toggle('text-decoration-line-through', updatedTodo.is_completed);

              // Update tombol dengan ikon baru
              this.innerHTML = updatedTodo.is_completed ?
                '<span class="text-secondary mr-1">Ulangi</span><i class="fas fa-rotate-left"></i>' // Ulangi ikon default
                :
                '<span class="text-success mr-1">Selesai</span><i class="fas fa-check" style="color: green"></i>'; // Ceklis hijau

              // Tampilkan iziToast sesuai status tugas
              if (updatedTodo.is_completed) {
                iziToast.success({
                  message: 'Anda telah menyelesaikan tugas ini',
                  position: 'topCenter',
                });
              } else {
                iziToast.info({
                  message: 'Tugas berhasil dikembalikan',
                  position: 'topCenter',
                });
              }
            });
        });

        // Hapus tugas
        item.querySelector('.delete-task').addEventListener('click', function() {
          fetch(`/todos/${todo.id}`, {
            method: 'DELETE',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
          }).then(() => item.remove());
        });

        list.appendChild(item);
      }
    });
  </script>
@endsection
