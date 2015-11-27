@extends('layouts.9-3')

@section('scripts')
    {!! HTML::script('js/star-rating.min.js') !!}
    {!! HTML::script('js/reply-comment.js') !!}
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
                <!-- Form::open Form::hidden for discussion -->

        <div class="form-group">
            <label for="comment-area">Komentár:</label>
            <textarea class="form-control" rows="4" id="comment-area"></textarea>
            {!! Form::submit('Pridať komentár', ['class'=>'btn btn-ba-style', 'name' => 'action']) !!}

        </div>
        <!-- FORM::submit & FORM::close -->
        @endif

        <div class="discussion-main col-xs-12">
            <div class="discussion-commentary row">
                <div class="col-xs-3">
                    <img class="discussion-profile col-xs-3"
                         src="http://blogdailyherald.com/wp-content/uploads/2014/10/wallpaper-for-facebook-profile-photo.jpg">
                </div>
                <div class="col-xs-9 discussion-right">
                    <span class="discussion-author-info">Author name (link) | date</span>

                    <p>In finibus facilisis est non ultricies. Donec a consequat neque, sit amet pulvinar nisi. Suspendisse potenti. Quisque suscipit felis metus, ut mattis orci sagittis in. Duis consequat nec lectus a tempus. Nulla a dictum dolor. In interdum iaculis risus, ac convallis libero mollis eu. Sed ac dictum est, id consequat augue. Aliquam rutrum, erat dignissim semper rutrum, diam metus lacinia est, vel luctus odio mauris non diam. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Sed vestibulum arcu enim, quis volutpat magna porta eu.</p>
                    <span class="reply-link">
                        <a onclick="resizeArea(141)" name="reply">Odpovedať</a>
                    </span>
                    <br>
                    <!-- (ID textarea) treba generovat pre kazdy koment a potom ho poslat do resizeArea funkcie ako parameter -->

                    <!-- odoslat button prislucha k jednotlivemu komentaru, preto treba ako triedu poslat toto ID aj tam -->
                    <textarea id="141" class="reply" style="" name="text"></textarea>
                    <br>
                    {!! Form::submit('Odoslať', ['class'=>'btn btn-ba-style 141 hidden-btn', 'name' => 'action']) !!}
                </div>
            </div>
        </div>

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