# Deploy OCBAS to InfinityFree Free Hosting

Panduan ini khusus untuk struktur projek ini:

- `public/index.php` sebagai entry point
- `app/`, `config/`, dan `public/` perlu berada dalam `htdocs`
- Database menggunakan PDO MySQL

## 1. Sediakan akaun InfinityFree

1. Daftar/login di InfinityFree.
2. Create hosting account percuma.
3. Pilih free subdomain InfinityFree atau sambung domain sendiri.
4. Buka Control Panel.

InfinityFree free hosting menyokong PHP dan MySQL, dan upload custom website dibuat melalui FTP atau online File Manager.

## 2. Upload fail projek

Dalam File Manager atau FTP, masuk folder `htdocs`.

Upload fail/folder ini ke dalam `htdocs`:

```text
.htaccess
app/
config/
public/
README.md
```

Pastikan struktur selepas upload jadi begini:

```text
htdocs/
  .htaccess
  app/
  config/
    config.example.php
    database.php
    config.php
  public/
    index.php
    assets/
```

Nota: pada InfinityFree, document root free hosting ialah `htdocs`. Jangan upload ke `public_html`.

## 3. Create database InfinityFree

1. Di Control Panel, buka `MySQL Databases`.
2. Create database baru.
3. Catat maklumat ini:
   - MySQL hostname, contoh `sqlXXX.infinityfree.com` atau `sqlXXX.epizy.com`
   - Database name, biasanya ada prefix
   - Username, biasanya ada prefix
   - Password hosting/control panel

Penting: untuk InfinityFree, MySQL host biasanya bukan `localhost`. Guna hostname yang dipaparkan dalam Control Panel.

## 4. Export database dari XAMPP

1. Buka `http://localhost/phpmyadmin`.
2. Pilih database projek OCBAS.
3. Klik `Export`.
4. Pilih `Quick` dan format `SQL`.
5. Download fail `.sql`.

## 5. Import database ke InfinityFree

1. Di Control Panel InfinityFree, buka phpMyAdmin.
2. Pilih database yang baru dibuat.
3. Klik `Import`.
4. Upload fail `.sql` dari XAMPP.
5. Run import.

## 6. Buat config private

Dalam `htdocs/config/`, create fail bernama `config.php`.

Isi dengan credential InfinityFree:

```php
<?php
$host = 'sqlXXX.infinityfree.com';
$db   = 'if0_XXXXXX_ocbas';
$user = 'if0_XXXXXX';
$pass = 'your_control_panel_password';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
```

Jangan commit `config/config.php` ke GitHub. Fail ini sudah dimasukkan dalam `.gitignore`.

## 7. Test URL

Buka URL website:

```text
https://your-site.infinityfreeapp.com/
```

Jika redirect gagal, cuba:

```text
https://your-site.infinityfreeapp.com/public/index.php
```

## 8. Jika error biasa berlaku

### Database connection failed

Semak balik:

- `$host` mesti ikut MySQL hostname InfinityFree, bukan `localhost`
- `$db` mesti full database name dengan prefix
- `$user` mesti username dengan prefix
- `$pass` guna hosting/control panel password

### 500 Internal Server Error

Semak:

- Fail `.htaccess` ada dalam `htdocs`
- `config/config.php` wujud
- Semua folder `app`, `config`, `public` sudah upload
- PHP version di Control Panel serasi dengan projek

### CSS/images tidak keluar

Semak folder ini wujud:

```text
htdocs/public/assets/
```

Kod projek ini banyak guna path `/public/assets/...`, jadi folder `public` perlu kekal bernama `public`.

## 9. Deploy dari GitHub

InfinityFree free hosting tidak semestinya auto-pull dari GitHub. Cara paling mudah:

1. Download ZIP dari GitHub.
2. Extract.
3. Upload isi projek ke `htdocs`.
4. Jangan lupa upload `config/config.php` secara manual sebab fail itu tidak berada dalam GitHub.

Untuk auto-deploy dari GitHub, boleh guna GitHub Actions FTP, tetapi credential FTP perlu disimpan sebagai GitHub Secrets.
