<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Movie;

class MovieController extends Controller
{
    /**
     * Return JSON listing of movies
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Movie::all()->toJson();;
    }

    /**
     * Return JSON of the specified movie
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $movie = Movie::where('id', $id)->first();
        if(!$movie) return response()->json(['error' => 'Movie not found'], 404);
        return $movie->toJson();
    }

    /**
     * Return JSON listing of movies in specified category
     *
     * @param Request $request
     * @param $category
     * @return mixed
     */
    public function getByCategory(Request $request, $category)
    {
        return Movie::where('category', urldecode($category))->get()->toJson();
    }

    /**
     * Return JSON listing of movies with title containing search term
     *
     * @param Request $request
     * @param $title
     * @return mixed
     */
    public function getByTitle(Request $request, $title)
    {
        return Movie::where('title', 'LIKE', '%'.urldecode($title).'%')->get()->toJson();
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
