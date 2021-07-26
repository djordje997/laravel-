<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\Mark;
use App\Genre;

class MoviesController extends Controller
{
    public function listMovies()
    {
       $movies = Movie::all();
       return view('movies.list',['movies' => $movies]);
    }

    public function getMovie(Movie $movie)
    {
        return view('movies.show',['movie' => $movie]);
    }    

    public function addMovie()
    {
        if (!auth()->user() || !auth()->user()->admin) {
            return redirect()->route('home');
        }

        $genres = Genre::all();
        
        return view('movies.create', ['genres' => $genres]);
    }

    public function saveMovie(Request $request)
    {
        if (!auth()->user() || !auth()->user()->admin) {
            return redirect()->route('home');
        }

        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'string|nullable'
        ]);
        
        $movie = Movie::create($request->only('name', 'description'));

        $movie->genres()->attach($request->input('genres'));

        return redirect()->route('home');
    }

    public function editMovie(Movie $movie)
    {
        if (!auth()->user() || !auth()->user()->admin) {
            return redirect()->route('home');
        }

        $genres = Genre::all();

        return view('movies.edit', ['movie' => $movie, 'genres' => $genres]);
    }

    public function updateMovie(Movie $movie, Request $request)
    {
        if (!auth()->user() || !auth()->user()->admin) {
            return redirect()->route('home');
        }

        $this->validate($request, [
            'name' => 'required|string',
            'description' => 'string|nullable'
        ]);

        $movie->fill($request->only('name', 'description'));
        $movie->save();

        $movie->genres()->sync($request->input('genres'));

        return redirect()->route('home');
    }

    public function deleteMovie(Movie $movie)
    {
        if (!auth()->user() || !auth()->user()->admin) {
            return redirect()->route('home');
        }

        $movie->delete();

        return redirect()->route('home')
            ->with('success', 'Movie has been successfully deleted.');
    }

    public function markMovie(Movie $movie, Request $request)
    {
        if (!auth()->user()) {
            return redirect()->route('movies.show', $movie->id);
        }

        $mark = $request->get('mark');

        $mark = new Mark;
        $mark->movie_id = $movie->id;
        $mark->user_id = auth()->user()->id;
        $mark->value = $request->get('mark');
        $mark->save();

        return redirect()->route('movies.show', $movie->id)
            ->with('success', 'Success');
    }
}
