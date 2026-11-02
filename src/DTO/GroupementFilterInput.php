<?php

namespace App\DTO;

class GroupementFilterInput
{
    public ?string $tel = null;

    public ?string $adresse = null;

    public int $page = 1;

    public int $limit = 5;
}
