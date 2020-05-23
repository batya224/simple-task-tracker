<?php
session_start();

function set_alert_message($name, $message, $class)
{
    if (!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
    }

    if (!empty($_SESSION[$name . '_class'])) {
        unset($_SESSION[$name . '_class']);
    }


    $_SESSION[$name] = $name;
    $_SESSION[$name . '_message'] = $message;
    $_SESSION[$name . '_class'] = $class;

}

function get_alert_message($name)
{
    if (!isset($_SESSION[$name]) || empty($_SESSION[$name]))
        return;

    echo '<div class="alert ' . $_SESSION[$name . '_class'] . '">' . $_SESSION[$name . '_message'] . '</div>';

    unset($_SESSION[$name]);
    unset($_SESSION[$name . '_message']);
    unset($_SESSION[$name . '_class']);
}

function is_logged_in()
{
    return isset($_SESSION['user_id']) ? true : false;
}

function get_user_id()
{
    return isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
}

function get_user_meta($field)
{
    $User = new User;
    $ID = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
    $user = $User->get_user('ID', $ID);

    return $user->$field;

}
