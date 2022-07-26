<?php

namespace App\Providers;

use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\ClassRepository;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\TeacherRepository;
use App\Services\ClassManagementService;
use App\Services\DepartmentManagementService;
use App\Services\Interfaces\ClassManagementServiceInterface;
use App\Services\Interfaces\DepartmentManagementServiceInterface;
use App\Services\Interfaces\StudentManagementServiceInterface;
use App\Services\Interfaces\TeacherManagementServiceInterface;
use App\Services\StudentManagementService;
use App\Services\TeacherManagementService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(ClassRepositoryInterface::class, ClassRepository::class);
        $this->app->bind(TeacherRepositoryInterface::class, TeacherRepository::class);
        $this->app->bind(DepartmentRepositoryInterface::class, DepartmentRepository::class);

        $this->app->bind(StudentManagementServiceInterface::class, StudentManagementService::class);
        $this->app->bind(ClassManagementServiceInterface::class, ClassManagementService::class);
        $this->app->bind(TeacherManagementServiceInterface::class, TeacherManagementService::class);
        $this->app->bind(DepartmentManagementServiceInterface::class, DepartmentManagementService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
