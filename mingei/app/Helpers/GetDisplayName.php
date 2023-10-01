<?php
use App\Models\Usermeta;

function GetDisplayName($userId = null) {

    if (is_null($userId)) $userId = auth()->id();

    $usermeta = Usermeta::where('user_id', $userId)->first();
 
    $displayName = !is_null($usermeta -> pinname) ? $usermeta -> pinname : $usermeta -> nickname;

    return $displayName;
}
