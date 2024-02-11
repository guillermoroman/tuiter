<?php

namespace App\Http\Controllers;

use App\Models\Tuit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TuitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        //return "Hola mundo!";

        return view('tuits.index', ['tuits' => Tuit::with('user')->latest()->get()]);
    }

    public function index_followed(): View
    {
        // Obtener el ID del usuario actual
        $userId = auth()->id();

        // Obtener los IDs de los usuarios que el usuario actual sigue
        $followedUsersIds = auth()->user()->following()->pluck('users.id');

        // Filtrar los tuits para mostrar solo los de los usuarios seguidos
        $tuits = Tuit::with('user')
            ->whereIn('user_id', $followedUsersIds)
            ->latest()
            ->get();

        return view('tuits_followed.index', ['tuits' => $tuits]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $request->user()->tuits()->create($validated);

        return redirect(route('tuits.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Tuit $tuit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tuit $tuit): View
    {
        $this->authorize('update', $tuit);

        return view('tuits.edit', ['tuit' => $tuit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tuit $tuit)
    {
        $this->authorize('update', $tuit);

        $validated = $request->validate([
            'message' => 'required|string|max:255'
        ]);

        $tuit->update($validated);

        return redirect(route('tuits.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tuit $tuit)
    {
        $this->authorize('delete', $tuit);

        $tuit->delete();

        return redirect(route('tuits.index'));
    }
}
