<?php

namespace App\Enum;

enum Category: string
{
    case DEVELOPMENT_BACK = 'Développement Web - Back';
    case DEVELOPMENT_FRONT = 'Développement Web - Front';
    case WEBMARKETING = 'Webmarketing';
    case DEVOPS = 'Devops';
    case COMMUNICATION = 'Communication';
    case PROJECT_MANAGEMENT = 'Gestion de projet';
    case OTHER = 'Autre';
}