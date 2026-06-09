<?php

namespace Tests\Feature;

use App\Mail\PedidoConfirmado;
use App\Mail\PedidoNotificacionAdmin;
use App\Mail\ReservaNotificacionAdmin;
use App\Models\Producto;
use App\Models\SemanaCasilla;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FlujosTest extends TestCase
{
    use RefreshDatabase;

    public function test_reserva_casa_rural_deja_la_semana_en_pre_reserva_y_avisa_al_admin(): void
    {
        Mail::fake();

        $semana = SemanaCasilla::create([
            'anyo' => 2026,
            'numero_sem' => 24,
            'descriptor' => '8 Jun - 14 Jun',
            'precio' => 500,
            'estado' => 'disponible',
        ]);

        $response = $this->post('/casa-rural/reservar', [
            'semana_id' => $semana->id,
            'nombre' => 'Juan Test',
            'email' => 'juan@test.com',
            'tlf' => '612000000',
            'observaciones' => 'Somos 4 personas',
        ]);

        $response->assertRedirect(route('casa-rural.index'));
        $response->assertSessionHas('success');
        $this->assertSame('pre-reserva', $semana->fresh()->estado);
        Mail::assertSent(ReservaNotificacionAdmin::class);
    }

    public function test_no_se_puede_reservar_una_semana_no_disponible(): void
    {
        Mail::fake();

        $semana = SemanaCasilla::create([
            'anyo' => 2026,
            'numero_sem' => 25,
            'descriptor' => '15 Jun - 21 Jun',
            'precio' => 500,
            'estado' => 'reservado',
        ]);

        $response = $this->post('/casa-rural/reservar', [
            'semana_id' => $semana->id,
            'nombre' => 'Juan Test',
            'email' => 'juan@test.com',
        ]);

        $response->assertSessionHas('error');
        $this->assertSame('reservado', $semana->fresh()->estado);
        Mail::assertNothingSent();
    }

    public function test_checkout_crea_pedido_iniciado_y_envia_dos_correos(): void
    {
        Mail::fake();

        $producto = Producto::create([
            'nombre' => 'Aceite Test',
            'variedad' => 'Arbequina',
            'formato' => '1L botella',
            'precio' => 10.00,
            'disponible' => true,
        ]);

        $response = $this->withSession([
            'cart' => [
                $producto->id => [
                    'nombre' => 'Aceite Test',
                    'precio' => 10.00,
                    'formato' => '1L botella',
                    'cantidad' => 2,
                ],
            ],
        ])->post('/carrito/checkout', [
            'nombre_cliente' => 'Maria Test',
            'tlf_cliente' => '600000000',
            'email_cliente' => 'maria@test.com',
            'direccion_envio' => 'Calle Mayor 1, Valencia',
            'metodo_pago' => 'transferencia',
        ]);

        $response->assertRedirect(route('home'));
        $this->assertDatabaseHas('pedidos', [
            'email_cliente' => 'maria@test.com',
            'estado' => 'iniciado',
            'precio_pedido' => 20.00,
        ]);
        $this->assertDatabaseHas('linea_pedido', [
            'producto_id' => $producto->id,
            'cantidad' => 2,
            'precio_unitario' => 10.00,
        ]);
        Mail::assertSent(PedidoConfirmado::class);
        Mail::assertSent(PedidoNotificacionAdmin::class);
    }

    public function test_las_paginas_del_backoffice_renderizan(): void
    {
        $user = User::factory()->create();

        foreach ([
            '/admin/dashboard',
            '/admin/pedidos',
            '/admin/semanas',
            '/admin/productos',
            '/admin/posts',
            '/admin/posts/create',
            '/admin/tipo-posts',
        ] as $url) {
            $this->actingAs($user)->get($url)->assertOk();
        }
    }
}
