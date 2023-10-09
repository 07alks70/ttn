<?php

namespace App\Providers;

use App\Actions\Excel\CreateJob;
use App\Contracts\Action\Excel\CreateJobContract;
use App\Contracts\Repositories\RowRepositoryContract;
use App\Repositories\Row\RowRepository;
use App\Services\Excel\Excel;
use App\Services\Excel\Interface\ExcelInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExcelInterface::class, Excel::class);
        $this->app->bind(CreateJobContract::class, CreateJob::class);
        $this->app->bind(RowRepositoryContract::class, RowRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
