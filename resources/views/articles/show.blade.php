@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/star-rating.min.js') !!}
    {!! HTML::script('js/article.show.js') !!}
@stop

@section('left')
    {!! HTML::style('css/star-rating.min.css') !!}
    <div class="row">
        <h3>{{ $article->title }}</h3>
        <span class="article-info">{!! link_to_action('UserController@getProfile', $article->user->fullname, ['user_id' => $article->user->slug])!!}
            | {{ $article->updated_at }} | {{ $article->average_rating }}</span><br>
        {!! HTML::tags($article) !!}

        <p>{!! $article->text !!}</p>
    </div>
    <div class="row">
        @if(Auth::check())
            <input id="input-id" type="number" class="rating" min=0 max=5 step=1 data-size="sm"
                   data-show-Caption="false" data-show-Clear="false">
        @endif

        <h3>Diskusia k článku</h3>
        @if(Auth::check())
            {!! Form::open(['url' => action('DiscussionController@postAddDiscussion'), 'method'=>'post']) !!}
            {!! Form::hidden('article_id', $article->id) !!}
            <div class="form-group">
                <label for="comment-area">Komentár:</label>
                <textarea class="form-control" rows="4" id="comment-area" name="text"></textarea>
                {!! Form::submit('Pridať komentár', ['class'=>'btn btn-ba-style', 'name' => 'action']) !!}
            </div>
            {!! Form::close() !!}
        @endif

        @forelse($article->discussions as $discussion)
            <div class="discussion-main col-xs-12">
                <div class="discussion-commentary row">
                    <div class="col-xs-3">
                        {!! HTML::profilePicture($discussion->user, '100%', '100%', ['class' => 'discussion-profile col-xs-3']) !!}
                    </div>
                    <div class="col-xs-9 discussion-right">
                        <span class="discussion-author-info">{!! link_to_action('UserController@getProfile', $discussion->user->fullname, ['user_id' => $discussion->user->slug])!!}
                            | {{ $discussion->created_at }}</span>

                        <p>{{ $discussion->text }}</p>
                    </div>
                    @if(Auth::check())
                        <div class="col-xs-12 discussion-bottom">
                        <span class="reply-link pull-right">
                            <a onclick="resizeArea(141)" name="reply">Odpovedať</a>
                        </span>
                            <!-- (ID textarea) treba generovat pre kazdy koment a potom ho poslat do resizeArea funkcie ako parameter -->

                            <!-- odoslat button prislucha k jednotlivemu komentaru, preto treba ako triedu poslat toto ID aj tam -->
                            <textarea id="141" class="reply" style="" name="text"></textarea>
                            <br>
                            {!! Form::submit('Odoslať', ['class'=>'btn btn-ba-style 141 hidden-btn', 'name' => 'action']) !!}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            Žiadny diskusný príspevok. Buďte prvý!
        @endforelse
    </div>
@stop

@section('right')
    <div class="row">
        <div class="right_col_profile right_col_profile_bottom text-center mobile_profile">
            {{--<img src="{{ url($user->image) }}">--}}
            {!! HTML::profilePicture($article->user, 120, 120) !!}
            <h4>{!! link_to_action('UserController@getProfile', $article->user->fullname, ['user_id' => $article->user->slug])!!}  </h4>

            <p>{{ $article->user->email }}</p>

            <p>{!! link_to_action('UserController@getProfile', 'publikované články ('.$article->user->articles()->published()->count().')', ['user_id' => $article->user->slug]) !!}</p>
        </div>
        {{--{!! link_to_action('**TODO presmerovanie', 'publikované články('.**TODO pocet.')',['user_id' => $article->slug]) !!} --}}
        {{--@foreach($article->user->articles as $art)
            <p>{!! link_to_action('ArticleController@getShow', 'b' , ['user_id' => $art->slug]) !!}</p>
        @endforeach--}}
    </div>
@stop