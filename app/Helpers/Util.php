<?php

namespace App\Helpers;

class Util
{
    public static function valueOrNull($value)
    {
        return $value ?? null;
    }

    public static function updatedMessage()
    {
        return "<div class=\"alert alert-success\" role=\"alert\">
                         <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                             <span aria-hidden=\"true\">&times;</span>
                         </button>
                           You have updated!
                 </div>";
    }

}
