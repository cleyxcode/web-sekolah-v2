# CLAUDE.md — Sistem Informasi SD Negeri Warialau
# Oleh: Bredcly Fransiscus Tuhuleruw (12155201220021)
# UKIM Ambon — 2026

---

## 📌 IDENTITAS PROJECT

- **Project:** web-warialau
- **Framework:** Laravel 12
- **Admin Panel:** Filament v3.3 ✅ SUDAH TERINSTALL
- **Database:** SQLite
- **Cache:** Redis
- **PHP:** 8.2+

---

## ✅ STATUS SETUP

- [x] Laravel 12 sudah terinstall
- [x] Filament v3.3 sudah terinstall
- [x] Panel admin sudah dibuat
- [x] Migration sudah dibuat (11 tabel)
- [x] Model sudah dibuat (9 model)
- [x] Resource sudah dibuat (9 resource + StatsOverviewWidget)
- [x] Seeder sudah dibuat (UserSeeder, ProfilSekolahSeeder, SettingsSeeder)

---

## 🚨 ATURAN ARSITEKTUR

### Admin (Filament):
```
Filament Resource → Model → SQLite
```
- ✅ Filament Resource langsung pakai Model Eloquent
- ❌ TIDAK perlu Service Layer
- ❌ TIDAK perlu Repository Layer

### Web Pengunjung & API Flutter (dikerjakan nanti):
```
Controller → Service Layer → Repository → Model → SQLite
```

---

## 🚀 URUTAN PENGERJAAN

1. Buat semua Migration
2. Jalankan `php artisan migrate`
3. Buat semua Model
4. Buat semua Filament Resource
5. Buat Dashboard Widget
6. Buat Seeder
7. Jalankan `php artisan db:seed`
8. Setup proteksi akses admin

---

## 🗄️ DATABASE — 11 TABEL

### 1. `users`
```php
$table->id();
$table->string('name');
$table->string('email')->unique();
$table->string('password');
$table->string('role')->default('orangtua'); // admin / orangtua
$table->string('no_hp')->nullable();
$table->rememberToken();
$table->timestamps();
```

### 2. `profil_sekolah`
```php
$table->id();
$table->string('nama_sekolah');
$table->string('kepala_sekolah')->nullable();
$table->string('akreditasi')->nullable(); // A / B / C
$table->string('tahun_berdiri')->nullable();
$table->integer('jumlah_ruang_kelas')->nullable();
$table->text('visi')->nullable();
$table->text('misi')->nullable();
$table->text('sejarah')->nullable();
$table->text('alamat')->nullable();
$table->string('kontak')->nullable();
$table->string('logo')->nullable();
$table->timestamps();
```

### 3. `guru`
```php
$table->id();
$table->string('nama');
$table->string('nip')->nullable();
$table->string('jabatan')->nullable();
$table->string('mata_pelajaran')->nullable();
$table->string('no_hp')->nullable();
$table->string('foto')->nullable();
$table->string('status')->default('aktif'); // aktif / nonaktif
$table->softDeletes();
$table->timestamps();
```

### 4. `siswa`
```php
$table->id();
$table->string('nama');
$table->string('nis')->nullable();
$table->string('kelas')->nullable();
$table->string('jenis_kelamin')->nullable(); // L / P
$table->string('tahun_ajaran')->nullable();
$table->string('foto')->nullable();
$table->string('status')->default('aktif'); // aktif / nonaktif / lulus
$table->softDeletes();
$table->timestamps();
```

### 5. `berita`
```php
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('judul');
$table->longText('isi');
$table->string('gambar')->nullable();
$table->string('kategori')->nullable();
$table->date('tanggal_publish')->nullable();
$table->string('status')->default('draft'); // draft / publish
$table->softDeletes();
$table->timestamps();
```

### 6. `galeri`
```php
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('judul');
$table->string('foto');
$table->text('keterangan')->nullable();
$table->softDeletes();
$table->timestamps();
```

### 7. `info_pendaftaran`
```php
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->string('tahun_ajaran');
$table->date('tanggal_buka');
$table->date('tanggal_tutup');
$table->integer('kuota');
$table->text('syarat')->nullable();
$table->string('status')->default('nonaktif'); // aktif / nonaktif
$table->timestamps();
```

### 8. `pendaftaran`
```php
$table->id();
$table->foreignId('user_id')->constrained()->cascadeOnDelete();
$table->foreignId('info_pendaftaran_id')->constrained()->cascadeOnDelete();
$table->string('nama_anak');
$table->string('tempat_lahir')->nullable();
$table->date('tanggal_lahir');
$table->string('jenis_kelamin'); // L / P
$table->string('agama');
$table->integer('anak_ke')->nullable();
$table->string('asal_sekolah')->nullable();
$table->string('nik')->nullable();
$table->string('no_kk')->nullable();
$table->text('alamat');
$table->string('nama_ayah')->nullable();
$table->string('pekerjaan_ayah')->nullable();
$table->string('nama_ibu')->nullable();
$table->string('pekerjaan_ibu')->nullable();
$table->string('nama_wali')->nullable();
$table->string('no_hp');
$table->string('dokumen')->nullable();
$table->string('status')->default('pending'); // pending / diterima / ditolak
$table->timestamps();
```

### 9. `banner`
```php
$table->id();
$table->string('judul');
$table->string('gambar');
$table->integer('urutan')->default(1);
$table->string('status')->default('aktif'); // aktif / nonaktif
$table->timestamps();
```

### 10. `settings`
```php
$table->id();
$table->string('key')->unique();
$table->text('value')->nullable();
$table->string('type')->default('text'); // text / image / url
$table->timestamps();
```

### 11. `cache`
```php
$table->string('key')->primary();
$table->mediumText('value');
$table->integer('expiration');
```

---

## 🗂️ MODEL — RELASI & FILLABLE

### User.php
```php
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

class User extends Authenticatable implements FilamentUser
{
    protected $fillable = ['name', 'email', 'password', 'role', 'no_hp'];

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function berita() { return $this->hasMany(Berita::class); }
    public function galeri() { return $this->hasMany(Galeri::class); }
    public function infoPendaftaran() { return $this->hasMany(InfoPendaftaran::class); }
    public function pendaftaran() { return $this->hasMany(Pendaftaran::class); }
}
```

### ProfilSekolah.php
```php
protected $fillable = [
    'nama_sekolah', 'kepala_sekolah', 'akreditasi',
    'tahun_berdiri', 'jumlah_ruang_kelas',
    'visi', 'misi', 'sejarah', 'alamat', 'kontak', 'logo'
];
```

### Guru.php
```php
use SoftDeletes;
protected $fillable = [
    'nama', 'nip', 'jabatan', 'mata_pelajaran',
    'no_hp', 'foto', 'status'
];
```

### Siswa.php
```php
use SoftDeletes;
protected $fillable = [
    'nama', 'nis', 'kelas', 'jenis_kelamin',
    'tahun_ajaran', 'foto', 'status'
];
```

### Berita.php
```php
use SoftDeletes;
protected $fillable = [
    'user_id', 'judul', 'isi', 'gambar',
    'kategori', 'tanggal_publish', 'status'
];
public function user() { return $this->belongsTo(User::class); }
```

### Galeri.php
```php
use SoftDeletes;
protected $fillable = ['user_id', 'judul', 'foto', 'keterangan'];
public function user() { return $this->belongsTo(User::class); }
```

### InfoPendaftaran.php
```php
protected $table = 'info_pendaftaran';
protected $fillable = [
    'user_id', 'tahun_ajaran', 'tanggal_buka',
    'tanggal_tutup', 'kuota', 'syarat', 'status'
];
public function user() { return $this->belongsTo(User::class); }
public function pendaftaran() { return $this->hasMany(Pendaftaran::class); }
```

### Pendaftaran.php
```php
protected $fillable = [
    'user_id', 'info_pendaftaran_id', 'nama_anak', 'tempat_lahir',
    'tanggal_lahir', 'jenis_kelamin', 'agama', 'anak_ke',
    'asal_sekolah', 'nik', 'no_kk', 'alamat',
    'nama_ayah', 'pekerjaan_ayah', 'nama_ibu', 'pekerjaan_ibu',
    'nama_wali', 'no_hp', 'dokumen', 'status'
];
public function user() { return $this->belongsTo(User::class); }
public function infoPendaftaran() { return $this->belongsTo(InfoPendaftaran::class); }
```

