<div class="right_col_profile">
    <div class="row">
        <div class="pencil"></div>
        <div class="text-center">
            {!! HTML::profilePicture($user, 120, 120) !!}
            <h4>{{ $user->fullname }}</h4>

            <p>{{ $user->email }}</p>
            @if(Auth::check() && $user->id == Auth::id())
                <p>{!! link_to_action('UserController@getUpdateProfile', 'Upraviť profil', [])!!}</p>
                <p>{!! link_to_action('ArticleController@getCreate', "Nový článok") !!}</p>
                {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->published()->count() /*--}}
                <p>{!! link_to_action('ArticleController@getMyArticles', "Publikované články " . ($count ? ('('.$count.')') : '')) !!}</p>
                {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->draft()->count() /*--}}
                <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}</p>
            @endif
        </div>
    </div>
</div>