@extends('layouts.app') 
@section('content') 
@if ($message = Session::get('success'))         
<div class="alert alert-success">             
    <p>{{ $message }}</p>         
</div>    
<div class ="row">
    <div style="margin:0px 0px 0px 70px;">
    <a class="btn btn-success" href="{{ route('print_pdf') }}"> Print PDF</a>
</div>
</dive><br/> 
@endif     
<table class="table table-bordered" style="width:95%;margin: 0 
auto;">         
<tr>             
    <th>Title</th>             
    <th>Content</th>             
    <th>Image</th>                     
</tr>         
@foreach ($articles as $article)         
<tr>            
     <td><a href="{{ route('articles.edie', ['article' =>$article->id]) }}">{{$artiicle->title}}</a></td>             
     <td>{{ $article->content }}</td>             
     <td><img width alt ="150px" 
     src="{{asset('storage/'.$article->featured_image)}}"></td>
     </tr> 
     @endforeach
</table> 
@endsection

