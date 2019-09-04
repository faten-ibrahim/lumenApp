<?php
use Illuminate\Http\UploadedFile;
class ArticleTest extends TestCase
{
   /**
    * /api/articles [GET]
    */
   public function testShouldReturnAllArticles(){
       $this->get("api/articles", []);
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
       $this->get("api/articles/2", []);
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
      
    $article = factory('App\Article')->make();
    $article['image'] = UploadedFile::fake()->image('avatar.jpeg');
    // dd($article);
    $response=$this->post("api/articles", $article->toArray(), []);        
    $this->assertEquals(201, $this->response->status());
   }

   /**
    * /api/articles/id [PUT]
    */
   public function testShouldUpdateArticle(){
    
    $article = factory('App\Article')->make();
    $article['image'] = UploadedFile::fake()->image('avatar.jpeg');
    $response=$this->put("api/articles/31", $article->toArray(), []);         
    $this->assertEquals(200, $this->response->status());
   }
   /**
    * /api/articles/id [DELETE]
    */
   public function testShouldDeleteArticle(){

       $this->delete("api/articles/31", [], []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
               'status',
               'message'
       ]);
   }
}