

@extends('website.dashboard')
@section('website_content')


<div class="col-md-8">
    <article class="post-item post-detail">
        <div class="post-item-image">
            <a href="#">
                <img width="200" height="300" src="{{ url('images/blogs/'.$blog->blog_image)}}" alt="">
            </a>
        </div>

        <div class="post-item-body">
            <div class="padding-10">
                <h1>{{ $blog->short_description }}</h1>


                <div class="post-meta no-border">
                    <ul class="post-meta-group">
                        <li><i class="fa fa-user"></i><a href="#">{{ $blog->admin->name }}</a></li>
                        <li><i class="fa fa-clock-o"></i><time>{{$blog->created_at}}</time></li>
                        <li><i class="fa fa-tags"></i><a href="#">{{ $blog->title }}</a></li>
                        <li><i class="fa fa-comments"></i><a href="#">{{ $blog->visible_comments_count }}</a></li>
                    </ul>
                </div>
                <p>{{ $blog->full_decription }}</p>

            </div>
        </div>
    </article>

    <article class="post-author padding-10">
        <div class="media">
          <div class="media-left">
            <a href="#">
              <img alt="Author 1" src="{{ asset('website/img/author.jpg') }}" class="media-object">
            </a>
          </div>
          <div class="media-body">
            <h4 class="media-heading"><a href="#">Masaru Edo</a></h4>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis ad aut sunt cum, mollitia excepturi neque sint magnam minus aliquam, voluptatem, labore quis praesentium eum quae dolorum temporibus consequuntur! Non.</p>
          </div>
        </div>
    </article>

    <article class="post-comments">
        <h3><i class="fa fa-comments"></i> {{ $blog->visible_comments_count }}</h3>

        <div class="comment-body padding-10">
            <ul class="comments-list">
                @foreach ($comment as $comment )
                <li class="comment-item">
                    <div class="comment-heading clearfix">
                        <div class="comment-author-meta">
                            <h4>{{ $comment->name }} <small>{{ $comment->created_at }}</small></h4>
                        </div>
                    </div>
                    <div class="comment-content">
                        <p>{{ $comment->reply }}</p>

                    </div>
                </li>

                @endforeach




            </ul>

        </div>

        <div class="comment-footer padding-10">
            <h3>Leave a comment</h3>
            <form action="{{ route('website.blog.store') }}" method="POST">
                @csrf
                <div class="form-group required">
                    <label for="name">Name</label>
                    <input type="text" name="guest_name" id="name" class="form-control">
                </div>
                <div class="form-group required">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">

                    <input type="hidden" name="blog_id" value="{{ $blog->id }}">
                </div>
                <div class="form-group required">
                    <label for="comment">Comment</label>
                    <textarea name="comment" id="comment" rows="6" class="form-control"></textarea>
                </div>
                <div class="clearfix">
                    <div class="pull-left">
                        <button type="submit" class="btn btn-lg btn-success">Submit</button>
                    </div>
                    <div class="pull-right">
                        <p class="text-muted">
                            <span class="required">*</span>
                            <em>Indicates required fields</em>
                        </p>
                    </div>
                </div>
            </form>
        </div>

    </article>
</div>


@endsection
@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
@endsection
