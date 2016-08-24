<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use App\HttpStatusCode;
use Exception;

class TagController extends Controller
{
    public function create(Request $request)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
            ]);
            
            $tag = new Tag;
            $tag->name = $request->name;
            $tag->save();
            
            return $this->response($tag);
            
        } catch (Exception $ex) {
            
            return $this->response($ex->getMessage(), HttpStatusCode::CONFLICT);
        }
    }
    
    public function index($id = 0)
    {
        try {
            if ($id) {
                $tag = Tag::where('id', $id)->first();
                
                if (! $tag->count()) {
                    throw new Exception('Tag Id = ' . $id . 'not found', HttpStatusCode::NOT_FOUND);
                }
                
                return $this->response($tag);
            }
            else {
                $tags = Tag::orderBy('created_at', 'desc')->get();
                if (! $tags->count()) {
                    throw new Exception('Tag not found', HttpStatusCode::NOT_FOUND);
                }
                
                return $this->response($tags);
            }
        } catch (Exception $ex) {
            return $this->response($ex->getMessage(), $ex->getCode());
        }
    }
    
    public function update(Request $request, $id = 0)
    {
        try {
            $this->validate($request, [
                'name' => 'required|max:255',
            ]);
            $tag = Tag::where('id', $id)->first();
               
            if (! $tag) {
                throw new Exception('Tag Id = ' . $id . ' not found', HttpStatusCode::NOT_FOUND);
            }
            
            $tag->name = $request->name;
            
            $tag->save();
            
            return $this->response($tag);
            
        } catch (Exception $ex) {
            return $this->response($ex->getMessage(), HttpStatusCode::CONFLICT);
        }
        
    }
    
    public function delete($id = 0)
    {
        try {
            $tag = Tag::where('id', $id)->first();
                
            if (! $tag) {
                throw new Exception('Tag Id = ' . $id . ' not found', HttpStatusCode::NOT_FOUND);
            }

            $tag->delete();

            return $this->response('Delete success full');
        } catch (Exception $ex) {
            return $this->response($ex->getMessage(), $ex->getCode());
        }
    }
}
