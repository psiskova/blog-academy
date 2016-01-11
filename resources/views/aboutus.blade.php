@extends('layouts.master')

@section('content')
    <div class="container-fluid row">
        <div class="col-md-8 col-md-offset-2 push container_content">
            <h1>O nás</h1>
            <div class="text-center">
                <p class="font-large">Sme blogerská komunita pozostávajúca z učiteľov a žiakov Gymnázia FMFI Mlynská dolina. </p>
                <div class="row">
                <img src="public/img/school.jpg" alt="Fotka budovy skoly" class="center-block col-md-7 img-aboutus" height="300">
                    <div class="main_q col-md-5 center-block text-center">
                        <blockquote class="main_quote font-large">
                            <p>Keď nevieš - naučíme Ťa!</p>
                            <p>Keď nevládzeš - pomôžeme Ti!</p>
                            <p>Keď sa Ti nechce - zvládneme to bez Teba!</p>
                        </blockquote>
                    </div>
                </div>

                <div class="row bordered">
                    <div class="col-md-4">
                        máme {{ trans_choice('bloggers.count', $usersCount) }}
                    </div>
                    <div class="col-md-4">
                        zverejnili sme {{ trans_choice('articles.count', $articlesCount) }}
                    </div>
                    <div class="col-md-4">
                        vložili sme {{ trans_choice('discussions.count', $commentsCount) }}
                    </div>
                </div>
                <h2>Naši učitelia</h2>
                {!! HTML::profileGrid($users) !!}
            </div>
        </div>
    </div>
@stop