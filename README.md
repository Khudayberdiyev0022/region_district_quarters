# Region Districts Quarters API

Laravel 12 asosida qurilgan API - Viloyatlar, Tumanlar va Mahallalarni boshqarish tizimi (filter & sort).

## 📋 Texnologiyalar

- **Laravel**: 12.x
- **PHP**: 8.2
- **Database**: PostgreSQL/MySQL
- **API Documentation**: Scramble (OpenAPI/Swagger)

## 🚀 O'rnatish

### 1. Repository'ni clone qiling
```bash
git clone https://github.com/Khudayberdiyev0022/region_district_quarters.git
cd region_district_quarters
```

### 2. Dependencies'larni o'rnating
```bash
composer install
```

### 3. Environment faylini sozlang
```bash
cp .env.example .env
```

`.env` faylini tahrirlang va database sozlamalarini kiriting:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=your_database_name
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

### 4. Application key generatsiya qiling
```bash
php artisan key:generate
```

### 5. Database migration va seeding
```bash
php artisan migrate --seed
```

### 6. Serverni ishga tushiring
```bash
php artisan serve
```

API endi mavjud: `http://localhost:8000`

## 📚 API Endpoints

### Regions (Viloyatlar)

| Method | Endpoint | Tavsif |
|--------|----------|--------|
| GET | `/api/regions` | Barcha viloyatlarni olish  |
| GET | `/api/regions/{id}` | Bitta viloyatni olish |

### Districts (Tumanlar)

| Method | Endpoint | Tavsif |
|--------|----------|--------|
| GET | `/api/districts` | Barcha tumanlarni olish |
| GET | `/api/districts/{id}` | Bitta tumanni olish |

### Quarters (Mahallalar)

| Method | Endpoint | Tavsif |
|--------|----------|--------|
| GET | `/api/quarters` | Barcha mahallalarni olish  |
| GET | `/api/quarters/{id}` | Bitta mahallani olish |

## 🌍 Ko'p tillilik (Localization)

API uch tilda nomlarni qo'llab-quvvatlaydi:
- `uz` - O'zbek tili (Lotin)
- `oz` - Ўзбек тили (Kirill)
- `ru` - Русский язык

### Header orqali tilni tanlash
```bash
curl -H "Accept-Language: uz" http://localhost:8000/api/regions
curl -H "Accept-Language: oz" http://localhost:8000/api/regions
curl -H "Accept-Language: ru" http://localhost:8000/api/regions
```

Default til: `uz`

## 📖 API Dokumentatsiya

API dokumentatsiyani ko'rish uchun:
```
http://localhost:8000/docs/api
```

Scramble orqali avtomatik generatsiya qilingan interaktiv dokumentatsiya (Swagger UI).

## 📝 Request/Response Misollari

### GET /api/regions

**Request:**
```bash
curl -X GET http://localhost:8000/api/regions \
  -H "Accept: application/json" \
  -H "Accept-Language: uz"
```

**Response:**
```json
{
  "success": true,
  "status": 200,
  "data": [
    {
      "id": 1,
      "soato_id": "1701",
      "name": "Toshkent shahri",
      "order": 1,
      "district_count": 12,
      "quarters_count": 115
    }
  ],
  "pagination": {
    "total": 14,
    "per_page": 15,
    "current_page": 1,
    "last_page": 1,
    "from": 1,
    "to": 14,
    "has_more": false
  }
}
```

### GET /api/regions/{id}

**Request:**
```bash
curl -X GET http://localhost:8000/api/regions/1 \
  -H "Accept: application/json" \
  -H "Accept-Language: ru"
```

**Response:**
```json
{
  "success": true,
  "status": 200,
  "data": {
    "id": 1,
    "soato_id": "1701",
    "name": "город Ташкент",
    "order": 1,
    "district_count": 12,
    "quarters_count": 115,
    "districts": [
      {
        "id": 1,
        "name": "Яккасарайский район",
        "quarters_count": 9
      }
    ]
  }
}
```


### Error Response

**404 Not Found:**
```json
{
  "success": false,
  "status": 404,
  "message": "Resource not found"
}
```

**422 Validation Error:**
```json
{
  "success": false,
  "status": 422,
  "message": "Validation failed",
  "errors": {
    "name_uz": ["The name uz field is required."],
    "soato_id": ["The soato id field is required."]
  }
}
```

## 🗂️ Database Struktura

### Regions (viloyatlar)
- `id` - Primary key
- `soato_id` - SOATO kod
- `name_uz` - Nom (O'zbek lotin)
- `name_oz` - Ном (Ўзбек кирилл)
- `name_ru` - Название (Русский)
- `order` - Tartiblash uchun

### Districts (tumanlar)
- `id` - Primary key
- `region_id` - Foreign key (regions jadvaliga)
- `soato_id` - SOATO kod
- `name_uz`, `name_oz`, `name_ru` - Nomlar
- `order` - Tartiblash uchun

### Quarters (mahallalar)
- `id` - Primary key
- `district_id` - Foreign key (districts jadvaliga)
- `soato_id` - SOATO kod
- `name_uz`, `name_oz`, `name_ru` - Nomlar
- `order` - Tartiblash uchun

## 🏗️ Loyiha Strukturasi
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── RegionController.php
│   │   ├── DistrictController.php
│   │   └── QuarterController.php
│   ├── Resources/
│   │   ├── RegionResource.php
│   │   ├── DistrictResource.php
│   │   └── QuarterResource.php
│   └── Middleware/
│       └── SetLocale.php
├── Models/
│   ├── Region.php
│   ├── District.php
│   └── Quarter.php
├── Services/
│   ├── RegionService.php
│   ├── DistrictService.php
│   └── QuarterService.php
├── Repositories/
│   ├── RegionRepository.php
│   ├── DistrictRepository.php
│   └── QuarterRepository.php
└── Traits/
    └── ApiResponse.php
```

## 🔧 Qo'shimcha Sozlamalar

### Cache'ni tozalash
```bash
php artisan optimize:clear
```

### Database'ni qayta tiklash
```bash
php artisan migrate:fresh --seed
```

### Testing
```bash
php artisan test
```

## 📄 License

Bu loyiha ochiq kodli va [MIT license](LICENSE) ostida tarqatiladi.

## 👨‍💻 Muallif

[khudayberdiyev0022](https://github.com/khudayberdiyev0022)

## 🤝 Hissa qo'shish

Pull request'lar xush kelibsiz! Katta o'zgarishlar uchun avval issue oching.

## 📞 Aloqa

Email: [khamza.khudayberdiyev@gmail.com](mailto:khamza.khudayberdiyev@gmail.com)

GitHub: [Khudayberdiyev0022/region_district_quarters](https://github.com/Khudayberdiyev0022/region_district_quarters)
