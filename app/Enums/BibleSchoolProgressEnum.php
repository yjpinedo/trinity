<?php

namespace App\Enums;

enum BibleSchoolProgressEnum : string
{
    case SIGNED_UP = 'Inscrito';
    case IN_PROGRESS = 'En curso';
    case FINALIZED = 'Finalizado';
}
