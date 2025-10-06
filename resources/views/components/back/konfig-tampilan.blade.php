  <div class="settings">
    @if ($floating == true)
      <a href="#" class="btn btn-floating btn-icon btn-primary" data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasSettings" aria-controls="offcanvasSettings" aria-label="Pengaturan Tampilan">
        <i class="ti ti-brush fs-2"></i>
      </a>
    @endif
    <form class="offcanvas offcanvas-start offcanvas-narrow" tabindex="-1" id="offcanvasSettings">
      <div class="offcanvas-header">
        <h2 class="offcanvas-title">Pengaturan Tampilan</h2>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body d-flex flex-column">
        <div>
          <div class="mb-4">
            <label class="form-label">Mode warna tema</label>
            <p class="form-hint">Pilih mode tampilan sistem ini.</p>
            <label class="form-check">
              <div class="form-selectgroup-item">
                <input type="radio" name="theme" value="light" class="form-check-input" checked />
                <div class="form-check-label">Terang</div>
              </div>
            </label>
            <label class="form-check">
              <div class="form-selectgroup-item">
                <input type="radio" name="theme" value="dark" class="form-check-input" />
                <div class="form-check-label">Gelap</div>
              </div>
            </label>
          </div>
          <div class="mb-4">
            <label class="form-label">Nuansa Warna</label>
            <p class="form-hint">Warna yang paling Anda sukai untuk tampilan sistem ini.</p>
            <div class="row g-2">
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="blue" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-blue"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="azure" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-azure"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="indigo" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-indigo"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="purple" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-purple"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="pink" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-pink"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="red" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-red"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="orange" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-orange"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="yellow" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-yellow"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="lime" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-lime"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="green" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-green"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="teal" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-teal"></span>
                </label>
              </div>
              <div class="col-auto">
                <label class="form-colorinput">
                  <input name="theme-primary" type="radio" value="cyan" class="form-colorinput-input" />
                  <span class="form-colorinput-color bg-cyan"></span>
                </label>
              </div>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label">Jenis Font</label>
            <p class="form-hint">Pilih font yang paling nyaman untuk Anda.</p>
            <div>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="sans-serif" class="form-check-input" checked />
                  <div class="form-check-label">Sans-serif</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="serif" class="form-check-input" />
                  <div class="form-check-label">Serif</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="monospace" class="form-check-input" />
                  <div class="form-check-label">Monospace</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-font" value="comic" class="form-check-input" />
                  <div class="form-check-label">Comic</div>
                </div>
              </label>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label">Tema Warna Latar</label>
            <p class="form-hint">Pilih tingkat gradasi abu untuk warna latar.</p>
            <div>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="slate" class="form-check-input" />
                  <div class="form-check-label">Slate</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="gray" class="form-check-input" checked />
                  <div class="form-check-label">Gray</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="zinc" class="form-check-input" />
                  <div class="form-check-label">Zinc</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="neutral" class="form-check-input" />
                  <div class="form-check-label">Neutral</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-base" value="stone" class="form-check-input" />
                  <div class="form-check-label">Stone</div>
                </div>
              </label>
            </div>
          </div>
          <div class="mb-4">
            <label class="form-label">Radius Pinggiran</label>
            <p class="form-hint">Pilih seberapa besar lengkungan untuk radius pinggiran.</p>
            <div>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="0" class="form-check-input" />
                  <div class="form-check-label">0</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="0.5" class="form-check-input" />
                  <div class="form-check-label">0.5</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="1" class="form-check-input" checked />
                  <div class="form-check-label">1</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="1.5" class="form-check-input" />
                  <div class="form-check-label">1.5</div>
                </div>
              </label>
              <label class="form-check">
                <div class="form-selectgroup-item">
                  <input type="radio" name="theme-radius" value="2" class="form-check-input" />
                  <div class="form-check-label">2</div>
                </div>
              </label>
            </div>
          </div>
        </div>
        <div class="mt-auto space-y">
          <button type="button" class="btn w-100" id="reset-changes">
            <!-- Download SVG icon from http://tabler.io/icons/icon/rotate -->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="icon icon-1">
              <path d="M19.95 11a8 8 0 1 0 -.5 4m.5 5v-5h-5" />
            </svg>
            Atur ulang
          </button>
          <a href="#" class="btn btn-primary w-100" data-bs-dismiss="offcanvas"> Simpan </a>
        </div>
      </div>
    </form>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Ambil base URL dari salah satu file sebagai referensi
      const tempPath = "{{ asset('img/login-illustration.png') }}";
      // Hilangkan bagian nama file-nya → hasilnya jadi folder img
      window.assetBase = tempPath.replace('/login-illustration.png', '');
      var basePath = window.assetBase;

      var themeConfig = {
        theme: "light",
        "theme-base": "gray",
        "theme-font": "sans-serif",
        "theme-primary": "blue",
        "theme-radius": "1",
      };
      var url = new URL(window.location);
      var form = document.getElementById("offcanvasSettings");
      var resetButton = document.getElementById("reset-changes");
      var checkItems = function() {
        for (var key in themeConfig) {
          var value = window.localStorage["tabler-" + key] || themeConfig[key];
          if (!!value) {
            var radios = form.querySelectorAll(`[name="${key}"]`);
            if (!!radios) {
              radios.forEach((radio) => {
                radio.checked = radio.value === value;
              });
            }
          }
        }
      };
      form.addEventListener("change", function(event) {
        var target = event.target,
          name = target.name,
          value = target.value;
        for (var key in themeConfig) {
          if (name === key) {
            document.documentElement.setAttribute("data-bs-" + key, value);
            window.localStorage.setItem("tabler-" + key, value);
            url.searchParams.set(key, value);

            // jika yang diubah adalah tema, ubah juga turnstile widget
            // jika yang diubah adalah tema, ubah juga turnstile widget
            if (key === "theme") {
              console.log('turnstile widget ikut theme:', value);

              // ============ 🔁 REFRESH TURNSTILE ============
              var widget = document.getElementById("cf-turnstile-widget");
              if (widget) {
                // Ambil parent
                var parent = widget.parentNode;

                // Ambil semua atribut penting
                var siteKey = widget.getAttribute("data-sitekey");
                var size = widget.getAttribute("data-size") || "flexible";
                var refresh = widget.getAttribute("data-refresh-expired") || "auto";
                var callback = widget.getAttribute("data-callback") || "";
                var language = widget.getAttribute("data-language") || "en-US";

                // Hapus widget lama
                widget.remove();

                // Buat ulang elemen baru dengan tema baru
                var newWidget = document.createElement("div");
                newWidget.id = "cf-turnstile-widget";
                newWidget.className = "cf-turnstile";
                newWidget.style.minWidth = "100px";
                newWidget.setAttribute("data-sitekey", siteKey);
                newWidget.setAttribute("data-size", size);
                newWidget.setAttribute("data-refresh-expired", refresh);
                newWidget.setAttribute("data-callback", callback);
                newWidget.setAttribute("data-theme", value);
                newWidget.setAttribute("data-language", language);

                // Tambahkan kembali ke DOM
                parent.appendChild(newWidget);

                // Render ulang Turnstile
                if (typeof turnstile !== "undefined") {
                  turnstile.render(newWidget);
                }
              }


              // ============ 🖼️ REFRESH ILUSTRASI LOGIN ============
              var illustration = document.getElementById("login-illustration");
              if (illustration) {
                var parent = illustration.parentNode;

                // Hapus elemen lama
                illustration.remove();

                // Ambil base path hasil dari window.assetBase
                var basePath = window.assetBase; // ✅ gunakan path publik hasil Vite build

                // Tentukan gambar baru sesuai tema
                var newImg = document.createElement("img");
                newImg.id = "login-illustration";
                newImg.alt = "Login Illustration";
                newImg.src = value === "dark" ?
                  basePath + "/login-illustration-dark.png" :
                  basePath + "/login-illustration.png";
                // newImg.className = "img-fluid"; // optional, agar tetap responsive

                // Tambahkan kembali ke DOM
                parent.appendChild(newImg);
              }
            }

          }
        }
        window.history.pushState({}, "", url);
      });
      resetButton.addEventListener("click", function() {
        for (var key in themeConfig) {
          var value = themeConfig[key];
          document.documentElement.removeAttribute("data-bs-" + key);
          window.localStorage.removeItem("tabler-" + key);
          url.searchParams.delete(key);
        }
        checkItems();
        window.history.pushState({}, "", url);
      });
      checkItems();
    });
  </script>
