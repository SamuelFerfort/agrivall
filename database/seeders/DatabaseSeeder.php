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
            'metodo_pago' => 'tarjeta',
            'estado' => 'enviado',
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
            'metodo_pago' => 'transferencia',
            'estado' => 'pendiente',
            'precio_pedido' => 63.00,
        ]);
        $pedido2->productos()->attach(2, ['cantidad' => 1, 'formato' => '5L garrafa', 'precio_unitario' => 45.00]);
        $pedido2->productos()->attach(5, ['cantidad' => 2, 'formato' => '250g bolsa', 'precio_unitario' => 6.75]);

        $tipoNoticias = TipoPost::create(['tipo' => 'Noticias']);
        $tipoEventos = TipoPost::create(['tipo' => 'Eventos']);
        $tipoRecetas = TipoPost::create(['tipo' => 'Recetas']);

        PostBlog::create([
            'titulo' => 'Nueva cosecha de aceitunas 2026',
            'noticia' => 'Este año la cosecha de aceitunas ha sido excepcional. Las lluvias de otoño y el clima templado han favorecido una producción de alta calidad. Nuestro aceite de oliva virgen extra de esta temporada tiene un sabor afrutado intenso con notas de almendra verde.',
            'fecha_public' => '2026-01-15',
            'tipo_post_id' => $tipoNoticias->id,
        ]);
        PostBlog::create([
            'titulo' => 'Jornada de puertas abiertas en la finca',
            'noticia' => 'El próximo sábado 8 de marzo celebramos una jornada de puertas abiertas. Podrás visitar nuestros campos de olivos, la almazara y degustar nuestros productos. Actividades para toda la familia con talleres de elaboración de mermeladas artesanales.',
            'fecha_public' => '2026-02-01',
            'tipo_post_id' => $tipoEventos->id,
        ]);
        PostBlog::create([
            'titulo' => 'Receta: Tosta de queso con miel de romero',
            'noticia' => 'Una receta sencilla y deliciosa: tuesta unas rebanadas de pan de pueblo, añade queso de cabra fresco, un chorrito de nuestra miel de romero y unas almendras Marcona tostadas por encima. El maridaje perfecto con nuestro vino blanco Moscatel.',
            'fecha_public' => '2026-02-10',
            'tipo_post_id' => $tipoRecetas->id,
        ]);
        PostBlog::create([
            'titulo' => 'Premiados en la Feria Agroalimentaria de Castellón',
            'noticia' => 'Estamos orgullosos de anunciar que nuestro Aceite de Oliva Virgen Extra variedad Arbequina ha sido galardonado con la medalla de oro en la Feria Agroalimentaria de Castellón 2026. Un reconocimiento al trabajo y dedicación de todo el equipo.',
            'fecha_public' => '2026-02-20',
            'tipo_post_id' => $tipoNoticias->id,
        ]);

        $semanas = [
            ['anyo' => 2026, 'numero_sem' => 1, 'descriptor' => '29 Dic - 4 Ene', 'precio' => 350.00, 'estado' => 'reservada'],
            ['anyo' => 2026, 'numero_sem' => 2, 'descriptor' => '5 Ene - 11 Ene', 'precio' => 300.00, 'estado' => 'reservada'],
            ['anyo' => 2026, 'numero_sem' => 10, 'descriptor' => '2 Mar - 8 Mar', 'precio' => 320.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 11, 'descriptor' => '9 Mar - 15 Mar', 'precio' => 350.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 12, 'descriptor' => '16 Mar - 22 Mar', 'precio' => 380.00, 'estado' => 'reservada'],
            ['anyo' => 2026, 'numero_sem' => 13, 'descriptor' => '23 Mar - 29 Mar', 'precio' => 400.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 14, 'descriptor' => '30 Mar - 5 Abr', 'precio' => 450.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 15, 'descriptor' => '6 Abr - 12 Abr', 'precio' => 500.00, 'estado' => 'reservada'],
            ['anyo' => 2026, 'numero_sem' => 25, 'descriptor' => '15 Jun - 21 Jun', 'precio' => 550.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 26, 'descriptor' => '22 Jun - 28 Jun', 'precio' => 600.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 30, 'descriptor' => '20 Jul - 26 Jul', 'precio' => 700.00, 'estado' => 'reservada'],
            ['anyo' => 2026, 'numero_sem' => 31, 'descriptor' => '27 Jul - 2 Ago', 'precio' => 700.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 32, 'descriptor' => '3 Ago - 9 Ago', 'precio' => 750.00, 'estado' => 'disponible'],
            ['anyo' => 2026, 'numero_sem' => 33, 'descriptor' => '10 Ago - 16 Ago', 'precio' => 750.00, 'estado' => 'reservada'],
            ['anyo' => 2026, 'numero_sem' => 34, 'descriptor' => '17 Ago - 23 Ago', 'precio' => 700.00, 'estado' => 'disponible'],
        ];

        foreach ($semanas as $s) {
            SemanaCasilla::create($s);
        }
    }
}
