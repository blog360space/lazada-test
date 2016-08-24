<?php

use App\Post;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class PostTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Test create new post
     */
    public function testCreateNewPost()
    {
        $response = $this->call('Post', '/post', [
            'title' => 'Php Unit test',
            'body' => 'Php unit test body',
            'tag' => 'phpunit,test'
        ]);
        
        
        
        $this->seeHeader('content-type', 'application/json');
        $this->seeStatusCode(200);
        $this->seeInDatabase('posts', ['title' => 'Php Unit test']);
        
        $data = json_decode($response->getContent(true), true);
        $this->assertArrayHasKey('id', $data['data']);
        
        
    }
   
    /**
     * Test feature get all post
     * @depends testCreateNewPost
     * @return void
     */
    public function testGetAllPost()
    {
        $this->visit('/post');
        $this->seeHeader('content-type', 'application/json');
        $this->seeStatusCode(200);
        
    }
    
    /**
     * Test feature get Post by Id
     * @depends testCreateNewPost
     * @return void
     */
    public function testGetPostById()
    {
        $this->visit('/post');
        $this->seeHeader('content-type', 'application/json');
        
    }
    
    /**
     * Test feature delete Post by Id
     */
    public function testDeletePostById()
    {
        $this->call('Delete', '/post/');
        $this->seeHeader('content-type', 'application/json');
      
    }
    
    /**
     * Test feature count post by Tag
     */
    public function testCountPostByTags()
    {
        $this->call('Get', '/post/count');
        $this->seeHeader('content-type', 'application/json');
        
    }
    
    /**
     * Test feature count post by Tag
     */
    public function testGetPostByTags()
    {
        $this->call('Get', '/post/tags');
        $this->seeHeader('content-type', 'application/json');
       
    }
}
