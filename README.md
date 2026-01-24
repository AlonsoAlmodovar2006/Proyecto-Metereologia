# 🌦️ Estación Meteorológica IES Gregorio Prieto

## 📝 Descripción

Proyecto desarrollado por estudiantes de **2º DAW** que consiste en una aplicación web para visualizar datos meteorológicos en tiempo real recogidos por una estación meteorológica instalada en el **IES Gregorio Prieto** (Valdepeñas, Ciudad Real).

La estación recopila datos de temperatura, presión atmosférica, humedad, velocidad del viento y precipitación, enviándolos a un servidor local para su almacenamiento y posterior visualización a través de una interfaz web moderna e intuitiva.

Este proyecto es una actualización y mejora de una iniciativa original comenzada en el curso 2020-21, retomada en el marco de la **FP Dual 2025-26**.

## ✨ Características

- 📊 **Visualización de datos en tiempo real** - Gráficos interactivos con Chart.js
- 🕐 **Datos históricos** - Consulta de datos de las últimas 24 horas
- 🌡️ **Múltiples sensores** - Temperatura, presión, humedad, viento y lluvia
- 📱 **Diseño responsive** - Compatible con dispositivos móviles y tablets
- 🎨 **Interfaz moderna** - Uso de Bootstrap 5 para un diseño limpio y profesional
- 🔄 **Actualizaciones automáticas** - Los datos se actualizan periódicamente
- 📡 **API REST** - Endpoints para recepción y consulta de datos

## 🛠️ Tecnologías Utilizadas

### Backend
- **PHP 8+** - Lenguaje de programación principal
- **Illuminate Database** - ORM para gestión de base de datos
- **Twig** - Motor de plantillas para las vistas
- **Dotenv** - Gestión de variables de entorno
- **Composer** - Gestor de dependencias

### Frontend
- **HTML5 / CSS3** - Estructura y estilos
- **Bootstrap 5** - Framework CSS
- **JavaScript (ES6+)** - Lógica del cliente
- **Chart.js** - Librería para gráficos interactivos
- **Bootstrap Icons** - Iconografía

### Base de Datos
- **MySQL** - Sistema de gestión de base de datos

## 📂 Estructura del Proyecto

```
Proyecto-Metereologia/
├── public/                 # Carpeta pública accesible
│   ├── index.php          # Punto de entrada de la aplicación
│   ├── css/
│   │   └── styles.css     # Estilos personalizados
│   ├── js/                # Scripts JavaScript
│   │   ├── app.js         # Funciones generales
│   │   ├── temperatura.js # Gráficos de temperatura
│   │   ├── presion.js     # Gráficos de presión
│   │   ├── humedad.js     # Gráficos de humedad
│   │   └── viento.js      # Gráficos de viento
│   └── img/               # Recursos de imagen
├── src/
│   ├── Controllers/       # Controladores MVC
│   │   ├── Controller.php
│   │   ├── AlonsoController.php
│   │   ├── MCarmenController.php
│   │   └── OrwinController.php
│   ├── Models/            # Modelos de datos
│   │   ├── Database.php
│   │   └── Datos.php
│   ├── Routes/            # Sistema de enrutamiento
│   │   └── Router.php
│   └── Views/             # Plantillas Twig
│       ├── home.html.twig
│       ├── temperatura.html.twig
│       ├── presion.html.twig
│       ├── humedad.html.twig
│       ├── viento.html.twig
│       └── partials/
├── vendor/                # Dependencias de Composer
├── composer.json          # Configuración de Composer
├── .env                   # Variables de entorno (no incluido)
└── README.md             # Este archivo
```

## ⚙️ Instalación

### Requisitos Previos

- **PHP 8.0** o superior
- **Composer** instalado
- **MySQL** o **MariaDB**
- Servidor web (**Apache** o **Nginx**) o usar el servidor integrado de PHP

### Pasos de Instalación

#### 1️⃣ Clonar el repositorio
```bash
git clone https://github.com/AlonsoAlmodovar2006/Proyecto-Metereologia.git
cd Proyecto-Metereologia
```

#### 2️⃣ Instalar dependencias
```bash
composer install
```

#### 3️⃣ Configurar variables de entorno
Crea un archivo `.env` en la raíz del proyecto con la siguiente estructura:
```env
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nombre_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

#### 4️⃣ Crear la base de datos
Crea una base de datos MySQL e importa el esquema necesario (tabla `datos` con campos: `fechaSistema` (actúa como id), `temperatura`, `presion`, `humedad`, `viento`, `lluvia`, ).

#### 5️⃣ Iniciar el servidor
```bash
composer start
```
O manualmente:
```bash
php -S localhost:8000 -t public
```

#### 6️⃣ Acceder a la aplicación
Abre tu navegador y visita: `http://localhost:8000`

## 🌐 Rutas y Navegación

La aplicación cuenta con las siguientes rutas principales:

- **`/`** → Página principal con datos de las últimas 24 horas
- **`/temperatura`** → Visualización detallada de temperatura
- **`/presion`** → Gráficos de presión atmosférica
- **`/humedad`** → Datos de humedad relativa
- **`/viento`** → Información sobre velocidad del viento
- **`/datos`** → Endpoint API para recibir datos de la estación (POST)
- **`/proyectoAnterior`** → Información sobre el proyecto original

## 📡 API de Datos

### Enviar Datos
```http
POST /datos
Content-Type: application/x-www-form-urlencoded

temperatura=23.5&presion=1013.25&humedad=65&viento=15.2&lluvia=0
```

**Respuesta exitosa:**
```
200 OK
```

## 📸 Capturas de Pantalla

### Página Principal
![Página principal con datos de las últimas 24 horas](ruta/a/captura1.png)
*Visualización de los datos meteorológicos de las últimas 24 horas*

### Gráfico de Temperatura
![Gráfico interactivo de temperatura](ruta/a/captura2.png)
*Gráfico detallado de temperatura con datos históricos a modo de ejemplo*

### Homenaje al Proyecto Realizado en la 2020-21
![Proyecto anterior](ruta/a/captura3.png)
*Visualización de lo que hicieron los alumnos de ese curso relacionado con este proyecto*

## 🤝 Contribuir

Las contribuciones son bienvenidas. Si deseas contribuir al proyecto:

1. Haz un fork del repositorio
2. Crea una rama para tu feature (`git checkout -b feature/NuevaCaracteristica`)
3. Realiza tus cambios y haz commit (`git commit -m 'Añadir nueva característica'`)
4. Sube tus cambios (`git push origin feature/NuevaCaracteristica`)
5. Abre un Pull Request

## 📜 Licencia

Este proyecto está bajo la [Licencia MIT](LICENSE).  
Puedes usar, copiar, modificar y distribuir este software libremente, siempre que mantengas la notificación de copyright y la licencia original.

## 👥 Autores y Contacto

Proyecto desarrollado por estudiantes de **2º DAW** del IES Gregorio Prieto:

- **Alonso Almodóvar Delgado** - [alonsoalmodovar09@gmail.com](mailto:alonsoalmodovar09@gmail.com)
- **Mª Carmen García**
- **Orwin Zavaleta** - [orwinzavaleta@gmail.com](mailto:orwinzavaleta@gmail.com)

---

<p align="center">
  <em>Desarrollado con ❤️ en el IES Gregorio Prieto - Valdepeñas, Ciudad Real</em>
</p>

## Agradecimientos 🙏
 - A nuestra profesora Paula por esta oportunidad de seguir descubriendo y aprendiendo en este sector tan apasionante.
 - A los demás departamentos por la coordinación y disposición de llevar este proyecto a cabo.
