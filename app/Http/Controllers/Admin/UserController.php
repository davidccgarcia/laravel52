<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $users = User::all();
        // $users = User::orderBy(DB::raw('RAND()'))->get();
        // $users = User::orderByRaw('RAND()')->get();
        // $users = User::inRandomOrder()->get();

        // $q = User::query();

        // if ($request->has('search')) {
        //     $q->where('email', $request->get('search'))->get();
        // }
        
        // $users = $q->get();
        
        // $users = User::search($request->search)
        //     ->withCount(['experiences' => function ($q) {
        //         $q->where('name', 'PHP');
        //     }])
        //     ->inRandomOrder()
        //     ->get();
        
        // $users = User::whereRaw('first_name = last_name')->get();
        $users = User::whereColumn(['first_name' => 'last_name'])->get();

        return view('admin.users.index', compact('users'));
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        abort_if(! $user->isCollaborator(), 404, 'El usuario administrador no puede ser editado');

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        abort_if(! $user->isCollaborator(), 404, 'El usuario administrador no puede ser editado');

        $this->validate($request, [
            'email' => 'required'
        ]);

        $user->fill($request->all());
        
        $user->save();
        
        return back()->with('success', true);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