### Banner.php
```php
protected $fillable = ['judul', 'gambar', 'urutan', 'status'];
```

### Settings.php
```php
protected $fillable = ['key', 'value', 'type'];
```

---

## 📋 FILAMENT RESOURCE — DETAIL LENGKAP

### 1. StatsOverviewWidget (Dashboard)
Kartu statistik di halaman utama:
- Total Guru Aktif → `Guru::where('status','aktif')->count()`
- Total Siswa Aktif → `Siswa::where('status','aktif')->count()`
- Pendaftaran Pending → `Pendaftaran::where('status','pending')->count()`
- Berita Tayang → `Berita::where('status','publish')->count()`

---

### 2. ProfilSekolahResource
- Tidak ada halaman index & create — hanya Edit (1 data saja)
- Navigation icon: `heroicon-o-building-office`
- Form sections:
  - **Identitas:** nama_sekolah, kepala_sekolah, akreditasi (Select A/B/C), tahun_berdiri, jumlah_ruang_kelas
  - **Visi Misi:** visi (Textarea), misi (Textarea), sejarah (Textarea)
  - **Kontak:** alamat (Textarea), kontak (TextInput)
  - **Logo:** logo (FileUpload, image, disk: public, directory: profil)

---

### 3. GuruResource
- Navigation icon: `heroicon-o-academic-cap`
- Table: foto (ImageColumn, circular), nama, nip, jabatan, mata_pelajaran, no_hp, status (Badge: aktif=success, nonaktif=danger)
- Form sections:
  - **Data Guru:** nama (required), nip, jabatan, mata_pelajaran, no_hp, status (Select: aktif/nonaktif)
  - **Foto:** foto (FileUpload, image, disk: public, directory: guru)
- Filter: SelectFilter status
- Search: nama, nip
- Soft delete + TrashedFilter

---

### 4. SiswaResource
- Navigation icon: `heroicon-o-users`
- Table: foto (ImageColumn, circular), nama, nis, kelas, jenis_kelamin, tahun_ajaran, status (Badge: aktif=success, nonaktif=warning, lulus=info)
- Form sections:
  - **Data Siswa:** nama (required), nis, kelas, jenis_kelamin (Select: L/P), tahun_ajaran, status (Select: aktif/nonaktif/lulus)
  - **Foto:** foto (FileUpload, image, disk: public, directory: siswa)
- Filter: SelectFilter kelas, status, tahun_ajaran
- Search: nama, nis
- Soft delete + TrashedFilter

---

### 5. BeritaResource
- Navigation icon: `heroicon-o-newspaper`
- Table: gambar (ImageColumn), judul, kategori, status (Badge: draft=warning, publish=success), tanggal_publish
- Form sections:
  - **Konten:** judul (required, full width), isi (RichEditor, full width)
  - **Meta:** gambar (FileUpload, image, disk: public, directory: berita), kategori, tanggal_publish (DatePicker), status (Select: draft/publish)
  - user_id → set otomatis ke auth()->id() via mutateFormDataBeforeCreate
- Filter: SelectFilter status, kategori
- Search: judul
- Soft delete + TrashedFilter

---

### 6. GaleriResource
- Navigation icon: `heroicon-o-photo`
- Table: foto (ImageColumn, square), judul, keterangan
- Form:
  - judul (TextInput, required)
  - foto (FileUpload, image, required, disk: public, directory: galeri)
  - keterangan (Textarea)
  - user_id → set otomatis ke auth()->id()
- Search: judul
- Soft delete + TrashedFilter

---

### 7. InfoPendaftaranResource
- Navigation icon: `heroicon-o-clipboard-document-list`
- Table: tahun_ajaran, tanggal_buka, tanggal_tutup, kuota, status (Badge: aktif=success, nonaktif=danger)
- Form:
  - tahun_ajaran (TextInput, required)
  - tanggal_buka (DatePicker, required)
  - tanggal_tutup (DatePicker, required)
  - kuota (TextInput numeric, required)
  - syarat (Textarea, rows 6)
  - status (Select: aktif/nonaktif)
  - user_id → set otomatis ke auth()->id()
