<?php
function format_status($status)
{
    $statusses = [0 => 'В процессе', 1 => 'Выполнено'];
    if (isset($statusses[$status]))
        return $statusses[$status];
    return 'Unknown status';
}

function format_modified($modified_time)
{
    if (isset($modified_time) && !empty($modified_time)) {
        $returnText = ", </br>";
        $returnText .= 'Отредактировано администратором';
        return $returnText;
    }

}
