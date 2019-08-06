<?php
function ps_relative_time($ts) {
    if (!ctype_digit($ts)) {
        $ts = strtotime($ts);
    }

    $diff = time() - $ts;

    if ($diff == 0) {
        return 'agora';
    } elseif ($diff > 0) {
        $day_diff = floor($diff / 86400);

        if ($day_diff == 0) {
            if ($diff < 60) { return 'agora a pouco'; }
            if ($diff < 120) { return 'um minuto atr&aacute;s'; }
            if ($diff < 3600) { return floor($diff / 60) . ' minutos atr&aacute;s'; }
            if ($diff < 7200) { return 'uma hora atr&aacute;s'; }
            if ($diff < 86400) { return floor($diff / 3600) . ' horas atr&aacute;s'; }
        }

        if ($day_diff == 1) { return 'ontem'; }
        if ($day_diff < 7) { return $day_diff . ' dias atr&aacute;s'; }
        if ($day_diff < 31) { return ceil($day_diff / 7) . ' semanas atr&aacute;s'; }
        if ($day_diff < 60) { return 'm&ecirc;s passado'; }
        if ($day_diff >= 60) { return ceil($day_diff / 60) . 'm&ecirc;ses atrás'; }

        return date('F Y', $ts);
    } else {
        $diff = abs($diff);
        $day_diff = floor($diff / 86400);

        if ($day_diff == 0) {
            if ($diff < 120) { return 'em um minuto'; }
            if ($diff < 3600) { return 'em ' . floor($diff / 60) . ' minutos'; }
            if ($diff < 7200) { return 'em uma hora'; }
            if ($diff < 86400) { return 'em ' . floor($diff / 3600) . ' horas'; }
        }

        if ($day_diff == 1) { return 'amanh&atilde;'; }
        if ($day_diff < 4) { return date('l', $ts); }
        if ($day_diff < 7 + (7 - date('w'))) { return 'pr&oacute;xima semana'; }
        if (ceil($day_diff / 7) < 4) { return 'em ' . ceil($day_diff / 7) . ' semanas'; }
        if (date('n', $ts) == date('n') + 1) { return 'pr&oacute;ximo m&ecirc;s'; }

        return date('F Y', $ts);
    }
}
