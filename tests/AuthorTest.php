<?php

class AuthorTest extends TestCase
{
   /**
    * /api/authors [GET]
    */
   public function testShouldReturnAllAuthors(){
       $this->get("api/authors", []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
           'data' =>
               ['*' =>
                   [
                        'name',
                        'email',
                        'github',
                        'twitter',
                        'location',
                        'latest article published'
                   ]
               ]
       ]);

   }
   /**
    * /api/authors/id [GET]
    */
   public function testShouldReturnAuthor(){
       $this->get("api/authors/2", []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure(
           ['data' =>
               [
                    'name',
                    'email',
                    'github',
                    'twitter',
                    'location',
                    'latest article published'
               ]

           ]
       );

   }
   /**
    * /api/authors [POST]
    */
   public function testShouldCreateAuthor(){
    $author = factory('App\Author')->make();
    $response=$this->post("api/authors", $author->toArray(), []);         
    $this->assertEquals(201, $this->response->status());

   }

   /**
    * /api/authors/id [PUT]
    */
   public function testShouldUpdateAuthor(){
    $author = factory('App\Author')->make();
    $response=$this->put("api/authors/2", $author->toArray(), []);         
    $this->assertEquals(200, $this->response->status());

   }
   /**
    * /api/authors/id [DELETE]
    */
   public function testShouldDeleteAuthor(){

       $this->delete("api/authors/1", [], []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
               'message',
               'status'
       ]);
   }
}
