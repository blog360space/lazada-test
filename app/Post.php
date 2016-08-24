<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tag;

class Post extends Model
{
    public $tags = [];
    
    public function toArray()
    {
        $array = parent::toArray();
        $array['tags'] = $this->tags;
        return $array;
    }
    
    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id', 'tag_id');
    }
    
    public function setTags($strTags) 
    {
        //delete old data
        PostTag::where('post_id', $this->id)->delete();        
        $tagNames = explode(',', $strTags);
        
        foreach ($tagNames as $tagName) {
            
            $tagName = trim(str_replace(['"', "'", "\\", "/" ], "", $tagName));            
            $tag = Tag::where('name', $tagName)->first(['id', 'name']);
            
            if (! $tag) {
                //create Tag
                $tag = new Tag();
                $tag->name = $tagName;            
                $tag->save();
            }

            $postTag = new PostTag();
            $postTag->tag_id = $tag->id;
            $postTag->post_id = $this->id;
            
            $postTag->save();
        }
        
        $this->tags = $this->getTags();
    }    
    
    public function getTags()
    {
        $tags = Tag::join('post_tags', 'post_tags.tag_id', '=', 'tags.id')
            ->where('post_tags.post_id',$this->id)->get(['name']);
        
        $result = [];
        
        foreach ($tags as $tag) {
            $result[] = $tag->name;
        }
        
        return $result;
    }
}
