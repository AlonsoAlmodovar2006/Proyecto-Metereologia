#!/bin/bash

set -e

echo "🚀 Desplegando Proyecto Meteorología..."

# 1. Liberar RAM antes de empezar
sudo sync; echo 3 | sudo tee /proc/sys/vm/drop_caches

# 2. Levantar contenedores
sudo docker compose pull
sudo docker compose up -d --force-recreate --remove-orphans

# 3. Esperar a MariaDB
echo "Esperando a la base de datos..."
sleep 8

# 4. FIX DE PERMISOS (Crítico para Twig y Nginx)
# En serversideup/php:8.4-frankenphp usamos 33:33 (www-data)
echo "Ajustando permisos..."
sudo chown -R 33:33 .
sudo chmod -R 775 .

# 5. Estado básico de servicios
echo "Comprobando estado de contenedores..."
sudo docker compose ps

# 6. Validación de rutas (frankenphp/caddy)
echo "Validando ruta /temperatura dentro del contenedor app..."
sudo docker compose exec -T app-meteo sh -lc '
if command -v curl >/dev/null 2>&1; then
	code=$(curl -s -o /dev/null -w "%{http_code}" http://127.0.0.1:8080/temperatura)
elif command -v wget >/dev/null 2>&1; then
	code=$(wget -S -O /dev/null http://127.0.0.1:8080/temperatura 2>&1 | awk "/HTTP\\// {print \$2}" | tail -n 1)
else
	code=$(php -r "echo (int) preg_match('/200 OK/', implode('', get_headers('http://127.0.0.1:8080/temperatura')) ) ? 200 : 500;")
fi
echo "HTTP /temperatura => $code"
test "$code" = "200"
'

# 7. Si usas migraciones manuales o SQL inicial, cárgalo aquí
# sudo docker exec -i meteo-db mariadb -uorwin -ptu_password_seguro metereologia < backup.sql

echo "✅ Despliegue completado."
echo "URL: http://meteo.orwin.www.servidorgp.somosdelprieto.com"