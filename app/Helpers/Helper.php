<?php

function convertStatusVideo($status)
{
    $statusEntry = [
        -2 => 'ERROR_IMPORTING',
        -1 => 'ERROR_CONVERTING',
        0 => 'IMPORT',
        1 => 'PRECONVERT',
        2 => 'READY',
        3 => 'DELETED',
        4 => 'PENDING',
        5 => 'MODERATE',
        6 => 'BLOCKED'
	];

    if (array_key_exists($status, $statusEntry)) {
        return $statusEntry[$status];
    }
    return $statusEntry[-2];
}