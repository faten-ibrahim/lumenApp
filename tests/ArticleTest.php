<?php

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
       $parameters = [
           'main_title' => 'create main title',
           'secondary_title' => 'create second title',
           'content' => 'create content',
           'image' => 'imagecreate.png',
           'author_id' => 1
       ];
       $this->post('api/articles', $parameters, []);
       $this->seeStatusCode(201);
       $this->seeJsonStructure(
           [
               
                'main title',
                'secondary title',
                'article content',
                'author ID',
                'image url',
           ]
       );
   }

   /**
    * /api/articles/id [PUT]
    */
   public function testShouldUpdateArticle(){
       $parameters = [
           'main_title' => 'update main title',
           'secondary_title' => 'update second title',
           'content' => 'update content',
           'image' => 'imageupdate.png',
           'author_id' => 1
       ];
       $this->put("api/articles/13", $parameters, []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure(
           [           
                'main title',
                'secondary title',
                'article content',
                'author ID',
                'image url',
           ]
       );
   }
   /**
    * /api/articles/id [DELETE]
    */
   public function testShouldDeleteArticle(){

       $this->delete("api/articles/5", [], []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
               'status',
               'message'
       ]);
   }
}