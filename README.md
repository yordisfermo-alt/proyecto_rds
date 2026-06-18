# API de Gestion de Empleados

API REST en Laravel para administrar empleados, cargos y funciones de cargo. Las rutas CRUD usan autenticacion con Laravel Sanctum.

## Requisitos

- PHP 8.3 o superior
- Composer
- MySQL
- curl

## Instalacion

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```


Configura la base de datos en el archivo `.env`:

```.env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_3066552
DB_USERNAME=root
DB_PASSWORD=
```

Crea la base de datos desde una pestaña de query en MySQL Workbench:

```sql
CREATE DATABASE IF NOT EXISTS db_3066552;
```

Ejecuta migraciones y datos iniciales:

```bash
php artisan migrate:fresh --seed
```

Esto crea:

- 40 cargos
- 30 empleados
- 5 funciones por cada cargo

## Registrar Usuario

```bash
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name":"Admin","email":"admin@example.com","password":"password123"}'
```

## Iniciar Servidor

```bash
php artisan serve
```

La API queda disponible en:

```txt
http://127.0.0.1:8000/api
```

## Resumen de Rutas

| Metodo | Ruta | Descripcion |
| --- | --- | --- |
| POST | `/api/register` | Registrar usuario |
| POST | `/api/login` | Iniciar sesion |
| POST | `/api/logout` | Cerrar sesion |
| GET | `/api/me` | Ver usuario autenticado |
| GET | `/api/empleados` | Listar empleados |
| GET | `/api/empleados/{id}` | Ver un empleado |
| POST | `/api/empleados` | Crear empleado |
| PUT | `/api/empleados/{id}` | Actualizar empleado |
| DELETE | `/api/empleados/{id}` | Eliminar empleado |
| GET | `/api/cargos` | Listar cargos |
| POST | `/api/cargos` | Crear cargo |
| PUT | `/api/cargos/{id}` | Actualizar cargo |
| DELETE | `/api/cargos/{id}` | Eliminar cargo |
| GET | `/api/funciones-cargo` | Listar funciones de cargo |
| POST | `/api/funciones-cargo` | Crear funcion de cargo |
| PUT | `/api/funciones-cargo/{id}` | Actualizar funcion de cargo |
| DELETE | `/api/funciones-cargo/{id}` | Eliminar funcion de cargo |

Los listados aceptan paginacion con `page` y `per_page`:

```txt
?page=1&per_page=10
```

## Autenticacion con curl

Inicia sesion:

```bash
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"email":"admin@example.com","password":"password123"}'
```

Copia el valor de `data.token` y guardalo:

```bash
TOKEN="PEGA_AQUI_EL_TOKEN"
```

Todas las rutas protegidas deben enviar este header:

```bash
-H "Authorization: Bearer $TOKEN"
```

## Empleados

Listar empleados:

```bash
curl http://127.0.0.1:8000/api/empleados \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Listar empleados paginados:

```bash
curl "http://127.0.0.1:8000/api/empleados?page=1&per_page=10" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Ver un empleado:

```bash
curl http://127.0.0.1:8000/api/empleados/1 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Crear empleado:

```bash
curl -X POST http://127.0.0.1:8000/api/empleados \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -d '{"nombres":"Juan","apellidos":"Perez","fecha_nacimiento":"1995-05-10","fecha_ingreso":"2024-01-15","salario":2500000,"estado":true,"id_cargo":1}'
```

Actualizar empleado:

```bash
curl -X PUT http://127.0.0.1:8000/api/empleados/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -d '{"salario":3000000}'
```

Eliminar empleado:

```bash
curl -X DELETE http://127.0.0.1:8000/api/empleados/1 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

## Cargos

Listar cargos:

```bash
curl http://127.0.0.1:8000/api/cargos \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Listar cargos paginados:

```bash
curl "http://127.0.0.1:8000/api/cargos?page=1&per_page=10" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Crear cargo:

```bash
curl -X POST http://127.0.0.1:8000/api/cargos \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -d '{"nombre_cargo":"Coordinador de Servicio","descripcion":"Coordina la atencion y seguimiento de solicitudes"}'
```

Actualizar cargo:

```bash
curl -X PUT http://127.0.0.1:8000/api/cargos/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -d '{"descripcion":"Descripcion actualizada"}'
```

Eliminar cargo:

```bash
curl -X DELETE http://127.0.0.1:8000/api/cargos/1 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

## Funciones de Cargo

Listar funciones:

```bash
curl http://127.0.0.1:8000/api/funciones-cargo \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Listar funciones paginadas:

```bash
curl "http://127.0.0.1:8000/api/funciones-cargo?page=1&per_page=10" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Crear funcion:

```bash
curl -X POST http://127.0.0.1:8000/api/funciones-cargo \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -d '{"descripcion_funcion":"Revisar reportes del area","estado":true,"id_cargo":1}'
```

Actualizar funcion:

```bash
curl -X PUT http://127.0.0.1:8000/api/funciones-cargo/1 \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $TOKEN" \
  -d '{"estado":false}'
```

Eliminar funcion:

```bash
curl -X DELETE http://127.0.0.1:8000/api/funciones-cargo/1 \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

## Usuario Autenticado

Ver usuario actual:

```bash
curl http://127.0.0.1:8000/api/me \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

Cerrar sesion:

```bash
curl -X POST http://127.0.0.1:8000/api/logout \
  -H "Accept: application/json" \
  -H "Authorization: Bearer $TOKEN"
```

## Comandos Utiles

Ver rutas de la API:

```bash
php artisan route:list --path=api
```

Ejecutar pruebas:

```bash
php artisan test tests/Feature/Api
```

## Errores Comunes

- `401 Unauthorized`: falta el token o el token es incorrecto.
- `422 Unprocessable Content`: faltan campos o hay datos invalidos.
- `405 Method Not Allowed`: el metodo HTTP no corresponde a la ruta.
- Error de base de datos: revisa el `.env` y confirma que MySQL este activo.
