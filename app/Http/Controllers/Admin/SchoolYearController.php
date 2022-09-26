<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeSchoolYearRequest;
use App\Http\Requests\StoreSchoolYearRequest;
use App\Http\Requests\UpdateSchoolYearRequest;
use App\Repositories\Interfaces\SchoolYearRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolYearController extends Controller
{

    private $schoolYear;

    public function __construct(
        SchoolYearRepositoryInterface $schoolYearRepository
    )
    {
        $this->schoolYear = $schoolYearRepository;
    }

    public function index()
    {
        $data['schoolYears'] = $this->schoolYear->getAll();
        return view('admin.school_year.index', $data);
    }


    public function create()
    {
        //
    }


    public function store(StoreSchoolYearRequest $request)
    {
        DB::beginTransaction();
        try{
            $collection = $request->except(['_token']);
            $collection['start_time'] = date('Y-m-d', strtotime($collection['start_time']));
            $collection['end_time'] = date('Y-m-d', strtotime($collection['end_time']));
            $collection['status'] = $request->status ? 1 : 0;
            $store = $this->schoolYear->create($collection);
            if( $collection['status'] == 1){
                $this->schoolYear->changeToCurrent($store->id);
            }
            DB::commit();
            $request->session()->flash('success', __('message.create_success', ['name' => 'năm học']));
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = $this->schoolYear->getById($id);
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }


    public function update(UpdateSchoolYearRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $collection = $request->except(['_token', '_method']);
            $collection['start_time'] = date('Y-m-d', strtotime($collection['start_time']));
            $collection['end_time'] = date('Y-m-d', strtotime($collection['end_time']));
            $collection['status'] = $request->status ? 1 : 0;
            $update = $this->schoolYear->update($id, $collection);
            if($collection['status'] == 1){
                $this->schoolYear->changeToCurrent($id);
            }
            DB::commit();
            $request->session()->flash('success', __('message.update_success', ['name' => 'năm học']));
            return response()->json(['data' => $request->toArray(), 'status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $this->schoolYear->delete($id);
            DB::commit();
            session()->flash('success', __('message.delete_success', ['name' => 'năm học']));
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function change(ChangeSchoolYearRequest $request){
        DB::beginTransaction();
        try{
            $this->schoolYear->changeToCurrent($request->id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }
}
