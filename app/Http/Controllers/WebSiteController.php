<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class WebSiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexBlog()
    {
        $blog = Blog::with(
            ['comments',

            'admin'=>function($ddd){
                $ddd->where('status','Active');


            },

            'category'=>function($quere){
                $quere->where('status','Visible');
             }
             ])->where('status','Visible')->paginate(4);




             return view('website.index',['blogs'=>$blog]);
    }

    public function showBlog($id){


        $blog = Blog::with(
            ['comments',

                'admin'=>function($ddd) {
                    $ddd->where('status','Active');


                },

                'category'=>function($quere){
                    $quere->where('status','Visible');
                 },

             ])->where('status','Visible')->find($id);



             $comment = Comment::with(
                 [
                 'replies'=>function($quere) {
                    $quere->where('status','Visible');
                    }
                 ])
             ->where('blog_id',$id)
             ->get();

             if(!session()->get('productId') == $blog->id){
                session()->put(['productId'=>$blog->id]);


                $blog->visit_count = $blog->visit_count +  1;
                $blog->save();
             }


             return view('website.post',['blog'=>$blog , 'comment'=>$comment]);

    }

    public function commentStore(Request $request)
    {

    	$request->validate([
            'guest_name'=>'required',
            'email'=>'required|email',
            'comment'=>'required',

            'blog_id'=>'required'
        ]);


       $reply = new Comment();
       $reply->guest_name= $request->get('guest_name');
       $reply->email= $request->get('email');
       $reply->reply= $request->get('comment');

       $reply->blog_id= $request->get('blog_id');
       $reply->status ='Visible';
       $isSaved = $reply->save();

       if($isSaved){
           return redirect()->back();
       }





    }
    public  function ShowCategory()
    {
        $category = Category::with(
            ['blogs'=> function($quere){
                $quere->where('status','Visible');

        }
        ])->take(5)->get();

        return view('website.dashboard',['category'=>$category]);

    }


}


