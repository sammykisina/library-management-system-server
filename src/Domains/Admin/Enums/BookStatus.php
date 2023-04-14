<?php

declare(strict_types=1);

namespace Domains\Admin\Enums;

enum BookStatus: string {
    case READIN = "readin";
    case BORROWABLE = "borrowable";
}
