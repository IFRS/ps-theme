<?php
function ps_relative_past_time($ts) {
    $dias = new DateTime(date('Y-m-d', strtotime($ts)));
    $horas = new DateTime($ts);
    $agora = new DateTime();
    $day_diff = $dias->diff($agora);
    $hour_diff = $horas->diff($agora);

    if ($hour_diff->d == 0) {
        if ($hour_diff->h > 1) {
            return $hour_diff->h . ' horas atr&aacute;s';
        } elseif ($hour_diff->h == 1) {
            return 'uma hora atr&aacute;s';
        } else {
            if ($hour_diff->i > 1) {
                return $hour_diff->i . ' minutos atr&aacute;s';
            } elseif ($hour_diff->i == 1) {
                return 'um minuto atr&aacute;s';
            } else {
                if ($hour_diff->s >= 10) {
                    return 'agora a pouco';
                } else {
                    return 'agora';
                }
            }
        }
    } elseif ($day_diff->d == 1) {
        return 'ontem';
    } elseif ($day_diff->d <= 7) {
        return $day_diff->d . ' dias atr&aacute;s';
    } elseif ($day_diff->d > 7 && $day_diff->m == 0) {
        return ceil($day_day_diff / 7) . ' semanas atr&aacute;s';
    } elseif ($day_diff->m == 1) {
        return 'm&ecirc;s passado';
    } else {
        return $day_diff->m . ' m&ecirc;ses atr&aacute;s';
    }
}
