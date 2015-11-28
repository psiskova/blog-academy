<?php

HTML::macro('discussion', function ($discussion, $article_id) {

    $result = '<div class="discussion-main col-xs-12">
                <div class="discussion-commentary row">
                    <div class="col-xs-3">' . HTML::profilePicture($discussion->user, '100%', '100%', ['class' => 'discussion-profile col-xs-3']) . '</div>
                    <div class="col-xs-9 discussion-right">
                        <span class="discussion-author-info">' . link_to_action('UserController@getProfile', $discussion->user->fullname, ['user_id' => $discussion->user->slug]) . ' | ' . $discussion->created_at . '</span>
                        <p>' . $discussion->text . '</p>
                    </div>';
    if (Auth::check()) {
        $result .= '<div class="col-xs-12 discussion-bottom">
                        <span class="reply-link pull-right">
                            <a onclick="resizeArea(' . $discussion->id . ')" name="reply">Odpovedať</a>
                        </span>'
                            . Form::open(['url' => action('DiscussionController@postAddDiscussion'), 'method'=>'post']).
                             Form::hidden('parent', $discussion->id) . Form::hidden('article_id', $article_id).
                                '<textarea id="' . $discussion->id . '" class="reply" style="" name="text"></textarea>
                                <br>' . Form::submit('Odoslať', ['class' => 'btn btn-ba-style hidden-btn ' . $discussion->id, 'name' => 'action']) .
                            Form::close().
            '</div>';
    }
    $children = \App\Models\Discussion::where('parent', '=', $discussion->id)->orderBy('created_at', 'ASC')->get();
    foreach ($children as $child) {
        $result .= HTML::discussion($child, $article_id);
    }
    $result .= '</div>
            </div>';

    return $result;
});