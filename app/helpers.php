<?php
function formatAge($age_in_rounds): string
{
    $seconds_per_round = 1;
    $age_in_seconds = $age_in_rounds * $seconds_per_round;

// Convert age in seconds to other units
    $age_in_minutes = $age_in_seconds / 60;
    $age_in_hours = $age_in_minutes / 60;
    $age_in_days = $age_in_hours / 24;

    return floor($age_in_days) . ' days ' . floor($age_in_hours % 24) . ' hours ' . floor($age_in_minutes % 60) . ' minutes ';
}

function formatAgeFromTimestamp($timestamp): string
{
    $age_timestamp = $timestamp;
    $age = time() - $age_timestamp;  // Age in seconds
    $age_in_minutes = floor($age / 60);
    $age_in_hours = floor($age_in_minutes / 60);
    $age_in_days = floor($age_in_hours / 24);

    return $age_in_days . ' days ' . $age_in_hours % 24 . ' hours ' . $age_in_minutes % 60 . ' minutes';
}


function secretString($string): string
{
    return substr($string, 0, 6) . "..." . substr($string, -6);
}
