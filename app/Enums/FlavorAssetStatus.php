<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class FlavorAssetStatus extends Enum
{
    const ERROR = -1;
    const QUEUED = 0;
    const CONVERTING = 1;
    const READY = 2;
    const DELETED = 3;
    const NOT_APPLICABLE = 4;
    const TEMP = 5;
    const WAIT_FOR_CONVERT = 6;
    const IMPORTING = 7;
    const VALIDATING = 8;
    const EXPORTING = 9;
}
