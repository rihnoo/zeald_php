<?php

class Router
{

    /**
    * I don't think this solution is not really efficient.
    * This solution has a issue in parsing Uri and mapping to Controller's action.
    * This way works only when you create Virtual Host.
    * so uri should match with this format: http://dev.localhost/export?type=playerstats&team=TOR
    */
    public static function parse($url, $request)
    {
        $url = trim($url);
        
        $explode_url = explode('/', $url);
        $explode_url = array_slice($explode_url, 1);

        $uri = $explode_url[0];

        $explode_url1 = explode('?', $uri);

        $request->controller = $explode_url1[0];
        $request->action = 'index';
        parse_str($explode_url1[1], $params);
        $request->params = $params;
    }
}
