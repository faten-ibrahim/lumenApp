<?php
use Laravel\Lumen\Testing\DatabaseMigrations;

class AuthorTest extends TestCase
{
    use DatabaseMigrations;

    /**
    * /api/authors [GET]
    */
   public function testShouldReturnAllAuthors(){
       factory('App\Author',5)->create();
       $author = factory('App\Author')->create();
       $this->actingAs($author)
            ->get("auth/authors", []);
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
        $author = factory('App\Author')->create();
        $this->actingAs($author)
             ->get("auth/authors/{$author->id}", []);
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
    $response=$this->post("authors", $author->makeVisible('password')->toArray(), []);  
    // dd($response);       
    $this->assertEquals(201, $this->response->status());

   }

   /**
    * /api/authors/id [PUT]
    */
   public function testShouldUpdateAuthor(){
    $author = factory('App\Author')->create()->toArray();
    // dd($author['id']);
    $response=$this->put("authors/{$author['id']}", $author, []);         
    $this->assertEquals(200, $this->response->status());

   }
   /**
    * /api/authors/id [DELETE]
    */
   public function testShouldDeleteAuthor(){
        $author = factory('App\Author')->create();
        $this->actingAs($author)
             ->delete("auth/authors/1", [], []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
               'message',
               'status'
       ]);
   }
}
