<?php
use Illuminate\Http\UploadedFile;
use Laravel\Lumen\Testing\DatabaseMigrations;
use App\Author;
use App\Article;
class ArticleTest extends TestCase
{
    use DatabaseMigrations;
   /**
    * /api/articles [GET]
    */
   public function testShouldReturnAllArticles(){

       factory('App\Author', 10)->create();
       factory('App\Article', 5)->create();
       $author = factory('App\Author')->create();
       $this->actingAs($author)
         ->get("auth/articles", []);
    //    $this->get("api/articles", []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
           'data' =>
               ['*' =>
                   [
                       'main title',
                       'secondary title',
                       'article content',
                       'author ID',
                       'image url',
                   ]
               ]
       ]);

   }
   /**
    * /api/articles/id [GET]
    */
   public function testShouldReturnArticle(){
    
        
    $auth=factory('App\Author')->create();
    $article = factory('App\Article')->create(['author_id'=>$auth->id]);
    $author = factory('App\Author')->create();
        $this->actingAs($author)
             ->get("auth/articles/{$article->id}", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
           ['data' =>
               [
                    'main title',
                    'secondary title',
                    'article content',
                    'author ID',
                    'image url',
               ]

           ]
       );

   }
   /**
    * /api/articles [POST]
    */
   public function testShouldCreateArticle(){
    $auth=factory('App\Author')->create();
    $article = factory('App\Article')->create(['author_id'=>$auth->id]);
    $author = factory('App\Author')->create();

    $article['image'] = UploadedFile::fake()->image('avatar.jpeg');
    // dd($article);
    $response= $this->actingAs($author)
                    ->post("auth/articles", $article->toArray(), []);        
    $this->assertEquals(201, $this->response->status());
   }

   /**
    * /api/articles/id [PUT]
    */
   public function testShouldUpdateArticle(){
    $auth=factory('App\Author')->create();
    $article = factory('App\Article')->create(['author_id'=>$auth->id])->toArray();
    $author = factory('App\Author')->create(); 
    $response= $this->actingAs($author)
                    ->put("/auth/articles/{$article['id']}", $article, []);       
    $this->assertEquals(200, $this->response->status());
   }
   /**
    * /api/articles/id [DELETE]
    */
   public function testShouldDeleteArticle(){
       $author = factory('App\Author')->create();
       $article = factory('App\Article')->create();
       $this->actingAs($author)
            ->delete("auth/articles/{$article->id}", [], []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
               'status',
               'message'
       ]);
   }
}