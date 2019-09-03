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
       $parameters = [
            'name' => 'hazem ali',
            'email' => 'hazem_ali@yahoo.com',
            'github' => 'fffff',
            'twitter' => 'ggggggffff',
            'location' => 'locatttttt',
            'latest_article_published' => 'article rrr',
       ];
       $this->post('api/authors', $parameters, []);
       $this->seeStatusCode(201);
       $this->seeJsonStructure(
           [
                'name',
                'email',
                'github',
                'twitter',
                'location',
                'latest article published'
           ]
       );
   }

   /**
    * /api/authors/id [PUT]
    */
   public function testShouldUpdateAuthor(){
       $parameters = [
           'name' => 'hazem t',
           'email' => 'hazem_t@yahoo.com',
         
       ];
       $this->put("api/authors/4", $parameters, []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure(
            [
                'name',
                'email',
                'github',
                'twitter',
                'location',
                'latest article published'
           ]
       );
   }
   /**
    * /api/authors/id [DELETE]
    */
   public function testShouldDeleteAuthor(){

       $this->delete("api/authors/7", [], []);
       $this->seeStatusCode(200);
       $this->seeJsonStructure([
               'message',
               'status'
       ]);
   }
}
