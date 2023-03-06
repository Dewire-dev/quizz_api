<?php

namespace App\Enum;

enum QuizzParticipantStatus: string
{
    case READY = 'Prêt';
    case PENDING = 'En attente de réponse';
    case IN_PROGRESS = 'A répondu';
    case LEFT = 'A quitté';
    case FINISHED = 'A terminé';
}