<?php
function generateId(){
    $randStr = uniqueid('', true);
    return $randStr;
}
echo generateId();