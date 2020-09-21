<?php

namespace Vi5tar;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;

trait WithDatabaseAwareFaker
{
    use WithFaker;

    public function getUniqueProperty(string $table, string $column, string $property)
    {
        $value = $this->faker->$property;
        while (DB::table($table)->where($column, $value)->exists()) {
            $value = $this->faker->$property;
        }
        return $value;
    }
}