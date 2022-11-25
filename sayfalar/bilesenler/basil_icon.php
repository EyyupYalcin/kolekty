<?php

function basil_icon($type, $cat, $name){
    $icon_file = fopen("assets/Basil-Icons/Basil Icons/svg/".$type."/".$cat."/".$name.".svg", "r") or die("Unable to open file!");
    $icon_content = fread($icon_file,filesize("assets/Basil-Icons/Basil Icons/svg/".$type."/".$cat."/".$name.".svg"));
    fclose($icon_file);
    $icon_content = str_replace('fill="black"', 'fill="currentColor" ', $icon_content);
    $icon_content = str_replace('<svg ', '<svg style="color: inherit;" ', $icon_content);
    return $icon_content;
}

?>