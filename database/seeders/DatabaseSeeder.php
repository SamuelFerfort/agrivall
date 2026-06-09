<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\TipoPost;
use App\Models\PostBlog;
use App\Models\SemanaCasilla;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Si ya hay datos no volvemos a sembrar (el seed corre en cada deploy).
        if (User::where('email', 'admin@agrivall.com')->exists()) {
            return;
        }

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@agrivall.com',
            'password' => bcrypt('password'),
        ]);

        $productos = [
            ['nombre' => 'Aceite de Oliva Virgen Extra', 'variedad' => 'Arbequina', 'formato' => '1L botella', 'precio' => 12.50, 'disponible' => true, 'imagen' => 'productos/aceite-oliva.jpg'],
            ['nombre' => 'Aceite de Oliva Virgen Extra', 'variedad' => 'Picual', 'formato' => '5L garrafa', 'precio' => 45.00, 'disponible' => true, 'imagen' => 'productos/aceite-oliva-5l.jpg'],
            ['nombre' => 'Miel de Romero', 'variedad' => 'Romero', 'formato' => '500g tarro', 'precio' => 8.90, 'disponible' => true, 'imagen' => 'productos/miel-romero.jpg'],
            ['nombre' => 'Miel de Azahar', 'variedad' => 'Azahar', 'formato' => '500g tarro', 'precio' => 9.50, 'disponible' => true, 'imagen' => 'productos/miel-azahar.jpg'],
            ['nombre' => 'Almendras Tostadas', 'variedad' => 'Marcona', 'formato' => '250g bolsa', 'precio' => 6.75, 'disponible' => true, 'imagen' => 'productos/almendras-tostadas.jpg'],
            ['nombre' => 'Almendras Crudas', 'variedad' => 'Largueta', 'formato' => '1kg bolsa', 'precio' => 18.00, 'disponible' => false, 'imagen' => 'productos/almendras-crudas.jpg'],
            ['nombre' => 'Mermelada de Naranja', 'variedad' => 'Naranja amarga', 'formato' => '350g tarro', 'precio' => 5.20, 'disponible' => true, 'imagen' => 'productos/mermelada-naranja.jpg'],
            ['nombre' => 'Mermelada de Higo', 'variedad' => 'Higo', 'formato' => '350g tarro', 'precio' => 5.50, 'disponible' => true, 'imagen' => 'productos/mermelada-higo.jpg'],
            ['nombre' => 'Vino Tinto Crianza', 'variedad' => 'Monastrell', 'formato' => '750ml botella', 'precio' => 14.00, 'disponible' => true, 'imagen' => 'productos/vino-tinto.jpg'],
            ['nombre' => 'Vino Blanco Joven', 'variedad' => 'Moscatel', 'formato' => '750ml botella', 'precio' => 9.00, 'disponible' => true, 'imagen' => 'productos/vino-blanco.jpg'],
        ];

        foreach ($productos as $p) {
            Producto::create($p);
        }

        $pedido1 = Pedido::create([
            'fecha_pedido' => '2026-02-15',
            'nombre_cliente' => 'María García López',
            'tlf_cliente' => '612345678',
            'email_cliente' => 'maria.garcia@email.com',
            'direccion_envio' => 'Calle Mayor 15, 46001 Valencia',
            'metodo_pago' => 'transferencia',
            'estado' => 'reparto',
            'precio_pedido' => 26.40,
        ]);
        $pedido1->productos()->attach(1, ['cantidad' => 2, 'formato' => '1L botella', 'precio_unitario' => 12.50]);
        $pedido1->productos()->attach(7, ['cantidad' => 1, 'formato' => '350g tarro', 'precio_unitario' => 5.20]);

        $pedido2 = Pedido::create([
            'fecha_pedido' => '2026-02-18',
            'nombre_cliente' => 'Juan Martínez Pérez',
            'tlf_cliente' => '698765432',
            'email_cliente' => 'juan.martinez@email.com',
            'direccion_envio' => 'Avda. del Puerto 42, 46023 Valencia',
            'metodo_pago' => 'bizum',
            'estado' => 'iniciado',
            'precio_pedido' => 63.00,
        ]);
        $pedido2->productos()->attach(2, ['cantidad' => 1, 'formato' => '5L garrafa', 'precio_unitario' => 45.00]);
        $pedido2->productos()->attach(5, ['cantidad' => 2, 'formato' => '250g bolsa', 'precio_unitario' => 6.75]);

        $tipoCultivos = TipoPost::create(['tipo' => 'Cultivos']);
        $tipoEcologia = TipoPost::create(['tipo' => 'Ecología']);
        $tipoCursos = TipoPost::create(['tipo' => 'Cursos']);

        PostBlog::create([
            'titulo' => 'Nueva cosecha de aceitunas 2026',
            'noticia' => 'Este año la cosecha de aceitunas ha sido excepcional. Las lluvias de otoño y el clima templado han favorecido una producción de alta calidad. Nuestro aceite de oliva virgen extra de esta temporada tiene un sabor afrutado intenso con notas de almendra verde.',
            'fecha_public' => '2026-01-15',
            'tipo_post_id' => $tipoCultivos->id,
        ]);
        PostBlog::create([
            'titulo' => 'Jornada de puertas abiertas en la finca',
            'noticia' => 'El próximo sábado 8 de marzo celebramos una jornada de puertas abiertas. Podrás visitar nuestros campos de olivos, la almazara y degustar nuestros productos. Actividades para toda la familia con talleres de elaboración de mermeladas artesanales.',
            'fecha_public' => '2026-02-01',
            'tipo_post_id' => $tipoCursos->id,
        ]);
        PostBlog::create([
            'titulo' => 'Receta: Tosta de queso con miel de romero',
            'noticia' => 'Una receta sencilla y deliciosa: tuesta unas rebanadas de pan de pueblo, añade queso de cabra fresco, un chorrito de nuestra miel de romero y unas almendras Marcona tostadas por encima. El maridaje perfecto con nuestro vino blanco Moscatel.',
            'fecha_public' => '2026-02-10',
            'tipo_post_id' => $tipoCultivos->id,
        ]);
        PostBlog::create([
            'titulo' => 'Premiados en la Feria Agroalimentaria de Castellón',
            'noticia' => 'Estamos orgullosos de anunciar que nuestro Aceite de Oliva Virgen Extra variedad Arbequina ha sido galardonado con la medalla de oro en la Feria Agroalimentaria de Castellón 2026. Un reconocimiento al trabajo y dedicación de todo el equipo.',
            'fecha_public' => '2026-02-20',
            'tipo_post_id' => $tipoEcologia->id,
        ]);

        // Semanas desde la actual hasta el final del anyo.
        $meses = [1 => 'Ene', 2 => 'Feb', 3 => 'Mar', 4 => 'Abr', 5 => 'May', 6 => 'Jun',
                  7 => 'Jul', 8 => 'Ago', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dic'];

        $cursor = now()->startOfWeek(\Carbon\Carbon::MONDAY); // lunes de la semana actual
        $anyoActual = (int) now()->year;
        $i = 0;

        while ((int) $cursor->year <= $anyoActual) {
            $fin = $cursor->copy()->endOfWeek(\Carbon\Carbon::SUNDAY); // domingo

            // Mezcla de estados de ejemplo.
            $estado = 'disponible';
            if ($i % 6 === 2) {
                $estado = 'reservado';
            } elseif ($i % 9 === 4) {
                $estado = 'pre-reserva';
            } elseif ($i % 13 === 7) {
                $estado = 'no disponible';
            }

            // Precio por temporada (0 si no disponible).
            $precio = in_array($cursor->month, [7, 8]) ? 700
                : (in_array($cursor->month, [6, 9]) ? 500 : 350);
            if ($estado === 'no disponible') {
                $precio = 0;
            }

            SemanaCasilla::create([
                'anyo' => (int) $cursor->year,
                'numero_sem' => (int) $cursor->isoWeek,
                'descriptor' => $cursor->day . ' ' . $meses[$cursor->month] . ' - ' . $fin->day . ' ' . $meses[$fin->month],
                'precio' => $precio,
                'estado' => $estado,
            ]);

            $cursor->addWeek();
            $i++;
        }
    }
}
