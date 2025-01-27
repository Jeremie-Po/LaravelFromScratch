<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job
{
    public static function find($id)
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);

        if (!$job) {
            abort(404);
        }

        return $job;
    }

    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Software Engineer',
                'salary' => '$10k',
            ],
            [
                'id' => 2,
                'title' => 'Web Developer',
                'salary' => '$20k',
            ],
            [
                'id' => 3,
                'title' => 'Graphic Designer',
                'salary' => '$30k',
            ],
        ];
    }
}