<?php
function redirect($page)
{
    header('Location: ' . BASE_URL . '/' . $page);
    die();
}

function get_url()
{
    if (isset($_GET['url'])) {
        $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        return $url;
    }

}


function generateLink($path, $params = [], $append_request_params = false)
{
    $url = BASE_URL . '/' . trim($path, '/');

    if ($append_request_params) {
        $req_url = $_SERVER['REQUEST_URI'];
        $query_str = parse_url($req_url, PHP_URL_QUERY);
        parse_str($query_str, $query_params);
        if (isset($query_params)) {
            $params = array_merge($query_params, $params);
        }
    }

    if (isset($params) && count($params) > 0) {
        $url = $url . "?" . http_build_query($params);
    }
    return $url;
}