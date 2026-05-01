# Panduan Menjalankan Project Amelia Hantaran

## Persyaratan Sistem

- PHP 8.2 atau lebih tinggi
- Composer
- MySQL 5.7+ atau MariaDB 10.3+
- Node.js 18+ dan NPM
- Web Server (Apache/Nginx)

## Instalasi

### 1. Clone Repository

```bash
cd /path/to/your/web/root
git clone <repository-url> amelia-hantaran
cd amelia-hantaran
```

### 2. Install PHP Dependencies

```bash
composer install
```

### 3. Install Node Dependencies

```bash
npm install
```

### 4. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=amelia_hantaran
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Buat Database

```bash
mysql -u root -p
CREATE DATABASE amelia_hantaran;
EXIT;
```

### 6. Run Migrations dan Seeders

```bash
php artisan migrate --seed
```

Perintah ini akan:
- Membuat semua tabel database
- Membuat user admin (email: admin@ameliahantaran.com, password: password)
- Membuat data dummy kategori dan produk
- Membuat data testimoni

### 7. Create Storage Link

```bash
php artisan storage:link
```

### 8. Build Assets (Optional - jika menggunakan Vite)

```bash
npm run build
```

### 9. Start Development Server

```bash
php artisan serve
```

Akses website di: http://localhost:8000

## Akun Default

### Admin
- Email: admin@ameliahantaran.com
- Password: password
- URL: http://localhost:8000/admin

### User
- Anda bisa mendaftar melalui halaman register

## Struktur URL

### Public Pages
- `/` - Home
- `/tentang-kami` - Tentang Kami
- `/kontak` - Kontak
- `/katalog` - Katalog Produk
- `/produk/{slug}` - Detail Produk
- `/keranjang` - Keranjang Belanja
- `/testimoni` - Testimoni

### Auth Pages
- `/login` - Login
- `/register` - Register

### User Dashboard (Setelah Login)
- `/checkout` - Checkout
- `/pesanan` - Riwayat Pesanan
- `/pesanan/{orderNumber}` - Detail Pesanan

### Admin Dashboard (Admin Only)
- `/admin` - Dashboard
- `/admin/orders` - Manajemen Pesanan
- `/admin/products` - Manajemen Produk
- `/admin/categories` - Manajemen Kategori
- `/admin/testimonials` - Manajemen Testimoni
- `/admin/galleries` - Manajemen Galeri
- `/admin/settings` - Pengaturan

## Alur Pemesanan

1. **User** memilih produk dari katalog
2. **User** menambahkan produk ke keranjang
3. **User** melakukan checkout dan mengisi data
4. **Sistem** menampilkan QR Code dan info bank transfer
5. **User** melakukan pembayaran
6. **User** upload bukti pembayaran
7. **Admin** menerima notifikasi dan memverifikasi pembayaran
8. **Admin** update status pesanan (diproses → dikirim → selesai)
9. **User** menerima update status pesanan

## Status Pesanan

| Status | Keterangan |
|--------|------------|
| pending | Pesanan baru dibuat |
| waiting_payment | Menunggu pembayaran dari customer |
| payment_verification | Pembayaran sudah diupload, menunggu verifikasi admin |
| diproses | Pembayaran terverifikasi, pesanan sedang diproses |
| dikirim | Pesanan sudah dikirim |
| selesai | Pesanan selesai |
| dibatalkan | Pesanan dibatalkan |

## Troubleshooting

### Error: Permission denied pada storage

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### Error: Class not found

```bash
composer dump-autoload
```

### Error: Key not found

```bash
php artisan key:generate
```

### Reset Database

```bash
php artisan migrate:fresh --seed
```

## Konfigurasi Tambahan

### WhatsApp Integration

Edit di Admin > Pengaturan:
- WhatsApp Number: Format 62xxx (tanpa +)

### Bank Transfer

Edit di Admin > Pengaturan:
- Nama Bank
- Nomor Rekening
- Atas Nama

### Ongkir Default

Edit di Admin > Pengaturan:
- Shipping Cost (dalam Rupiah)

## Maintenance

### Backup Database

```bash
mysqldump -u root -p amelia_hantaran > backup.sql
```

### Restore Database

```bash
mysql -u root -p amelia_hantaran < backup.sql
```

### Clear Cache

```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Kontak Support

Jika mengalami kendala, silakan hubungi:
- Email: hello@ameliahantaran.com
- WhatsApp: +62 812-3456-7890
