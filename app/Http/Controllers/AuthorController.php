<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;
use App\Transformers\AuthorTransformer;
use League\Fractal;
use League\Fractal\Manager;

/**
 * @group Author management
 *
 * APIs for managing authors
 */

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

/**
 * Show all authors
 *
 * Api to list all authors
 * @transformercollection \ App\Transformers\AuthorTransformer
 * @transformerModel \App\Author
 *
 */

    public function showAllAuthors()
    {
        $authors = Author::all(); // Get users from DB
        $authors = new Fractal\Resource\Collection($authors, $this->authorTransformer); // Create a resource collection transformer
        $authors = $this->fractal->createData($authors); // Transform data

        return response()->json( $authors->toArray(),200); // Get transformed array of data
       
    }

/**
 * Show one author
 *
 * Api to show one author
 *  
 * @transformercollection \ App\Transformers\AuthorTransformer
 * @transformerModel \App\Author
 *
 */
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


/**
 * Create an author
 *
 * Api to create an author
 * 
 * @bodyParam name string required The name of the author.
 * @bodyParam password string required The password of the author.
 * @bodyParam email string required The email of the author.
 * @bodyParam location string required The location of the author.
 * @bodyParam github string The github account of the author.
 * @bodyParam twitter string  The twitter account of the author.
 * @transformercollection \ App\Transformers\AuthorTransformer
 * @transformerModel \App\Author
 * 
 *
 */

    public function create(Request $request)
    {
         $this->validate($request, [
             'name' => 'required', 
             'password' => 'required|min:6',
             'email' => 'required|email|unique:authors',
             'location' => 'required'
         ]);
        $password=$request->password;
        $hashedPassword = app('hash')->make($password);
        $request->password=$hashedPassword;
        $author = Author::create($request->all());
        // $author['password']=$hashedPassword;
        // $author->save();
	    $author = new Fractal\Resource\Item($author, $this->authorTransformer); 
        $author = $this->fractal->createData($author);
        // dd($author);
        return response()->json($author->toArray(),201);

    }


/**
 * Update
 *
 * Api to update an author
 * @transformercollection \ App\Transformers\AuthorTransformer
 * @transformerModel \App\Author
 *
 */
    public function update($id, Request $request)
    {
        
        $author = Author::find($id);
        if(!$author){
            return response()->json(['message' => "The author with {$id} doesn't exist"], 404);
        }
        $author->update($request->all());
	    $author = new Fractal\Resource\Item($author, $this->authorTransformer); 
        $author = $this->fractal->createData($author);
        return response()->json($author->toArray(),200);

    }

/**
 * Delete
 *
 * Api to delete an author
 *
 */
    public function delete($id)
    {
        Author::findOrFail($id)->delete();
        return response([
            'message' => 'ok',
            'status' => 200
    ], 200);
    }
}
