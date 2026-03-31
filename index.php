<?php

$conn = new mysqli("127.0.0.1", "root", "", "checkout_db", 3306);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// 2. KAYDETME İŞLEMİ (Formdan veri gelirse çalışır)
if (isset($_POST['kayit_ol'])) {
    // Formdaki 'name' etiketlerinden gelen verileri yakalıyoruz
    $ad = $_POST['firstName'];
    $soyad = $_POST['lastName'];
    $kullanici_adi = $_POST['username'];
    $email = $_POST['email'];
    $adres = $_POST['address'];

    // Veritabanına yazıyoruz
    $sql = "INSERT INTO kullanicilar (ad, soyad, kullanici_adi, email, adres) 
            VALUES ('$ad', '$soyad', '$kullanici_adi', '$email', '$adres')";
    $conn->query($sql);

    // Kayıt bitince sayfayı yenileme
    header("Location: index.php");
    exit;
}
?>

<!doctype html>
<html lang="tr" data-bs-theme="auto">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Kayıt Formu Ödevi</title>
    
    <!-- İnternetten çekilen Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <style>
      /*  CSS Kodları[cite: 2] */
      .container { max-width: 960px; }
      
      /* Bootstrap'ın varsayılan ince ayarları */
      .bd-placeholder-img { font-size: 1.125rem; text-anchor: middle; user-select: none; }
      @media (min-width: 768px) { .bd-placeholder-img-lg { font-size: 3.5rem; } }
      .b-example-divider { width: 100%; height: 3rem; background-color: rgba(0,0,0,.1); border: solid rgba(0, 0, 0, 0.15); border-width: 1px 0; box-shadow: inset 0 0.5em 1.5em rgba(0,0,0,.1), inset 0 0.125em 0.5em rgba(0,0,0,.15); }
    </style>
  </head>
  <body class="bg-body-tertiary">
    
    <div class="container">
      <main>
        <div class="py-5 text-center">
          <h1 class="h2 text-primary">Kayıt Formu</h1>
          <p class="lead">
            Aşağıdaki formu doldurarak sisteme kayıt olabilirsiniz. Kaydettiğiniz veriler anında veritabanına yazılacak ve sayfanın en altında listelenecektir.
          </p>
        </div>

        <div class="row g-5 justify-content-center">
          
          <!-- KAYIT FORMU BÖLÜMÜ -->
          <div class="col-md-7 col-lg-8">
            <h4 class="mb-3">Kişisel Bilgiler</h4>
            <!-- form'a POST metodu ve name etiketleri eklendi -->
            <form method="POST" action="index.php" class="needs-validation" novalidate>
              <div class="row g-3">
                <div class="col-sm-6">
                  <label for="firstName" class="form-label">Ad</label>
                  <input type="text" class="form-control" name="firstName" id="firstName" required />
                  <div class="invalid-feedback">Ad alanı zorunludur.</div>
                </div>

                <div class="col-sm-6">
                  <label for="lastName" class="form-label">Soyad</label>
                  <input type="text" class="form-control" name="lastName" id="lastName" required />
                  <div class="invalid-feedback">Soyad alanı zorunludur.</div>
                </div>

                <div class="col-12">
                  <label for="username" class="form-label">Kullanıcı Adı</label>
                  <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" name="username" id="username" placeholder="kullanici_adiniz" required />
                    <div class="invalid-feedback">Kullanıcı adı zorunludur.</div>
                  </div>
                </div>

                <div class="col-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" name="email" id="email" placeholder="ornek@mail.com" required/>
                  <div class="invalid-feedback">Lütfen geçerli bir email girin.</div>
                </div>

                <div class="col-12">
                  <label for="address" class="form-label">Adres</label>
                  <input type="text" class="form-control" name="address" id="address" placeholder="Açık adresiniz" required />
                  <div class="invalid-feedback">Lütfen adresinizi girin.</div>
                </div>
              </div>

              <hr class="my-4" />
              <!-- SUBMIT BUTONU -->
              <button class="w-100 btn btn-primary btn-lg" type="submit" name="kayit_ol">
                Bilgilerimi Kaydet
              </button>
            </form>
          </div>
        </div>
      </main>

      <hr class="my-5">

      <!-- EKLENEN VERİLERİN GÖSTERİLDİĞİ TABLO  -->
      <div class="py-3 text-center">
        <h2 class="h3 text-success">Sisteme Kayıtlı Kullanıcılar</h2>
        <p class="text-muted">Veritabanından canlı olarak çekilmektedir.</p>
      </div>

      <div class="table-responsive shadow-sm bg-white rounded p-3 mb-5">
        <table class="table table-hover table-striped">
          <thead class="table-dark">
            <tr>
              <th>ID</th>
              <th>Ad Soyad</th>
              <th>Kullanıcı Adı</th>
              <th>Email</th>
              <th>Adres</th>
              <th>Kayıt Tarihi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Veritabanından verileri çekiyoruz
            $sorgu = $conn->query("SELECT * FROM kullanicilar ORDER BY id DESC");

            if ($sorgu->num_rows > 0) {
                while($row = $sorgu->fetch_assoc()) {
                    echo "<tr>
                            <td>".$row['id']."</td>
                            <td>".$row['ad']." ".$row['soyad']."</td>
                            <td>@".$row['kullanici_adi']."</td>
                            <td>".$row['email']."</td>
                            <td>".$row['adres']."</td>
                            <td>".date('d.m.Y H:i', strtotime($row['kayit_tarihi']))."</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='6' class='text-center text-muted py-3'>Henüz hiç kayıt yapılmamış. İlk kaydı yukarıdan yapın!</td></tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <footer class="my-5 pt-5 text-body-secondary text-center text-small">
        <p class="mb-1">&copy; 2026 PHP Kayıt Formu Ödevi</p>
      </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!--  Validation (Doğrulama) Scripti[cite: 3] -->
    <script>
      (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.from(forms).forEach(form => {
          form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }
            form.classList.add('was-validated')
          }, false)
        })
      })()
    </script>
  </body>
</html>
