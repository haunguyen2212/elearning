<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Requests\UpdateNoticeRequest;
use App\Repositories\Interfaces\NoticeRepositoryInterface;
use Illuminate\Http\Request;

class NoticeController extends Controller
{

    private $notice;

    public function __construct(
        NoticeRepositoryInterface $noticeRepository
    )
    {
        $this->notice = $noticeRepository;
    }
    
    public function index(Request $request)
    {
        if(isset($request->filter)){
            $data['notices'] = $this->notice->filter($request->filter, 20);
            $data['notices']->appends(['search' => $request->filter]);
        }
        else{
            $data['notices'] = $this->notice->getAllNotice(20);
        }
        return view('admin.notice.index', $data);
    }

    public function create()
    {
        return view('admin.notice.create');
    }


    public function store(StoreNoticeRequest $request)
    {
        $link = $request->file('link');
        if($link){
            $file = $request->file('link')->getClientOriginalName();
            $link->move(public_path('backend/assets/document/notices/'), $file);
        }
        $collection = $request->except(['_token', 'link']);
        $collection['link'] = $file;
        $collection['start_time'] = date('Y-m-d H:i:s', strtotime($collection['start_time']));
        $collection['end_time'] = date('Y-m-d H:i:s', strtotime($collection['end_time']));
        $store = $this->notice->create($collection);
        if($store){
            return back()->with('success', __('message.create_success', ['name' => 'thông báo']));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $notice = $this->notice->getById($id);
        if(empty($notice)){
            abort(404);
        }
        return view('admin.notice.edit', compact('notice'));
    }


    public function update(UpdateNoticeRequest $request, $id)
    {
        $notice = $this->notice->getById($id);
        if(empty($notice)){
            abort(404);
        }
        $collection = $request->except(['_token', '_method']);
        $collection['start_time'] = date('Y-m-d H:i:s', strtotime($collection['start_time']));
        $collection['end_time'] = date('Y-m-d H:i:s', strtotime($collection['end_time']));
        $link = $request->file('link');
        if($link){
            $file = $request->file('link')->getClientOriginalName();
            $link->move(public_path('backend/assets/document/notices/'), $file);
            $destinationPath = public_path('backend/assets/document/notices/').$notice->link;
            if(file_exists($destinationPath)){
                unlink($destinationPath);
            }
            $collection['link'] = $file;
            $update = $this->notice->update($id, $collection, true);
        }
        else{
            $update = $this->notice->update($id, $collection);
        }

        if($update){
            return back()->with('success', __('message.update_success', ['name' => 'thông báo']));
        }
        else{
            return back()->with('error', __('message.error'));
        }
        
    }


    public function destroy($id)
    {
        $notice = $this->notice->getById($id);
        if(empty($notice)){
            abort(404);
        }
        if($notice->link){
            $destinationPath = public_path('backend/assets/document/notices/').$notice->link;
            if(file_exists($destinationPath)){
                unlink($destinationPath);
            }
        }
        $delete = $this->notice->delete($id);
        if($delete){
            return back()->with('success', __('message.delete_success', ['name' => 'thông báo']));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }
}
