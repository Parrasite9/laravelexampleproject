<?php

namespace App\Models;

use Illuminate\Support\Arr;

class Job {
    public static function all(): array
    {
       return [
            [
                'id' => 1,
                'title' => 'Directory',
                'salary' => '$500,000'
            ],
            [
                'id' => 2,
                'title' => 'Programmer',
                'salary' => '$200,000'
            ],
            [
                'id' => 3,
                'title' => 'Teacher',
                'salary' => '$50,000'
            ]
        ];
    }

    public static function find(int $id)
    {
        $job = Arr::first(static::all(), fn($job) => $job['id'] == $id);
        abort_if(! $job, 404);
    }
 }