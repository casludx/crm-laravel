# CRM Laravel - Sistema de Gestión (Segunda Entrega)

## Descripción
Sistema CRM desarrollado en Laravel con 5 módulos CRUD: Clientes, Proveedores, Empleados, Facturas e Incidencias.

## Nuevas Funcionalidades (Segunda Entrega)
- ✅ DataTables para listados avanzados con búsqueda y ordenamiento
- ✅ Subida de imágenes (fotos de clientes)
- ✅ Subida de archivos PDF (documentos de proveedores)
- ✅ Sistema de roles: Admin y Usuario
- ✅ Control de permisos (Admin puede eliminar, Usuario solo crear/editar)

## Requisitos
- PHP 
- Composer
- MySQL
- XAMPP (o similar)
- Node.js y npm

## Instalación

1. Clonar el repositorio:
```bash
git clone https://github.com/casludx/crm-laravel.git
cd crm-laravel
```

2. Cambiar a la rama "segunda":
```bash
git checkout segunda
```

3. Instalar dependencias de PHP:
```bash
composer install
```

4. Instalar dependencias de Node.js:
```bash
npm install
npm run build
```

5. Copiar archivo de configuración:
```bash
cp .env.example .env
```

6. Generar clave de aplicación:
```bash
php artisan key:generate
```

7. Configurar base de datos en `.env`:
```
DB_DATABASE=crm_db_v2
DB_USERNAME=root
DB_PASSWORD=
```

8. Crear base de datos `crm_db_v2` en phpMyAdmin

9. Importar el archivo `crm_db_v2.sql` en phpMyAdmin

10. Crear enlace simbólico para storage:
```bash
php artisan storage:link
```

11. Iniciar servidor:
```bash
php artisan serve
```

12. Acceder a: http://127.0.0.1:8000

## Usuarios de Prueba

### Admin (Puede crear, editar y eliminar)
- Email: `admin@admin.com`
- Contraseña: `12345678`

### Usuario Normal (Solo puede crear y editar)
- Email: `usuario@usuario.com`
- Contraseña: `12345678`

## Módulos
- **Clientes**: Gestión de clientes con foto
- **Proveedores**: Gestión de proveedores con documento PDF
- **Empleados**: Gestión de empleados
- **Facturas**: Gestión de facturas
- **Incidencias**: Gestión de incidencias

## Estructura de Roles
- **Admin**: Acceso completo (CRUD completo)
- **Usuario**: Puede crear y editar, pero NO eliminar

## Autor
Lucas