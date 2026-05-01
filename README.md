# Amelia Hantaran - Wedding E-Commerce Platform

Website company profile dan e-commerce untuk usaha hantaran pernikahan, dibangun dengan Laravel 12.

## Fitur

### User Side
- 🏠 **Home Page** - Hero section, produk unggulan, testimoni, CTA
- 📦 **Katalog Produk** - Grid produk dengan filter kategori dan search
- 🔍 **Detail Produk** - Gallery foto, deskripsi, harga, stok
- 🛒 **Keranjang Belanja** - Session-based cart system
- 💳 **Checkout** - Form data pelanggan, QR Code pembayaran
- 📋 **Riwayat Pesanan** - Lacak status pesanan
- ⭐ **Testimoni** - Submit dan lihat testimoni

### Admin Panel
- 📊 **Dashboard** - Ringkasan statistik dengan Chart.js
- 📦 **Manajemen Produk** - CRUD produk dengan multiple images
- 🏷️ **Manajemen Kategori** - CRUD kategori
- 📋 **Manajemen Pesanan** - Verifikasi pembayaran, update status
- ⭐ **Manajemen Testimoni** - Approve/reject testimoni
- 🖼️ **Galeri** - Manajemen foto hantaran
- ⚙️ **Pengaturan** - Konfigurasi website

## Tech Stack

- **Framework:** Laravel 12
- **Frontend:** Blade Template + Tailwind CSS
- **Database:** MySQL
- **Authentication:** Laravel Breeze
- **Storage:** Laravel Storage
- **Icons:** Lucide Icons
- **Charts:** Chart.js

## Instalasi

### Prerequisites
- PHP 8.2+
- Composer
- MySQL
- Node.js & NPM (untuk build assets)

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone <repository-url>
   cd amelia-hantaran
   ```

2. **Install dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   Edit `.env` file:
   ```
   DB_DATABASE=amelia_hantaran
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Run migrations dan seeders**
   ```bash
   php artisan migrate --seed
   ```

6. **Create storage link**
   ```bash
   php artisan storage:link
   ```

7. **Build assets (jika menggunakan Vite)**
   ```bash
   npm run build
   ```

8. **Start server**
   ```bash
   php artisan serve
   ```

9. **Akses website**
   - Website: http://localhost:8000
   - Admin: http://localhost:8000/admin
   - Login admin: admin@ameliahantaran.com / password

## Struktur Folder

```
amelia-hantaran/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/        # Admin controllers
│   │   │   └── ...           # User controllers
│   │   ├── Middleware/
│   │   └── Requests/         # Form requests
│   └── Models/               # Eloquent models
├── database/
│   ├── migrations/           # Database migrations
│   ├── seeders/              # Database seeders
│   └── factories/            # Model factories
├── resources/
│   └── views/                # Blade templates
│       ├── admin/            # Admin views
│       ├── components/       # Reusable components
│       └── layouts/          # Layout templates
├── routes/
│   └── web.php               # Web routes
└── storage/
    └── app/public/           # Uploaded files
```

## Alur Pemesanan

1. User memilih produk dari katalog
2. Produk masuk ke keranjang (session/database)
3. User checkout dan mengisi data
4. Sistem menampilkan QR Code pembayaran
5. User melakukan pembayaran via e-wallet/mobile banking
6. User upload bukti pembayaran
7. Status: menunggu verifikasi admin
8. Admin memverifikasi (approve/reject)
9. Jika approve → pesanan diproses dan dikirim

## Status Pesanan

- `pending` - Pesanan dibuat
- `waiting_payment` - Menunggu pembayaran
- `payment_verification` - Verifikasi pembayaran
- `diproses` - Pesanan sedang diproses
- `dikirim` - Pesanan dikirim
- `selesai` - Pesanan selesai
- `dibatalkan` - Pesanan dibatalkan

## API Endpoints

### Cart
- `GET /keranjang` - View cart
- `POST /keranjang/tambah/{product}` - Add to cart
- `PUT /keranjang/update/{product}` - Update quantity
- `DELETE /keranjang/hapus/{product}` - Remove item

### Orders
- `GET /pesanan` - List orders
- `GET /pesanan/{orderNumber}` - Order detail
- `POST /pesanan/{orderNumber}/upload-bukti` - Upload payment proof

## Kontribusi

1. Fork repository
2. Buat branch baru (`git checkout -b feature/nama-fitur`)
3. Commit perubahan (`git commit -am 'Add fitur baru'`)
4. Push ke branch (`git push origin feature/nama-fitur`)
5. Buat Pull Request

## Lisensi

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Kontak

- Email: hello@ameliahantaran.com
- WhatsApp: +62 812-3456-7890
- Instagram: @ameliahantaran

---

Dibuat dengan ❤️ untuk momen spesial Anda
