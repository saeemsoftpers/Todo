<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $todos = Todo::where(['user_id' => 1])->get();
        return Inertia::render('Todo', ['data' => $todos]);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $todo = Todo::create([
            'name' => $request->name,
            'is_done' => $request->done,
            'user_id' => 1
        ]);
        return redirect()->back()
            ->with('message', 'Task Created Successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function done(Request $request, Todo $todo)
    {

        $todo->is_done = !(request('done') == true);
        $todo->save();

        return redirect()->back()
            ->with('message', 'Task Update Successfully.');
    }

    public function update(Request $request, Todo $todo)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);
        $todo->name = request('name');
        $todo->is_done = request('done');
        $todo->save();
        return redirect()->back()
            ->with('message', 'Task Update Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()
            ->with('message', 'Task Delete Successfully.');
    }
}
