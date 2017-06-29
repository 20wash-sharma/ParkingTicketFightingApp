<?php

function checkPermission($module,$action,$permission){
    foreach($permission as $singleP){
        if($singleP->GroupName == $module && $singleP->name == $action)
            return true;
    }
    return false;
}