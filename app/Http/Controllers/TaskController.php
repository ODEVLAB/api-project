<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get()->toJson(JSON_PRETTY_PRINT);
        return response($tasks, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'title' => 'required',
            'task_code' => 'required',
            'description' => 'required',
            'status' => 'required|in:1,0',
            'deadline' => 'required',
        ]);
        $task = new Task;
        $task->title = $request->title;
        $task->task_code = $request->task_code;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->deadline = $request->deadline;
        $task->save();

        return response()->json([
            "message" => "Task Created Succesfully"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Task::where('id', $id)->exists()) {
            $task = Task::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($task, 200);
          } else {
            return response()->json([
              "message" => "Oops Task Not Found"
            ], 404);
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'title' => 'required',
            'task_code' => 'required',
            'description' => 'required',
            'status' => 'required|in:1,0',
            'deadline' => 'required',
        ]);
        $task = Task::find($id);
        $task->title = $request->title;
        $task->task_code = $request->task_code;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->deadline = $request->deadline;
        $result = $task->save();

        if($result)
        {
        return response()->json(["message" => "Update Successfull"], 200);
        }
        else {
                return response()->json(["message" => "Task Not Found"], 404);
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
        if(Task::where('id', $id)->exists()) {
            $task = Task::find($id);
            $task->delete();

            return response()->json([
              "message" => "Task Data Deleted"
            ], 202);
          } else {
            return response()->json([
              "message" => "Task Not Found"
            ], 404);
          }
    }
}
