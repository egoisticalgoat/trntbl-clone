@extends('layouts.trntbl')

@section('title', 'Choose a blog')

@section('content')
    <div class="masthead clearfix">
        <div class="inner">
            <h3 class="masthead-brand"><a href="{{ url('/') }}">{{ strtoupper(env('APP_NAME')) }}</a></h3>
        </div>
    </div>
    <div class="inner cover">
        <h1 class="cover-heading">{{ strtoupper(env('APP_NAME')) }}</h1>
        <p class="lead">
            Hello! This page was made because <a href="http://www.trntbl.me">trntbl.me</a> is currently down.
            As long as this is the case, this page is intended to give you at least the basic functionality of trntbl.
        </p>
        <form class="lead form-inline" action="" method="POST" id="user-form">
            <div class="form-group">
                <input type="text" class="form-control" id="username" placeholder="Username">
                <input type="text" class="form-control" id="tag" placeholder="Tag (optional)">
            </div>
            <button type="submit" class="btn btn-default allowConsent" id="btn-listen">Listen</button>
        </form>
        @if(isset($error))
                <p class="text-danger lead">
                    {{ $error }}
                </p>
        @endif
    </div>
    <div class="mastfoot">
        <div class="inner">
            <p>Original idea by <a href="http://blog.trntbl.me/">trntbl</a>, this page was made by <a href="http://egoisticalgoat.tumblr.com">me</a>.</p>
            <p>The easiest way to contact me is on <a href="http://egoisticalgoat.tumblr.com">tumblr</a><span style="display: none"> or via <a rel="me" href="https://quey.org/@EgoisticalGoat">Mastodon</a></span>.
            I also have a list of <a href="{{ url('/my-site/known-bugs') }}">known bugs</a> and a <a href="{{ url('/my-site/cookies') }}">cookie policy</a> <a href=""></a>.</p>

            <script type='text/javascript' src='https://ko-fi.com/widgets/widget_2.js'></script><script type='text/javascript'>kofiwidget2.init('Support Me on Ko-fi', '#29abe0', 'A0A01HI69');kofiwidget2.draw();</script>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            var userform  = $('#user-form');
            var userfield = $('#username');
            var tagfield  = $('#tag');
            userform.submit(function () {
                var usernameregex = /(?:https?:\/\/)?([\w\-]+)(?:\.tumblr\.com\/?)?/;
                var username = userfield.val().toLowerCase().replace(usernameregex, '$1');
                var tag      = tagfield.val().toLowerCase();
                if (username !== "") {
                    userform.attr('action', "{{ url('/') }}/" + username + "/" + encodeURIComponent(tag));
                    setCookie("username", username, 90);
                    setCookie("tag", tag, 90);
                }
            });

            var userCookie = getCookie("username");
            if (userCookie !== "") {
                userfield.val(userCookie);
            }

            var tagCookie = getCookie("tag");
            if (tagCookie !== "") {
                tagfield.val(tagCookie);
            }
        });
    </script>
@endsection
