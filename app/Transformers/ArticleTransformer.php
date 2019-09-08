<?php
namespace App\Transformers;

use App\Article;
use League\Fractal\TransformerAbstract;
use App\Transformers\AuthorTransformer;

class ArticleTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'author'
    ];

    public function transform(Article $article)
    {
        return [
            'main title' => $article->main_title,
            'secondary title'=> $article->secondary_title,
            'article content'=> $article->content,
            'author ID'=> $article->author_id,
            'image url'=> $article->image,
            
        ];
    }

    /**
     * Include Author
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeAuthor(Article $article)
    {
        $author = $article->author;

        return $this->item($author, new AuthorTransformer);
    }
}