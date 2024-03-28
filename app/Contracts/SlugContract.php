<?php

// app/Contracts/SlugGenerator.php

namespace App\Contracts;

interface SlugContract
{
    public function generateUniqueSlug($model);
}
