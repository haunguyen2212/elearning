<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExerciseRequest;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ExerciseTeacherController extends Controller
{
    private $exercise;

    public function __construct(
        ExerciseRepositoryInterface $exerciseRepository
    )
    {
        $this->exercise = $exerciseRepository;
    }

    public function store($topic_id, StoreExerciseRequest $request){
        DB::beginTransaction();
        try{
            $collection = [
                'topic_id' => $topic_id,
                'name' => $request->name,
                'content' => $request->content,
                'expiration_date' => $request->expiration_date,
            ];
            $this->exercise->create($collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }
}
