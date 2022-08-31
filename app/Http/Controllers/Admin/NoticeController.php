<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNoticeRequest;
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
    
    public function index()
    {
        $data['notices'] = $this->notice->getAllNotice(20);
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
        //
    }


    public function update(Request $request, $id)
    {
        //
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
