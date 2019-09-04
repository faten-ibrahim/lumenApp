<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Transformers\AuthorTransformer;
use League\Fractal;
use League\Fractal\Manager;


class AuthorController extends Controller
{

     /**
     * @var Manager
     */
    private $fractal;

    /**
     * @var AuthorTransformer
     */
    private $authorTransformer;

    function __construct(Manager $fractal, AuthorTransformer $authorTransformer)
    {
        $this->fractal = $fractal;
        $this->authorTransformer = $authorTransformer;
    }

    public function showAllAuthors()
    {
        $authors = Author::all(); // Get users from DB
        $authors = new Fractal\Resource\Collection($authors, $this->authorTransformer); // Create a resource collection transformer
        $authors = $this->fractal->createData($authors); // Transform data

        return response()->json( $authors->toArray(),200); // Get transformed array of data
       
    }

    public function showOneAuthor($id)
    {
        $author=Author::find($id);
        if(!$author){
            return response()->json(['message' => "The author with {$id} doesn't exist"], 404);
        }
        $author = new Fractal\Resource\Item($author, $this->authorTransformer); 
        $author = $this->fractal->createData($author);
        // dd($author);
        return response()->json($author->toArray(),200);
    }

    public function create(Request $request)
    {
         $this->validate($request, [
             'name' => 'required', 
             'password' => 'required|min:6', 
             'email' => 'required|email|unique:authors',
             'location' => 'required'
         ]);
        $validated = $request->validated();
        $author = Author::create($validated);
	    $author = new Fractal\Resource\Item($author, $this->authorTransformer); 
        $author = $this->fractal->createData($author);
        // dd($author);
        return response()->json($author->toArray(),201);

    }

    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required', 
            'password' => 'required|min:6', 
            'email' => 'required|email|unique:authors',
            'location' => 'required'
        ]);
        $validated = $request->validated();
        $author = Author::find($id);
        if(!$author){
            return response()->json(['message' => "The author with {$id} doesn't exist"], 404);
        }
        $author->update($validated);
	    $author = new Fractal\Resource\Item($author, $this->authorTransformer); 
        $author = $this->fractal->createData($author);
        return response()->json($author->toArray(),200);

    }

    public function delete($id)
    {
        Author::findOrFail($id)->delete();
        return response([
            'message' => 'ok',
            'status' => 200
    ], 200);
    }
}
