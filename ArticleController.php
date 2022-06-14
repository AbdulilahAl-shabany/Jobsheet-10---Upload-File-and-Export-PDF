<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleController;
use PDF;
Rout::resource('articles', ArticleController::class);


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Articles::all();
        return view('articles.index', ['articles' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('image')) { 
             $image_name = $request->file( ' image ' )->store('images' , 'public');
              Article::create([ 
                'title' => $request->title, 
                'content' => $request->content, 
                'featured_image' => $image_name,
                 ]) ; 
                 return redirect()->route('article.index')
                  ->with('success', 'Articles Successfully Added');
        //
    }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        return view('articles.edit', ['article' =>$article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $article = Article::find($id); 
        $article->title = $request->title; 
        $article->content = $request->content; 
        if ($article->featured_image && file_exists(storage_path ('app/ public/' . $article->featured_image))) { 
            Storage::delete ('public/' . $article->featured_image ); 
        } 
        
        $image_name = $request->file ('image')->store('images', 'public'); 
        $article->featured_image = $image_name; 

        $article->save(); 
        return redirect()->route('articles.index')
         ->with ('success', 'Article Successfully Updated');
         }
         
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        //
    }
    public function print_pdf(){
        $articles = Article::all();
        $pdf = PDF::loadview('article.articles_pdf', ['article' => $articles]);
        return $pdf->stream();
    }
}

