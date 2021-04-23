<?php
namespace App\Http\Controllers;

class OauthController extends Controller
{
    function oauth()
    {
        // $oauth = new \Oauth(config('services.etsy.key'), config('services.etsy.secret'));
        $url = "https://openapi.etsy.com/v2/oauth/request_token?scope=email_r,listings_r";
        $url = urlencode($url);
        dd($url);
        $req_token = $oauth->getRequestToken("",
        config('app.url')."/oauth/callback",
        'GET');
        session(['oauth_token' => $req_token['oauth_token']]);
        session(['oauth_token_secret' => $req_token['oauth_token_secret']]);

        return redirect()->to($req_token['login_url']);
    }

    function oauthCallback(Request $request)
    {
        // get temporary credentials from the url
        $request_token = $request->input('oauth_token');

        // get the temporary credentials secret - this assumes you set the request secret
        // in a cookie, but you may also set it in a database or elsewhere
        // $request_token_secret = $_COOKIE['request_secret'];
        $request_token_secret = session('oauth_token_secret');

        // get the verifier from the url
        $verifier = $request->input('oauth_verifier');

        $oauth = new OAuth(config('services.etsy.key'), config('services.etsy.secret'));

        // set the temporary credentials and secret
        $oauth->setToken($request_token, $request_token_secret);

        $acc_token = $oauth->getAccessToken("https://openapi.etsy.com/v2/oauth/access_token", null, $verifier, "GET");

        return response()->json($acc_token);
    }

    function testRequest()
    {
        $access_token = 'b0668a84b634ce86cce319a3d8df57';// get from db
        $access_token_secret = 'c442ea72d3';// get from db

        $oauth = new \Oauth(config('services.etsy.key'), config('services.etsy.secret'));
        $oauth->setToken($access_token, $access_token_secret);

        $data = $oauth->fetch("https://openapi.etsy.com/v2/users/__SELF__", null, OAUTH_HTTP_METHOD_GET);
        $json = $oauth->getLastResponse();
        dd($json);
        return response()->json($json, true);
    }
}
