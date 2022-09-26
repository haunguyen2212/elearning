<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRoomRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Repositories\Interfaces\RoomRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{

    private $room;

    public function __construct(
        RoomRepositoryInterface $roomRepository
    )
    {
        $this->room = $roomRepository;
    }
    
    public function index(Request $request)
    {
        if(isset($request->search)){
            $data['rooms'] = $this->room->getByKey($request->search);
        }
        else{
            $data['rooms'] = $this->room->getAll();
        }
        return view('admin.room.index', $data);
    }


    public function create()
    {
        return view('admin.room.create');
    }


    public function store(StoreRoomRequest $request)
    {
        DB::beginTransaction();
        try{
            $collection = $request->except(['_token']);
            $this->room->create($collection);
            DB::commit();
            return back()->with('success', __('message.create_success', ['name' => 'phòng học']));
        }
        catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', __('message.error'));
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['info'] = $this->room->getById($id);
        if(empty($data['info'])){
            abort(404);
        }
        return view('admin.room.edit', $data);
    }


    public function update(UpdateRoomRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $collection = $request->except(['_token', '_method']);
            $this->room->update($id, $collection);
            DB::commit();
            return back()->with('success', __('message.update_success', ['name' => 'phòng học']));
        }
        catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', __('message.error'));
        }
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            $this->room->delete($id);
            DB::commit();
            return back()->with('success', __('message.delete_success', ['name' => 'phòng học']));
        }
        catch(\Exception $e){
            return back()->with('error', __('message.error'));
        }
    }
}
