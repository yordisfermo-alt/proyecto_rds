<?php

namespace Database\Seeders;

use App\Models\Cargo;
use Illuminate\Database\Seeder;

class CargoSeeder extends Seeder
{
    public function run(): void
    {
        $cargos = [
            ['nombre_cargo' => 'Gerente General', 'descripcion' => 'Dirige la estrategia general de la empresa'],
            ['nombre_cargo' => 'Subgerente Administrativo', 'descripcion' => 'Apoya la gestion administrativa y operativa'],
            ['nombre_cargo' => 'Director Financiero', 'descripcion' => 'Gestiona los recursos financieros de la empresa'],
            ['nombre_cargo' => 'Contador', 'descripcion' => 'Registra y controla la informacion contable'],
            ['nombre_cargo' => 'Auxiliar Contable', 'descripcion' => 'Apoya los procesos contables diarios'],
            ['nombre_cargo' => 'Jefe de Recursos Humanos', 'descripcion' => 'Coordina la gestion del talento humano'],
            ['nombre_cargo' => 'Analista de Recursos Humanos', 'descripcion' => 'Apoya procesos de seleccion y bienestar laboral'],
            ['nombre_cargo' => 'Coordinador de Nomina', 'descripcion' => 'Administra pagos y novedades de nomina'],
            ['nombre_cargo' => 'Jefe de Sistemas', 'descripcion' => 'Lidera los proyectos y servicios tecnologicos'],
            ['nombre_cargo' => 'Analista de Sistemas', 'descripcion' => 'Analiza e implementa soluciones tecnologicas'],
            ['nombre_cargo' => 'Desarrollador Backend', 'descripcion' => 'Construye servicios y logica del sistema'],
            ['nombre_cargo' => 'Desarrollador Frontend', 'descripcion' => 'Construye interfaces para los usuarios'],
            ['nombre_cargo' => 'Tecnico de Soporte', 'descripcion' => 'Atiende incidentes y solicitudes tecnicas'],
            ['nombre_cargo' => 'Administrador de Base de Datos', 'descripcion' => 'Administra la informacion y disponibilidad de datos'],
            ['nombre_cargo' => 'Coordinador Comercial', 'descripcion' => 'Coordina la gestion de ventas y clientes'],
            ['nombre_cargo' => 'Asesor Comercial', 'descripcion' => 'Atiende clientes y gestiona oportunidades de venta'],
            ['nombre_cargo' => 'Ejecutivo de Cuenta', 'descripcion' => 'Gestiona relaciones con clientes empresariales'],
            ['nombre_cargo' => 'Jefe de Mercadeo', 'descripcion' => 'Define estrategias de promocion y posicionamiento'],
            ['nombre_cargo' => 'Analista de Mercadeo', 'descripcion' => 'Analiza campanas y comportamiento del mercado'],
            ['nombre_cargo' => 'Disenador Grafico', 'descripcion' => 'Crea piezas visuales para comunicacion interna y externa'],
            ['nombre_cargo' => 'Coordinador de Operaciones', 'descripcion' => 'Coordina actividades operativas de la empresa'],
            ['nombre_cargo' => 'Supervisor de Produccion', 'descripcion' => 'Supervisa procesos y equipos de produccion'],
            ['nombre_cargo' => 'Operario de Produccion', 'descripcion' => 'Ejecuta actividades del proceso productivo'],
            ['nombre_cargo' => 'Jefe de Calidad', 'descripcion' => 'Controla el cumplimiento de estandares de calidad'],
            ['nombre_cargo' => 'Inspector de Calidad', 'descripcion' => 'Verifica productos, procesos y registros de calidad'],
            ['nombre_cargo' => 'Coordinador Logistico', 'descripcion' => 'Coordina transporte, almacenamiento y entregas'],
            ['nombre_cargo' => 'Auxiliar Logistico', 'descripcion' => 'Apoya recepcion, despacho e inventario'],
            ['nombre_cargo' => 'Jefe de Compras', 'descripcion' => 'Gestiona proveedores y adquisiciones'],
            ['nombre_cargo' => 'Analista de Compras', 'descripcion' => 'Cotiza y da seguimiento a ordenes de compra'],
            ['nombre_cargo' => 'Almacenista', 'descripcion' => 'Controla entradas y salidas de inventario'],
            ['nombre_cargo' => 'Recepcionista', 'descripcion' => 'Atiende visitantes, llamadas y correspondencia'],
            ['nombre_cargo' => 'Asistente Administrativo', 'descripcion' => 'Apoya tareas administrativas y documentales'],
            ['nombre_cargo' => 'Secretaria Ejecutiva', 'descripcion' => 'Asiste a la direccion en agenda y comunicaciones'],
            ['nombre_cargo' => 'Mensajero', 'descripcion' => 'Realiza entregas y tramites externos'],
            ['nombre_cargo' => 'Conductor', 'descripcion' => 'Transporta personal, documentos o mercancia'],
            ['nombre_cargo' => 'Coordinador de Seguridad', 'descripcion' => 'Coordina medidas de seguridad fisica y preventiva'],
            ['nombre_cargo' => 'Vigilante', 'descripcion' => 'Controla accesos y reporta novedades de seguridad'],
            ['nombre_cargo' => 'Jefe Juridico', 'descripcion' => 'Gestiona asuntos legales y contractuales'],
            ['nombre_cargo' => 'Abogado', 'descripcion' => 'Apoya procesos legales y revision de documentos'],
            ['nombre_cargo' => 'Auditor Interno', 'descripcion' => 'Evalua controles, procesos y cumplimiento interno'],
        ];

        foreach ($cargos as $cargo) {
            Cargo::create($cargo);
        }
    }
}
