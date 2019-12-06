<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FlavorParamsVideoType extends Enum
{
    const WEB_H264x400 =   2;
    const WEB_H264x600 =   3;
    const WEB_H264x900 =   4;
    const WEB_H264x1500 =  5;
    const WEB_H264x2500 =  6;
    const WEB_H264x4000 =  7;
    const WEB_NOT_VIDEO =  0;
}
