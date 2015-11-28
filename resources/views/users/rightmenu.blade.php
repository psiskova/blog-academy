<div class="right_col_profile right_col_profile_bottom mobile_profile">
    <div class="pencil"></div>
    <div class="text-center">
        {!! HTML::profilePicture($user, 120, 120) !!}
        <h4>{{ $user->fullname }}</h4>
        <p>{{ $user->email }}</p>
        @if(Auth::check() && $user->id == Auth::id())
            <p>{!! link_to_action('UserController@getUpdateProfile', 'Upraviť profil', [])!!}</p>
            <div class = "separator"></div>
            <p>{!! link_to_action('ArticleController@getCreate', "Nový článok") !!}</p>
            {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->published()->count() /*--}}
            <p>{!! link_to_action('ArticleController@getMyArticles', "Publikované články" . ($count ? ('('.$count.')') : '')) !!}</p>
            {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->draft()->count() /*--}}
            <p>{!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}</p>
            @if(Auth::user()->hasRole(\App\Models\User::STUDENT_ROLE))
                <p>{!! link_to_action('CourseController@getOverview', "Zapísať sa na predmet") !!}</p>
            @else
                <p>{!! link_to_action('CourseController@getOverview', "Správa predmetov") !!}</p>
            @endif
        @else
            <p>{!! link_to_action('UserController@getProfile', "Publikované články (" . $user->countPublishedArticles() . ')' , ['user_id' => $article->user->slug]) !!}</p>
        @endif
    </div>
</div>