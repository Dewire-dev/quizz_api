<?php

namespace App\Enum;

enum QuizLaunchStatus: string
{
    case LAUNCHING = 'En lancement';
    case PENDING = 'En attente';
    case IN_PROGRESS = 'En cours';
    case CANCELED = 'Annulé';
    case FINISHED = 'Terminé';
}