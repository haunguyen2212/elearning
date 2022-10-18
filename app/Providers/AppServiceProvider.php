<?php

namespace App\Providers;

use App\Models\Notice;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\ClassRepository;
use App\Repositories\ClassroomRepository;
use App\Repositories\CourseInvolvementRepository;
use App\Repositories\CourseRepository;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\DepartmentRepository;
use App\Repositories\ExerciseRepository;
use App\Repositories\HomeroomTeacherRepository;
use App\Repositories\Interfaces\ClassroomRepositoryInterface;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use App\Repositories\Interfaces\HomeroomTeacherRepositoryInterface;
use App\Repositories\Interfaces\NoticeRepositoryInterface;
use App\Repositories\Interfaces\RoomAssignmentRepositoryInterface;
use App\Repositories\Interfaces\RoomRegistrationRepositoryInterface;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface;
use App\Repositories\Interfaces\SubmitExerciseRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use App\Repositories\NoticeRepository;
use App\Repositories\RoomAssignmentRepository;
use App\Repositories\RoomRegistrationRepository;
use App\Repositories\RoomRepository;
use App\Repositories\SchoolYearRepository;
use App\Repositories\SubmitExerciseRepository;
use App\Repositories\TeacherRepository;
use App\Repositories\TopicDocumentRepository;
use App\Repositories\TopicRepository;
use Carbon\Carbon;
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
        $this->app->bind(SchoolYearRepositoryInterface::class, SchoolYearRepository::class);
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
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(RoomAssignmentRepositoryInterface::class, RoomAssignmentRepository::class);
        $this->app->bind(ClassroomRepositoryInterface::class, ClassroomRepository::class);
        $this->app->bind(ExerciseRepositoryInterface::class, ExerciseRepository::class);
        $this->app->bind(SubmitExerciseRepositoryInterface::class, SubmitExerciseRepository::class);
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
            $now = Carbon::now()->format('Y-m-d H:i:s');
            $notices = Notice::where('start_time', '<=', $now)->where('end_time', '>=', $now)->get();
            View::share(compact('notices'));
        }
    }
}
