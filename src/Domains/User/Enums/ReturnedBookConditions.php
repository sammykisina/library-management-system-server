<?php

declare(strict_types=1);

namespace Domains\User\Enums;

enum ReturnedBookConditions: string {
    case NOTHASGIVEN = 'not has given';
    case HASGIVEBN = 'has given';
    case LOST = 'lost';
}
