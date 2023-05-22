<?php

namespace App\Enums;

enum ServiceStrategy: int
{
    case BimbinganKlasikal = 1;
    case BimbinganKelompok = 2;
    case KonselingIndividual = 3;
    case LintasKelas = 4;
}
