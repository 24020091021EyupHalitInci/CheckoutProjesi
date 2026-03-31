📝 PHP & MySQL Kayıt Formu Projesi

<img width="2540" height="1272" alt="Ekran görüntüsü 2026-03-31 202613" src="https://github.com/user-attachments/assets/791794de-5f80-4932-bac4-4c2d55ba78e8" />

Bu proje, kullanıcıların form aracılığıyla sisteme kayıt olabildiği ve kayıtların anlık olarak listelendiği basit bir web uygulamasıdır.

## 🚀 Özellikler

* 👤 Kullanıcı kayıt sistemi
* 📥 Form üzerinden veri ekleme
* 📊 Veritabanındaki kayıtları tablo halinde listeleme
* ✅ Bootstrap ile form doğrulama (validation)
* 📅 Kayıt tarihini otomatik tutma

## 🛠️ Kullanılan Teknolojiler

* PHP
* MySQL
* HTML5 / CSS3
* Bootstrap 5

## ⚙️ Kurulum

1. Projeyi indir veya klonla:

   ```bash
   git clone https://github.com/24020091021EyupHalitInci/CheckoutProjesi.git
   ```

2. Localhost ortamına ekle:

   * XAMPP / WAMP / Laragon kullanabilirsin

3. MySQL'de `checkout_db` adında veritabanı oluştur

4. Aşağıdaki tabloyu oluştur:

   ```sql
   CREATE TABLE kullanicilar (
       id INT AUTO_INCREMENT PRIMARY KEY,
       ad VARCHAR(100),
       soyad VARCHAR(100),
       kullanici_adi VARCHAR(100),
       email VARCHAR(150),
       adres TEXT,
       kayit_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

5. Tarayıcıdan aç:

   ```
   http://localhost/proje-klasoru
   ```

