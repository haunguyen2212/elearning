<?php

namespace App\Providers;

use App\Models\Notice;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\ClassRepository;
use App\Repositories\CourseInvolvementRepository;
use App\Repositories\CourseRepository;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\HomeroomTeacherRepository;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\HomeroomTeacherRepositoryInterface;
use App\Repositories\Interfaces\NoticeRepositoryInterface;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use App\Repositories\NoticeRepository;
use App\Repositories\RoomRegistrationRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\TopicDocumentRepository;
use App\Repositories\TopicRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        $this->app->bind(HomeroomTeacherRepositoryInterface::class, HomeroomTeacherRepository::class);
        $this->app->bind(CourseRepositoryInterface::class, CourseRepository::class);
        $this->app->bind(TopicRepositoryInterface::class, TopicRepository::class);
        $this->app->bind(TopicDocumentRepositoryInterface::class, TopicDocumentRepository::class);
        $this->app->bind(CourseInvolvementRepositoryInterface::class, CourseInvolvementRepository::class);
        $this->app->bind(NoticeRepositoryInterface::class, NoticeRepository::class);
        $this->app->bind(RoomRegistrationRepositoryInterface::class, RoomRegistrationRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        if(!$this->app->runningInConsole()){
            $notices = Notice::where('is_show', '1')->get();
            View::share(compact('notices'));
        }
    }
}
