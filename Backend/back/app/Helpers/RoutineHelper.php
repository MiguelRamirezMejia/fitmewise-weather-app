<?php

namespace App\Helpers;

class RoutineHelper
{
    public static function getRecommendation($weather)
    {
        return match(strtolower($weather)) {
            'clear' => 'Ideal para salir a correr al aire libre.',
            'clouds' => 'Perfecto para una caminata tranquila.',
            'rain' => 'Mejor hacer una rutina indoor, como yoga o ejercicios de fuerza.',
            'snow' => 'Haz cardio suave dentro de casa.',
            default => 'Haz lo que puedas en casa, ¡mantente activo!',
        };
    }
}
