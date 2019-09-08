<?php

namespace App\Http\Controllers;

use App\Author;
use App\Article;
use Illuminate\Http\Request;
use App\Transformers\ArticleTransformer;
use League\Fractal;
use League\Fractal\Manager;
use JD\Cloudder\Facades\Cloudder as Cloudder;

/**
 * @group Article management
 *
 * APIs for managing articles
 */

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

/**
 * Show all articles
 *
 * Api to list all articles
 * @transformercollection \ App\Transformers\ArticleTransformer
 * @transformerModel \App\Article
 *
 */
    public function showAllArticles()
    {
        $articles=Article::all();
        $articles = new Fractal\Resource\Collection($articles, $this->articleTransformer); // Create a resource collection transformer
        $this->fractal->parseIncludes('author');
        $articles = $this->fractal->createData($articles); // Transform data

        return response()->json( $articles->toArray(),200); // Get transformed array of data
    }

/**
 * Show one article
 *
 * Api to show one article
 *  
 * @transformercollection \ App\Transformers\ArticleTransformer
 * @transformerModel \App\Article
 *
 */
    public function showOneArticle($id)
    {
        
        $article=Article::find($id);
       
        if(!$article){
            return response()->json(['message' => "The article with {$id} doesn't exist"], 404);
        }
        $article = new Fractal\Resource\Item($article, $this->articleTransformer); // Create a resource collection transformer
        $this->fractal->parseIncludes('author');
        $article = $this->fractal->createData($article); // Transform data

        return response()->json( $article->toArray(),200); 
    }



/**
 * Create an article
 *
 * Api to create an article
 * 
 * @bodyParam main_title string required The main title of the article.
 * @bodyParam secondary_title string required The secondary title of the article.
 * @bodyParam content string required The content of the article.
 * @bodyParam image file The image for the article.
 * @bodyParam author_id int the ID of the author of the article
 * @transformercollection \ App\Transformers\AuthorTransformer
 * @transformerModel \App\Author
 * 
 *
 */

    public function create(Request $request)
    {
        $this->validate($request, [
            'main_title' => 'required',
            'secondary_title'=>'required',
            'content' => 'required',
            'author_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file_url=env('IMAGE_FILE_URL');
        if ($request->hasFile('image') && $request->file('image')->isValid()){
        $cloudder = Cloudder::upload($request->file('image')->getRealPath());
        $uploadResult = $cloudder->getResult();
        $file_url = $uploadResult["url"];
        }
        //dd($file_url);
        $article = Article::create($request->all());
        $article->image = $file_url;
        $article->save();
        $article = new Fractal\Resource\Item($article, $this->articleTransformer); // Create a resource collection transformer
        $this->fractal->parseIncludes('author');
        $article = $this->fractal->createData($article); // Transform data

        return response()->json( $article->toArray(),201); 
    }

/**
 * Update
 *
 * Api to update an article
 * @transformercollection \ App\Transformers\AuthorTransformer
 * @transformerModel \App\Article
 *
 */
    public function update($id, Request $request)
    {
       
        $article = Article::find($id);
        if(!$article){
            return response()->json(['message' => "The article with {$id} doesn't exist"], 404);
        }
        $file_url=env('IMAGE_FILE_URL');
        $article->update($request->all());
        if ($request->hasFile('image') && $request->file('image')->isValid()){
            if($request->file('image') != $article->first()->image){
                $cloudder = Cloudder::upload($request->file('image')->getRealPath());
                $uploadResult = $cloudder->getResult();
                $file_url = $uploadResult["url"];$article->image = $file_url;
                $article->save();
            }
        }        
	    $article = new Fractal\Resource\Item($article, $this->articleTransformer); 
        $this->fractal->parseIncludes('author');
        $article = $this->fractal->createData($article);
        return response()->json($article->toArray(),200);
    }

/**
 * Delete
 *
 * Api to delete an article
 *
 */
    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        return response([
            'message' => 'ok',
            'status' => 200
        ], 200);
    }
}