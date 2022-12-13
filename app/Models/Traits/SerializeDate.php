<?php

namespace App\Models\Traits;

trait SerializeDate
{
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
