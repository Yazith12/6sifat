<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

namespace App\Services;

use Supabase\Supabase;

class SupabaseService
{
    protected $supabase;

    public function __construct()
    {
        $this->supabase = new Supabase(
            env('SUPABASE_URL'), 
            env('SUPABASE_KEY')
        );
    }

    // Add your Supabase methods here
    public function getTable($table)
    {
        return $this->supabase->from($table)->select('*');
    }
}
