<?php

namespace App\Helpers;

class RoutineHelper
{
    public static function getRecommendation(string $weather): string
    {
        $w = strtolower($weather);

        // Buscamos palabras clave en español
        if (str_contains($w, 'despejado') || str_contains($w, 'claro')) {
            return '¡Un día perfecto bajo el sol! Sal a correr o haz una sesión de ejercicio al aire libre.';
        }

        if (str_contains($w, 'nube')) {
            return '¡No dejes que las nubes te frenen! Aprovecha la temperatura fresca para un trote más cómodo al aire libre.';
        }

        if (str_contains($w, 'llovizna')) {
            return 'Una llovizna ligera invita a un entrenamiento suave: yoga, estiramientos o pilates en interior.';
        }

        if (str_contains($w, 'lluvia')) {
            return 'Mejor haz tu rutina indoor: circuito de fuerza, HIIT o cardio en casa.';
        }

        if (str_contains($w, 'tormenta')) {
            return 'Tormenta afuera, ¡seguridad primero! Cardio suave o ejercicios de movilidad dentro de casa.';
        }

        if (str_contains($w, 'nieve')) {
            return '¡Nieve afuera! Rutina de bajo impacto en casa: sentadillas, planchas y estiramientos.';
        }

        if (str_contains($w, 'niebla')) {
            return 'La visibilidad baja no es excusa: haz un entrenamiento de fuerza o flexibilidad en interior.';
        }

        if (str_contains($w, 'neblina')) {
            return 'NeBlina afuera, mejor aprovecha para un circuito de core y estiramientos dentro.';
        }

        if (str_contains($w, 'humo')) {
            return 'Calidad de aire baja: opta por ejercicios en interior con ventilación.';
        }

        if (str_contains($w, 'calina') || str_contains($w, 'bruma')) {
            return 'Bruma y calina reducen visibilidad: rutina indoor enfocada en técnica y fuerza.';
        }

        if (str_contains($w, 'polvo')) {
            return 'Polvo en suspensión: mantente activo en casa con un entrenamiento de peso corporal.';
        }

        if (str_contains($w, 'arena')) {
            return 'Tormenta de arena: mejor no salgas, haz circuitos de piernas y brazos en interior.';
        }

        if (str_contains($w, 'ceniza')) {
            return 'Ceniza volcánica en el aire: ¡ejercicios de bajo impacto dentro de casa!';
        }

        if (str_contains($w, 'ráfagas')) {
            return 'Ráfagas fuertes: rutina estable de core y estiramientos en interior.';
        }

        if (str_contains($w, 'tornado')) {
            return 'Condiciones extremas, evita el exterior: sesión de yoga o meditación activa en casa.';
        }
        // Si no coincide ninguna clave
        return '¡Mantente activo con lo que tengas a mano en casa!';
    }
}
