<div class="row">
    <p>tu budeme vypisovat profil autora</p>
    {!! link_to_action('ArticleController@getCreate', "Nový článok") !!} <br>
    {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->published()->count() /*--}}
    {!! link_to_action('ArticleController@getMyArticles', "Publikované články " . ($count ? ('('.$count.')') : '')) !!}
    <br>
    {{--*/ $count = \App\Models\Article::where('user_id', '=', Auth::id())->draft()->count() /*--}}
    {!! link_to_action('ArticleController@getMyDrafts', "Koncepty " . ($count ? ('('.$count.')') : '')) !!}
    <br>
</div>