# CRM Laravel - Sistema de Gestión

## Descripción
Sistema CRM para el proyecto de Laravel con 5 módulos: Clientes, Proveedores, Empleados, Facturas e Incidencias.

## Requisitos
- PHP
- Composer
- MySQL
- XAMPP (o similar)

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/casludx/crm-laravel.git
cd crm-laravel
```

2. Instalar dependencias:
```bash
composer install
```

3. Copiar archivo de configuración:
```bash
cp .env.example .env
```

4. Generar clave de aplicación:
```bash
php artisan key:generate
```

5. Configurar base de datos en `.env`:
```
DB_DATABASE=crm_db
DB_USERNAME=root
DB_PASSWORD=
```

6. Crear base de datos `crm_db` en phpMyAdmin

7. Importar el archivo `crm_db.sql` en phpMyAdmin o ejecutar:
```bash
php artisan migrate
```

8. Iniciar servidor:
```bash
php artisan serve
```

9. Acceder a: http://127.0.0.1:8000

## Módulos
- **Clientes**: Gestión de clientes (nombre, email, teléfono, dirección)
- **Proveedores**: Gestión de proveedores (nombre, empresa, email, teléfono)
- **Empleados**: Gestión de empleados (nombre, puesto, email, salario)
- **Facturas**: Gestión de facturas (número, fecha, cliente, total)
- **Incidencias**: Gestión de incidencias (título, descripción, estado, fecha)

## Tecnologías
- Laravel 11
- PHP 8.1+
- MySQL
- Blade Templates

## Autor
Lucas Flores Benítez