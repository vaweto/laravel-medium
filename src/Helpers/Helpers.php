<?php

namespace Vaweto\Medium\Helpers;

use Carbon\Carbon;

class Helpers
{
    public static function formatMediumDate($data): Carbon
    {
        return Carbon::createFromFormat(
            'D, d M Y H:i:s \G\M\T',
            $data
        );
    }
}
