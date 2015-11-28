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
            | {{ $article->updated_at }} |
            <input id="input-id-avg" type="number" class="rating" min=0 max=5 step=1 readonly="true"  data-size="xs"
                   data-show-Caption="false" data-show-Clear="false" value="{{ round($article->average_rating) }}">
        </span><br>
        {!! HTML::tags($article) !!}

        <p>{!! $article->text !!}</p>
    </div>
    <div class="row">
        @if(Auth::check())
            <input id="input-id" type="number" class="rating" min=0 max=5 step=1 data-size="sm"
                   data-show-Caption="false" data-show-Clear="false">
        @endif

        @if(Auth::check() or $discussions->count()>0)
            <h3>Diskusia k článku</h3>
        @endif
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

        @forelse($discussions as $discussion)
            {!! HTML::discussion($discussion, $article->id) !!}
        @empty
            @if(Auth::check()) Žiadny diskusný príspevok. Buďte prvý!@endif
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