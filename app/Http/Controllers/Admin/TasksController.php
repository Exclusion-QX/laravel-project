<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.tasks.index', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'deadline' => ['required'],
            'priority' => ['required',
                Rule::in(['Низкий', 'Средний', 'Высокий'])],
            'status' => [Rule::in(['Новая', 'В работе', 'Завершена'])],
        ]);

        $new_task = new Task();

        $new_task->title = $request->title;
        $new_task->user_id = Auth::id();
        $new_task->description = $request->description;
        $new_task->deadline = $request->deadline;
        $new_task->priority = $request->priority;
        $new_task->status = "Новая";

        if ($new_task->save()) {
            return redirect()->back()->withSuccess('Задача создана');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::where('id', $id)->first();
        $comments = DB::table('comments')
            ->join('users', 'user_id', '=', 'users.id')
            ->select('comments.*', 'users.name')
            ->where('task_id', $id)
            ->get();

        return view('admin.tasks.show', [
            'task' => $task,
            'comments' => $comments
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::where('id', $id)->first();
        return view('admin.tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => ['required', 'max:255'],
            'deadline' => ['required'],
            'priority' => ['required',
                Rule::in(['Низкий', 'Средний', 'Высокий'])],
            'status' => ['required',
                Rule::in(['Новая', 'В работе', 'Завершена'])],
        ]);

        $task = Task::where('id', $id)->first();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->deadline = $request->deadline;
        $task->priority = $request->priority;
        $task->status = $request->status;
        if ($task->save()) {
            return redirect()->back()->withSuccess('Задача обновлена');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id', $id)->first();
        $task->delete();

        return redirect()->back()->withSuccess('Задача удалена');
    }
}
