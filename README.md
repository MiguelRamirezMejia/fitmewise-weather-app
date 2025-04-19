# 🌤️ Fitmewise - Clima y Rutinas

Aplicación full-stack desarrollada para **Fitmewise**. Permite a los usuarios consultar el clima actual y la previsión para los próximos 5 días, además de recibir **recomendaciones de rutinas** basadas en las condiciones climáticas.

---

## 🧱 Tecnologías utilizadas

- **Backend:** Laravel 10 (API RESTful)
- **Frontend:** React + Tailwind CSS
- **Gestión de estado:** Redux
- **API Externa:** OpenWeatherMap

---

## 📁 Estructura del proyecto

```bash
/fitmewise-weather
│
├── backend    # Proyecto Laravel (API RESTful)
│
└── frontend   # Proyecto React con Tailwind y Redux
```

---

## 🚀 Cómo ejecutar el proyecto

Se recomienda tener instalado php, composer 

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/fitmewise-weather.git
cd fitmewise-weather
```

---

## 🛠️ Backend (Laravel)

```bash
cd backend

# Instalar dependencias
composer install

# Copiar y configurar el archivo de entorno
cp .env.example .env

# Generar la clave de la app
php artisan key:generate

# Configurar variables de entorno en .env:
# - OPENWEATHER_API_KEY=tu_api_key
# - Unidades: metric / imperial
# - Formato de idioma, etc.

# Ejecutar el servidor de desarrollo
php artisan serve
```

---

## 💻 Frontend (React + Tailwind)

```bash
cd frontend

# Instalar dependencias
npm install

# Ejecutar la app
npm run dev
```

---

## 🔗 Endpoints Backend

- `GET /api/weather/current?city=MadridES`  
  → Devuelve el clima actual para la ciudad.

- `GET /api/weather/forecast?city=MadridES&days=5`  
  → Devuelve la previsión del clima para los próximos días.

---

## 🌐 Cómo obtener una API Key de OpenWeatherMap

1. Regístrate en: https://openweathermap.org/
2. Ve a tu panel y copia tu API Key.
3. Pégala en el archivo `.env` del backend como:

```env
OPENWEATHER_API_KEY=tu_clave_api
```

---

## ✅ Próximas mejoras (opcional)

- Multilenguaje
- Guardar ciudades favoritas
- Incluir alertas meteorológicas

---

## 📌 Autor

Este proyecto fue desarrollado como prueba técnica para Fitmewise.

---

## 📸 Capturas de pantalla

(Agrega aquí imágenes de la interfaz si las tienes)

---
