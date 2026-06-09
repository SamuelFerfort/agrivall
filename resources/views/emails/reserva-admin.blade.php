<x-mail::message>
# Nueva solicitud de reserva

Un cliente ha solicitado reservar una semana de la casa rural. La semana ha quedado en estado **PRE-RESERVA**.

- **Semana:** {{ $semana->numero_sem }} - {{ $semana->descriptor }} ({{ $semana->anyo }})
- **Precio:** {{ number_format($semana->precio, 2, ',', '.') }} €
- **Cliente:** {{ $nombre }}
- **Email:** {{ $email }}
- **Telefono:** {{ $tlf ?? '-' }}

**Observaciones:**

{{ $observaciones ?? 'Sin observaciones.' }}

<x-mail::button :url="route('admin.semanas.edit', $semana)">
Gestionar reserva en el panel
</x-mail::button>

Recuerda cambiar el estado a **RESERVADO** cuando se confirme el pago, o de nuevo a **DISPONIBLE** si no se completa la reserva.
</x-mail::message>
