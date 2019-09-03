<?php

namespace App\Http\Controllers;

use App\Author;
use App\Article;
use Illuminate\Http\Request;
use App\Transformers\ArticleTransformer;
use League\Fractal;
use League\Fractal\Manager;

class ArticleController extends Controller
{
      /**
     * @var Manager
     */
    private $fractal;

    /**
     * @var ArticleTransformer
     */
    private $articleTransformer;

    function __construct(Manager $fractal, ArticleTransformer $articleTransformer)
    {
        $this->fractal = $fractal;
        $this->articleTransformer = $articleTransformer;
    }
    public function showAllArticles()
    {
        $articles=Article::all();
        $articles = new Fractal\Resource\Collection($articles, $this->articleTransformer); // Create a resource collection transformer
        $this->fractal->parseIncludes('author');
        $articles = $this->fractal->createData($articles); // Transform data

        return response()->json( $articles->toArray(),200); // Get transformed array of data
    }

    public function showOneArticle($id)
    {
        $article=Article::find($id);
        $article = new Fractal\Resource\Item($article, $this->articleTransformer); // Create a resource collection transformer
        $this->fractal->parseIncludes('author');
        $article = $this->fractal->createData($article); // Transform data

        return response()->json( $article->toArray(),200); 
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'main_title' => 'required',
            'secondary_title'=>'required',
            'content' => 'required',
            'author_id' => 'required'
        ]);
        $article = Article::create($request->all());
        $article = new Fractal\Resource\Item($article, $this->articleTransformer); // Create a resource collection transformer
        $this->fractal->parseIncludes('author');
        $article = $this->fractal->createData($article); // Transform data

        return response()->json( $article->toArray(),201); 
    }

    public function update($id, Request $request)
    {
       
        $article = Article::findOrFail($id);
        $article->update($request->all());
	    $article = new Fractal\Resource\Item($article, $this->articleTransformer); 
        $this->fractal->parseIncludes('author');
        $article = $this->fractal->createData($article);
        return response()->json($article->toArray(),200);
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        return response([
            'message' => 'ok',
            'status' => 200
        ], 200);
    }
}