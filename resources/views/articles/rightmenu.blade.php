<div class="row">
    <p>tu budeme vypisovat profil autora</p>
    {!! link_to_action('ArticleController@getCreate', "Nový článok") !!} <br>
    {!! link_to_action('ArticleController@getMyArticles', "Publikované články (počet)") !!} <br>
    {!! link_to_action('ArticleController@getMyDrafts', "Koncepty (počet)") !!} <br>
</div>

