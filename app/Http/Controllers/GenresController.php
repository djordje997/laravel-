<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Genre;
class GenresController extends Controller
{
    public function listGenres()
    {
        $genres=Genre::all();
        return view('genres.list',['genres'=>$genres]);
    }

}
