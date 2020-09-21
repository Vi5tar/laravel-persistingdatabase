# Persist data throughout a test case.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/vi5tar/laravel-persistingdatabase.svg?style=flat-square)](https://packagist.org/packages/vi5tar/laravel-persistingdatabase)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![GitHub Workflow Status](https://img.shields.io/github/workflow/status/vi5tar/laravel-persistingdatabase/PHP%20Composer?label=build/tests)](https://github.com/vi5tar/laravel-persistingdatabase/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/vi5tar/laravel-persistingdatabase.svg?style=flat-square)](https://packagist.org/packages/vi5tar/laravel-persistingdatabase)

This package provides a trait that can be used on a `Illuminate\Foundation\Testing\TestCase` to setup data
once for the tests in that `TestCase`.

## Notice:
This is an alternative to `Illuminate\Foundation\Testing\RefreshDatabase`. Use one or the other depending on
the needs of the tests.

## Installation
Install via composer:
``` bash
composer require vi5tar/laravel-persistingdatabase
```

## Usage
``` php
use ArticleSeeder;
use PostSeeder;
use Tests\TestCase;
use Vi5tar\PersistingDatabase;

class ExampleTest extends TestCase
{
    use PersistingDatabase;

    public function setupDb(): void
    {
        $this->seed([
            ArticleSeeder::class,
            PostSeeder::class
        ]);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function articleIndexTest()
    {
        $response = $this->get('/articles');

        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function postIndexTest()
    {
        $response = $this->get('/posts');

        $response->assertStatus(200);
    }
}
```