- Search: tahun_ajaran
- Validasi: hanya 1 data boleh berstatus aktif

---

### 8. PendaftaranResource
- Navigation icon: `heroicon-o-document-text`
- ❌ TIDAK ada tombol Create
- Table: nama_anak, nama_ayah, no_hp, asal_sekolah, status (Badge: pending=warning, diterima=success, ditolak=danger), created_at
- View page (detail lengkap semua field):
  - Section "Data Anak": nama_anak, tempat_lahir, tanggal_lahir, jenis_kelamin, agama, anak_ke, asal_sekolah, nik, no_kk
  - Section "Alamat": alamat
  - Section "Data Orang Tua": nama_ayah, pekerjaan_ayah, nama_ibu, pekerjaan_ibu, nama_wali, no_hp
  - Section "Dokumen": dokumen
  - Section "Status Pendaftaran": status (Select: pending/diterima/ditolak) — SATU-SATUNYA field yang bisa diedit admin
- Filter: SelectFilter status
- Search: nama_anak, no_hp

---

### 9. BannerResource
- Navigation icon: `heroicon-o-rectangle-stack`
- Table: gambar (ImageColumn), judul, urutan (sortable), status (Badge: aktif=success, nonaktif=danger)
- Form:
  - judul (TextInput, required)
  - gambar (FileUpload, image, required, disk: public, directory: banner)
  - urutan (TextInput numeric, default 1)
  - status (Select: aktif/nonaktif)
- Search: judul

---

### 10. SettingsResource
- Navigation icon: `heroicon-o-cog-6-tooth`
- Halaman Edit custom (bukan table)
- Gunakan Tabs:
  - **Tampilan Web:** logo, background, favicon (semua FileUpload, image, disk: public, directory: settings)
  - **Info Sekolah:** alamat_sekolah (Textarea), no_telp (TextInput), email_sekolah (TextInput)
  - **Media Sosial:** facebook_url (TextInput), instagram_url (TextInput)
  - **Lokasi:** maps_embed (Textarea — paste iframe Google Maps)

---

## 🌱 SEEDER

### UserSeeder
```php
User::create([
    'name'     => 'Administrator',
    'email'    => 'admin@admin.com',
    'password' => bcrypt('admin'),
    'role'     => 'admin',
]);
```

### ProfilSekolahSeeder
```php
ProfilSekolah::create([
    'nama_sekolah'  => 'SD Negeri Warialau',
    'kepala_sekolah'=> '',
    'akreditasi'    => 'B',
    'tahun_berdiri' => '1980',
    'alamat'        => 'Kec. Aru Utara, Kab. Kepulauan Aru, Maluku',
]);
```

### SettingsSeeder
```php
$settings = [
    ['key' => 'logo',           'value' => null, 'type' => 'image'],
    ['key' => 'background',     'value' => null, 'type' => 'image'],
    ['key' => 'favicon',        'value' => null, 'type' => 'image'],
    ['key' => 'alamat_sekolah', 'value' => null, 'type' => 'text'],
    ['key' => 'no_telp',        'value' => null, 'type' => 'text'],
    ['key' => 'email_sekolah',  'value' => null, 'type' => 'text'],
    ['key' => 'facebook_url',   'value' => null, 'type' => 'url'],
    ['key' => 'instagram_url',  'value' => null, 'type' => 'url'],
    ['key' => 'maps_embed',     'value' => null, 'type' => 'text'],
];
foreach ($settings as $s) Settings::create($s);
```

---

## ❌ YANG DILARANG

- ❌ Buat Service/Repository untuk Filament Resource
- ❌ Tombol Create di PendaftaranResource
- ❌ Orang tua bisa akses `/admin`
- ❌ Registrasi dari panel admin
- ❌ Fitur di luar daftar yang sudah ada

---

## 📌 CATATAN

- Project: `~/project-laravel/web-warialau`
- Admin URL: `http://localhost/admin`
- Login: `admin@admin.com` / `admin`
- Database: SQLite (`database/database.sqlite`)
- Redis port: 6379
- Reset DB: `php artisan migrate:fresh --seed`