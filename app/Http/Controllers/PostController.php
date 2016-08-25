<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\PostTag;
use App\HttpStatusCode;
use Exception;
use Mail;
use Log;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * @SWG\Get(path="/post/{id}",
     *   tags={"Get Posts"},
     *   summary="Get Post list",
     *   description="",
     *   operationId="getPost",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="id",
     *     type="number",
     *     description="Post id, id=0 to get all post",
     *     required=false,     
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=404,
     *         description="Post not found.",
     *     )
     * )
     */
    public function index(Request $request, $id = 0)
    {
        try {
            if ($id) {
                $post = Post::where('id', $id)->first();
                
                if (! $post) {
                    throw new Exception('Post Id = ' . $id . ' not found', HttpStatusCode::NOT_FOUND);
                }
                
                $post->tags = $post->getTags();
                
                return $this->response($post);
            }
            else {
                $posts = Post::orderBy('created_at', 'desc')->get();
                if (! $posts->count()) {
                    throw new Exception('Post not found', HttpStatusCode::NOT_FOUND);
                }
                
                foreach ($posts as $k => $post) {
                   $posts[$k]->tags = $posts[$k]->getTags();
                }
                
                return $this->response($posts);
            }
        } catch (Exception $ex) {
            return $this->response($ex->getMessage(), HttpStatusCode::NOT_FOUND);
        }
    }
    
    /**
     * @SWG\Post(path="/post",
     *   tags={"Create Post"},
     *   summary="Create new Post",
     *   description="",
     *   operationId="createPost",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="title",
     *     description="Post title",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *  @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="body",
     *     description="Post body",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *   @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="tag",
     *     description="Post tag. Use comma to separate tags",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *   ),
     *   @SWG\Response(response=408,  description="Error")
     * )
     */
    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'title' => 'required|max:255',
                'body' => 'required',
            ]);
            
            $post = new Post;
            $post->title = $request->title;
            $post->body = $request->body;
            
            $post->save();
            $post->setTags($request->tag);
            //this->sendMailNotification($post);
            
            return $this->response($post);
            
        } catch (Exception $ex) {
            
            return $this->response($ex->getMessage(), \App\HttpStatusCode::CONFLICT);
        }
        
    }
    
    /**
     * @SWG\Put(path="/post/{id}",
     *   tags={"Updates Post"},
     *   summary="Create new Post",
     *   description="",
     *   operationId="updatePost",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     type="number",
     *     name="id",
     *     description="Post id",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *   @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="title",
     *     description="Post title",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *  @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="body",
     *     description="Post body",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *   @SWG\Parameter(
     *     in="formData",
     *     type="string",
     *     name="tag",
     *     description="Post tag. Use comma to separate tags",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/Order")
     *   ),
     *   @SWG\Response(
     *     response=200,
     *     description="successful operation",
     *   ),
     *   @SWG\Response(response=408,  description="Error")
     * )
     */
    public function update(Request $request, $id = 0)
    {
        try {
            $this->validate($request, [
            'title' => 'required|max:255',
                'body' => 'required',
            ]);
            $post = Post::where('id', $id)->first();
                
            if (! $post) {
                throw new Exception('Post Id = ' . $id . 'not found', HttpStatusCode::NOT_FOUND);
            }
            
            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();
            $post->setTags($request->tag);
            
            return $this->response($post);
            
        } catch (Exception $ex) {
            return $this->response($ex->getMessage(), \App\HttpStatusCode::CONFLICT);
        }
        
    }
    
    /**
     * @SWG\Delete(path="/post/{id}",
     *   tags={"Delete Post"},
     *   summary="Get Post list",
     *   description="",
     *   operationId="deletePost",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="id",
     *     type="number",
     *     description="Post id, id=0 to get all post",
     *     required=true,     
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=408,
     *         description="Post not found.",
     *     )
     * )
     */
    public function delete(Request $request, $id = 0)
    {
        try {
            $post = Post::where('id', $id)->first();
                
            if (! $post) {
                throw new Exception('Post Id = ' . $id . 'not found', HttpStatusCode::NOT_FOUND);
            }

            $post->delete();
            Log::warning(['Post deleted' => $post->toArray()]);

            return $this->response('Delete success full');
        } catch (Exception $ex) {
            return $this->response($ex->getMessage(), HttpStatusCode::CONFLICT);
        }
        
    }
    
    /**
     * @SWG\Get(path="/post/tags/{tags}",
     *   tags={"Get post by tag(s)"},
     *   summary="Get post by tag(s)",
     *   description="",
     *   operationId="getPostbyTags",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="tags",
     *     type="string",
     *     description="Tags to search. Use comma to separate tags",
     *     required=true,     
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=408,
     *         description="Post not found.",
     *     )
     * )
     */
    public function tags(Request $request, $tagNames = '')
    {
        $tagNames = explode(',', $tagNames);
        try {
            $builder = Post::distinct()->join('post_tags', 'post_tags.post_id', '=', 'posts.id')
            ->join('tags', 'post_tags.tag_id', '=', 'tags.id');
            if ($tagNames && count($tagNames)) {
                $builder->whereIn('tags.name', $tagNames);
            }

            $posts = $builder->get(['posts.*']);
            foreach ($posts as $k => $post) {
                $posts[$k]->tags = $posts[$k]->getTags();
            }        
            return $this->response($posts);
       } catch (Exception $ex) {
           return $this->response($ex->getMessage(), HttpStatusCode::NOT_FOUND);
       }
    }
    
    /**
     * @SWG\Get(path="/post/count/{tags}",
     *   tags={"Count post by tag(s)"},
     *   summary="Count post by tag(s)",
     *   description="",
     *   operationId="getPostbyTags",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     in="path",
     *     name="tags",
     *     type="string",
     *     description="Tags to count. Use comma to separate tags",
     *     required=true,     
     *   ),
     *     @SWG\Response(
     *         response=200,
     *         description="Success"
     *     ),
     *     @SWG\Response(
     *         response=408,
     *         description="Post not found.",
     *     )
     * )
     */
    public function count(Request $request, $tagNames = '')
    {
        $tagNames = explode(',', $tagNames);
        try {
            $builder = Tag::select(DB::raw('tags.name, count(posts.id) AS count'))                    
                    ->join('post_tags', 'post_tags.tag_id', '=', 'tags.id')
                    ->join('posts', 'post_tags.post_id', '=', 'posts.id')
                    ;
            
            if ($tagNames && count($tagNames)) {
                $builder->whereIn('tags.name', $tagNames);
            }
            $builder->groupBy('tags.name');
            $tags = $builder->get();
            
            return $this->response($tags);            
        } catch (Exception $ex) {
            return $this->response($ex->getMessage(), HttpStatusCode::NOT_FOUND);
        }
        
    }
    
    /**
     * Send mail notification when post created successfully
     * @param Post $post
     */
    private function sendMailNotification(Post $post) 
    {
        //send email
        $data = [
            'title'=>$post->title,
            'body' => $post->body
        ];
        Mail::send('emails.notification', $data, function($message) {
           $message->to(env('ADMIN_MAIL'), 'Tutorials Point')->subject
              ('[Lazadatest] New post notification');
           $message->from(env('MAIL_USERNAME'),env('ADMIN_NAME'));
        });            
    }
}
