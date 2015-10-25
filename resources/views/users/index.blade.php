@foreach($users as $user)
    <a href="{{ action('UserController@getProfile', [$user->slug]) }}">{{ $user->name }}</a><br>
@endforeach

<script src="js/laroute.js"></script>