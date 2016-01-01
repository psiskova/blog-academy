@extends('layouts.master')

@section('content')
    <div class="container-fluid row faq">
        <div class="col-md-8 col-md-offset-2 push container_content">
            <h1>FAQ</h1>

            <div class="panel-group" id="generally">
                <div class="faqHeader">Všeobecné</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle" data-toggle="collapse" data-parent="#generally"
                               href="#collapseOne">Kto môže blogovať na blogacademy.top?</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            Blogový portál <a href="/">blogacademy.top</a> je určený výhradne pre žiakov a učiteľov
                            Gymnázia FMFI
                            Mlynská dolina.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseTwo">Ako môžem začať blogovať?</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            Prvým krokom je vytvorenie konta v
                            časti {!! link_to_action('Auth\AuthController@getRegister', 'Registrácia') !!}. Uvediete
                            svoje meno, priezvisko, email
                            a heslo. Po úspešnej registrácii sa môžete prihlásiť do systému.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseThree">Zabudol som heslo a nemôžem sa prihlásiť. Čo mám robiť?</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            V časti {!! link_to_action('Auth\AuthController@getLogin', 'Prihlásenie') !!} kliknite na
                            link „{!! link_to_action('Auth\PasswordController@getEmail', 'Zabudol som heslo') !!}“.
                            Zadajte svoj prihlasovací e-mail.
                            V doručenej pošte si následne nájdete odkaz, kde môžete zadať nové heslo.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseFour">Čo znamená „Kecálek“ na nástenke vpravo?</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            V časti „Kecálek“ sa zobrazujú 3 blogeri, ktorí majú najviac publikovaných článkov.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseFive">Čo znamená „Hviezda“ na nástenke vpravo?</a>
                        </h4>
                    </div>
                    <div id="collapseFive" class="panel-collapse collapse">
                        <div class="panel-body">
                            V časti „Hviezda“ sa zobrazujú 3 blogeri, ktorí majú najlepšie priemerné hodnotenie všetkých
                            článkov.
                        </div>
                    </div>
                </div>

                <div class="faqHeader">Žiak</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseSix">Ako sa zapíšem na predmet?</a>
                        </h4>
                    </div>
                    <div id="collapseSix" class="panel-collapse collapse">
                        <div class="panel-body">
                            V menu zvoľte možnosť {!! link_to_action('CourseController@getOverview', 'Zapísať sa') !!}.
                            Zobrazia sa vám všetky aktuálne predmety. Kliknite na tlačidlo „Prihlásiť sa“.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseSeven">Prihlásil som sa na predmet, ale nemám ho vo výbere predmetov v
                                hlavnom menu.</a>
                        </h4>
                    </div>
                    <div id="collapseSeven" class="panel-collapse collapse">
                        <div class="panel-body">
                            Po prihlásení na predmet musíte počkať, kým vás schváli učiteľ, až potom budete oficiálne
                            zapísaní.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseEight">Ako napísať príspevok?</a>
                        </h4>
                    </div>
                    <div id="collapseEight" class="panel-collapse collapse">
                        <div class="panel-body">
                            Blogy sa vytvárajú v
                            časti {!! link_to_action('ArticleController@getCreate', 'Pridať článok') !!}. Po kliknutí na
                            tlačidlo „Odoslať“ sa článok
                            publikuje. Nezabúdajte, že článok musí byť v súlade s pravidlami. O tom, ako napísať dobrý
                            blog si prečítate napríklad v článku Vytvoriť dobrý blog nie je ťažké! 7 pravidiel pre
                            tvorbu blogu.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseNine">Kde získam informácie o mojom hodnotení učiteľom?</a>
                        </h4>
                    </div>
                    <div id="collapseNine" class="panel-collapse collapse">
                        <div class="panel-body">
                            Hodnotenie učiteľa nájdete v
                            časti {!! link_to_action('UserController@getGrading', 'Hodnotenie') !!}.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseTen">Čo znamenajú hviezdičky pri článku?</a>
                        </h4>
                    </div>
                    <div id="collapseTen" class="panel-collapse collapse">
                        <div class="panel-body">
                            Každý článok môže byť hodnotený učiteľom, ale aj ostatnými žiakmi formou
                            hviezdičiek. V hlavičke článku sa zobrazuje priemerné hodnotenie článku všetkými užívateľmi,
                            pod článkom je vaše hodnotenie, ktoré ste pridali. Čím viac hviezdičiek článok má, tým je
                            obľúbenejší.
                        </div>
                    </div>
                </div>

                <div class="faqHeader">Učiteľ</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseEleven">Kde si môžem pridať svoj predmet?</a>
                        </h4>
                    </div>
                    <div id="collapseEleven" class="panel-collapse collapse">
                        <div class="panel-body">
                            V menu zvoľte
                            možnosť {!! link_to_action('CourseController@getOverview', 'Moje Predmety') !!}. Následne v
                            menu vpravo nájdete
                            možnosť {!! link_to_action('CourseController@getCreate', 'Pridať predmet') !!}.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseTwelve">Môžem mať viac ako jeden predmet?</a>
                        </h4>
                    </div>
                    <div id="collapseTwelve" class="panel-collapse collapse">
                        <div class="panel-body">
                            Áno, počet predmetov na učiteľa nie je limitovaný.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseThirteen">Ako vytvorím zadanie?</a>
                        </h4>
                    </div>
                    <div id="collapseThirteen" class="panel-collapse collapse">
                        <div class="panel-body">
                            V menu zvoľte
                            možnosť {!! link_to_action('CourseController@getOverview', 'Moje Predmety') !!}. Následne v
                            menu vpravo nájdete
                            možnosť {!! link_to_action('TaskController@getCreate', 'Vytvoriť zadanie') !!}.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseFifteen">Kde ohodnotím príspevky svojich žiakov?</a>
                        </h4>
                    </div>
                    <div id="collapseFifteen" class="panel-collapse collapse">
                        <div class="panel-body">
                            V menu zvoľte možnosť {!! link_to_action('UserController@getGrading', 'Hodnotenie') !!} a v
                            zobrazenej tabuľke vyberte konkrétny článok, ktorý chcete ohodnotiť.
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="generally-toggle collapsed" data-toggle="collapse" data-parent="#generally"
                               href="#collapseSixteen">Kde nájdem hodnotenie svojich žiakov?</a>
                        </h4>
                    </div>
                    <div id="collapseSixteen" class="panel-collapse collapse">
                        <div class="panel-body">
                            Všetky hodnotenia sú v tabuľke v
                            časti {!! link_to_action('UserController@getGrading', 'Hodnotenie') !!}.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop