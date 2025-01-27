<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job
{
    public static function find($id)
    {
        return Arr::first(static::all(), fn($job) => $job['id'] == $id);
    }

    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Software Engineer',
                'salary' => '$10k',
            ],
            [
                'id' => 2,
                'name' => 'Web Developer',
                'salary' => '$20k',
            ],
            [
                'id' => 3,
                'name' => 'Graphic Designer',
                'salary' => '$30k',
            ],
        ];
    }
}