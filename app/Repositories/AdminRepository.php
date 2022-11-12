<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AdminRepository implements AdminRepositoryInterface{
    protected $admin;

    public function __construct(
        Admin $admin
    )
    {
        $this->admin = $admin;
    }

    public function getDropdown()
    {
        return $this->admin->select('id', 'name', 'email')->get();
    }
}