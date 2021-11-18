<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $task_count = Task::all()->count();

        return view('admin.home.index',[
        'task_count' => $task_count
        ]);
    }

    public function test()
    {
        return phpinfo();
    }
}
