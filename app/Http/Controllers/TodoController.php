<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Http\Requests\TodoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $conditions = [
            ['user_id',  Auth::id()],
        ];

        if(!empty($request->keyword)){
            $conditions[] = ['title','like','%'.$request->keyword.'%'];
        }

        if(!empty($request->status)){
            $conditions[] = ['status', '1'];
        }else{
            $conditions[] = ['status', '0'];
        }

        if(!empty($request->expired)){
            $conditions[] = ['due_date', '<=', date('Y-m-d')];
        }

        $todos = Todo::with(['user'])->where($conditions)->paginate(5);
        return view('Todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        $todo = new Todo();
        $todo->create($request->all());
    
        return redirect('/')->with(
            'status',
            $request->title . 'タスクを登録しました!'
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(TodoRequest $request, $id)
    {
        $todo = Todo::find($id);
        $todo->update($request->all());
    
        return redirect('/')->with(
            'status',
            $todo->title . 'タスクを編集しました!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        $todo->delete();
    
        return redirect('/')->with(
            'status',
            $todo->title . 'タスクを編集しました!'
        );
    }
}
