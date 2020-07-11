@extends('layouts.general')

@section('title', 'Cookie policy')

@section('content')
    <h1 class="cover-heading">Cookie Policy for {{ strtoupper(env('APP_NAME')) }}</h1>
    <h2>What Are Cookies</h2>
    Many websites store cookies on your computer.<br />
    Cookies are tiny files that are downloaded to your computer and managed by your browser. Their purpose is to store snippets of information between visits (e.g. shopping cart contents or visual settings).<br />
    This page describes why and for what we use cookies. We also give you the option to opt-out of our use of cookies.<br />
    <br />
    For more general information on cookies see the <a href="https://en.wikipedia.org/wiki/HTTP_cookie">Wikipedia article on HTTP Cookies...</a><br />
    <h2>The Cookies We Set</h2>
    For some of the settings you can change (e.g. setting volume levels and shuffle function) we store the value in cookies, so that on your next visit everything is as you left it.<br />
    <h2>Disabling Cookies</h2>
    You can change your cookie consent by clicking this button: <button class="btn btn-sm btn-default changeCookieConsent">Revoke cookie consent</button>
    <h2>More Information</h2>
    Hopefully that has clarified things for you.<br />
    Usually, unless you know what you're doing, you should leave cookies enabled, though in this case the impact of disabling cookies on this site is negligible.<br />
    If you have any more questions, feel free to contact me, either via twitter (<a href="https://twitter.com/sunflowerfuchs">@SunflowerFuchs</a>) or via tumblr (<a href="https://egoisticalgoat.tumblr.com">tumblr</a>).<br />
@endsection

@section('scripts')
    <script>Consent.initButtons()</script>
@endsection
