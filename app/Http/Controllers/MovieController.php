<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::with('genre')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'stock' => 'required|numeric',
            'rate' => 'required',
        ]);

        $movie = Movie::create([
            'title' => $request->title,
            'genre_id' => $request->genre_id,
            'stock' => $request->stock,
            'rate' => $request->rate,
        ]);

        return response()->json($movie, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        $movie->load('genre');
        return $movie;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string',
            'genre_id' => 'required|exists:genres,id',
            'stock' => 'required|numeric',
            'rate' => 'required',
        ]);

        $movie = $movie->update([
            'title' => $request->title,
            'genre_id' => $request->genre_id,
            'stock' => $request->stock,
            'rate' => $request->rate,
        ]);

        return response()->json($movie, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return response()->json(204);
    }
}
