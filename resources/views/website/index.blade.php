@extends('website.dashboard')
@section('website_content')

<div class="col-md-8">
    @foreach ($blogs as $blog)
    @if( !empty($blog->admin->name))
    @if( !empty($blog->category->category_name))
    <article class="post-item">
        <div class="post-item-image">
            <a href="{{ route('website.blog.post',$blog->id) }}">
                <img width="200" height="300" src="{{ url('images/blogs/'.$blog->blog_image)}}" alt="">
            </a>
        </div>
        <div class="post-item-body">
            <div class="padding-10">
                <h2><a href="{{ route('website.blog.post',$blog->id) }}"><h1>{{ $blog->category->category_name }}</h1>{{ $blog->title }}</a></h2>
                <p>{{ $blog->short_description }}</p>
            </div>

            <div class="post-meta padding-10 clearfix">
                <div class="pull-left">
                    <ul class="post-meta-group">
                        <li><i class="fa fa-user"></i><a href="#">{{ $blog->admin->name }}</a></li>
                        <li><i class="fa fa-clock-o"></i><time>{{date('F d , Y',strtotime($blog->created_at))}} at {{date('g:ia',strtotime($blog->created_at))}}</time></li>
                        <li><i class="fa fa-tags"></i><a href="#"> {{ $blog->category->category_name }}</a></li>
                        <li><i class="fa fa-visits"></i><a href="#">{{ $blog->visit_count }}</a></li>
                        <li><i class="fa fa-comments"></i><a href="#">{{ $blog->visible_comments_count }}</a></li>
                    </ul>
                </div>
                <div class="pull-right">
                    <a href="{{ route('website.blog.post',$blog->id) }}">Continue Reading &raquo;</a>
                </div>
            </div>
        </div>
    </article>
    @endif
    @endif

    @endforeach





    <nav>
      {{ $blogs->links() }}
    </nav>
</div>

@endsection
