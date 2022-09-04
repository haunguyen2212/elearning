<?php

namespace App\Repositories;

use App\Models\Notice;
use App\Repositories\Interfaces\NoticeRepositoryInterface;
use Carbon\Carbon;

class NoticeRepository implements NoticeRepositoryInterface{

    private $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
    }

    public function getAll()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        return $this->notice->where('start_time', '<=', $now)->where('end_time', '>=', $now)->get();
    }

    public function getAllNotice($offset = 10)
    {
        return $this->notice->paginate($offset);
    }

    public function filter($value, $offset = 10)
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        switch($value){
            case 'past':
                return $this->notice->where('end_time', '<', $now)->paginate($offset);
                break;
            case 'future':
                return $this->notice->where('start_time', '>', $now)->paginate($offset);
                break;
            case 'current':
                return $this->notice->where('start_time', '<=', $now)->where('end_time', '>=', $now)->paginate($offset);
            default:
                return $this->notice->paginate($offset);
        }
    }

    public function delete($id)
    {
        return $this->notice->find($id)->delete();
    }

    public function getById($id)
    {
        return $this->notice->find($id);
    }

    public function create($collection = [])
    {
        return $this->notice->create([
            'name' => $collection['name'] ?? NULL,
            'link' => $collection['link'],
            'start_time' => $collection['start_time'],
            'end_time' => $collection['end_time'],
        ]);
    }

    public function update($id, $collection = [], $is_link = false)
    {
        if($is_link){
            return $this->notice->find($id)->update([
                'name' => $collection['name'] ?? NULL,
                'link' => $collection['link'],
                'start_time' => $collection['start_time'],
                'end_time' => $collection['end_time'],
            ]);
        }
        else{
            return $this->notice->find($id)->update([
                'name' => $collection['name'] ?? NULL,
                'start_time' => $collection['start_time'],
                'end_time' => $collection['end_time'],
            ]);
        }
    }
}