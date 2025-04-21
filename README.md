# 🌦️ Prueba Fitmewise - Clima

Este proyecto consiste en una aplicación full stack desarrollada con **Laravel** en el backend y **React con Redux** en el frontend. Permite al usuario seleccionar un país y una ciudad a través de un componente estilizado, y una vez seleccionada la ciudad, se obtiene la información del clima actual y los próximos 5 días usando la API de **OpenWeatherMap**. También se sugiere una rutina de ejercicios basada en el estado climático.

## 🛠️ Tecnologías Utilizadas

- **Laravel** (PHP Backend Framework)
- **React + Redux** (Frontend SPA)
- **Tailwind CSS** (Estilos del frontend)
- **MySQL** (Base de datos)
- **OpenWeatherMap API** (Proveedor de datos climáticos)
- **React-Select** (Componente de búsqueda para selects)

---

## 🚀 Instrucciones para desplegar el proyecto desde cero

### 1. Clonar el repositorio

```bash
git clone https://github.com/TU_USUARIO/prueba-fitmewise-clima.git
cd prueba-fitmewise-clima
```

---

## ⚙️ Requisitos previos

> Si no tiene nada instalado, siga estos pasos.

### 🔹 Instalar PHP (>= 8.1 recomendado)
- En Windows: usar [XAMPP](https://www.apachefriends.org/index.html) o [Laragon](https://laragon.org/)
- En Mac: instalar con Brew → `brew install php`
- En Linux: `sudo apt install php php-mbstring php-xml php-curl php-mysql php-cli unzip`

### 🔹 Instalar Composer
```bash
# Mac / Linux
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Windows
Descargar desde: https://getcomposer.org/download/
```

### 🔹 Instalar Node.js y NPM
Descargar desde: https://nodejs.org

---

## 🧱 Backend - Laravel

### 2. Instalar dependencias del backend

```bash
composer install
```

### 3. Crear el archivo `.env`

```bash
cp .env.example .env
```

Modificar las siguientes variables en el `.env`:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fitmewise_clima
DB_USERNAME=root
DB_PASSWORD=

WEATHER_API_KEY=TU_API_KEY_DE_OPENWEATHERMAP
```

> 🔐 **Nota:** Es necesario crear una cuenta gratuita en OpenWeatherMap para obtener la API key.

### 👉 Cómo obtener una API Key de OpenWeatherMap

1. Ir a [https://openweathermap.org/api](https://openweathermap.org/api)
2. Crear una cuenta gratuita.
3. Confirmar el correo electrónico.
4. Ir a la sección **"API Keys"** en tu perfil.
5. Crear una nueva key o usar la predeterminada.
6. Copiar y pegar la key en el archivo `.env` como `WEATHER_API_KEY`.

### 4. Generar la clave del proyecto

```bash
php artisan key:generate
```

### 5. Ejecutar las migraciones y seeders

```bash
php artisan migrate --seed
```

Esto creará las tablas y llenará la base de datos con los datos necesarios para iniciar.

### 6. Levantar el servidor local

```bash
php artisan serve
```

El backend estará disponible en: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 💻 Frontend - React

### 7. Moverse al directorio del frontend

```bash
cd frontend
```

### 8. Instalar dependencias del frontend

```bash
npm install
```

### 9. Configurar la API URL del backend

Crear un archivo `.env` dentro de `frontend/` con el contenido:

```
VITE_API_URL=http://127.0.0.1:8000/api
VITE_API_KEY=TU_API_KEY_DE_OPENWEATHERMAP
```

> Reemplace `TU_API_KEY_DE_OPENWEATHERMAP` con su clave de la API.

### 10. Iniciar el servidor de desarrollo

```bash
npm run dev
```

La aplicación estará disponible en: [http://localhost:5173](http://localhost:5173)

---

## 📡 Rutas del Backend (API)

| Método | Ruta                           | Descripción                                  |
|--------|--------------------------------|----------------------------------------------|
| GET    | /api/paises                   | Retorna la lista de países                   |
| GET    | /api/ciudades/{pais}          | Retorna la lista de ciudades de un país      |
| GET    | /api/clima/{ciudad}           | Retorna el clima actual y próximos 5 días    |
| GET    | /api/rutina/{estado_clima}    | Retorna una rutina sugerida según el clima   |

---

## ✅ Funcionalidad

- El usuario selecciona país y ciudad desde dos selectores con búsqueda.
- Al seleccionar la ciudad, se consulta la API de OpenWeatherMap.
- Se muestran los datos del clima actual y la predicción de los próximos 5 días.
- Se genera una sugerencia de rutina dependiendo del clima.

---

## ✨ Créditos

Proyecto realizado como prueba técnica para **Fitmewise**.
Desarrollado por: [Tu Nombre o Usuario de GitHub]

---

## 🧪 Testing (opcional)

```bash
php artisan test
```

---

## 🐞 Problemas comunes

- Verifique que los puertos `8000` (backend) y `5173` (frontend) estén disponibles.
- Asegúrese de tener una clave válida de OpenWeatherMap.
- Verifique que su servidor MySQL esté corriendo y configurado correctamente.
