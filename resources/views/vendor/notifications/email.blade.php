<x-mail::message>
{{-- Asunto del correo --}}
@slot('subject')
    Recuperar Contraseña
@endslot

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@elseif ($level === 'error')
# @lang('¡Vaya!')
@else
# @lang('¡Hola!')
@endif

{{-- Intro Lines --}}
<p>Recibiste este correo porque solicitaste un cambio de contraseña para tu cuenta.</p>

{{-- Action Button --}}
@isset($actionText)
<?php
    // Compatibilidad para PHP 8.0 o superior.
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
    {{ $actionText }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
<p>Este enlace para restablecer la contraseña expirará en 60 minutos.</p>
<p>Si no solicitaste el cambio de contraseña, no es necesario realizar ninguna acción.</p>

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang('Saludos,')<br>
{{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot name="subcopy">
    @lang(
        "Si tienes problemas para hacer clic en el botón \":actionText\", copia y pega la URL abajo\n".
        'en tu navegador web:',
        [
            'actionText' => $actionText,
        ]
    ) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
</x-slot>
@endisset
</x-mail::message>
