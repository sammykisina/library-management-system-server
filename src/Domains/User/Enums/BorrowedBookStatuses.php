<?php

declare(strict_types=1);

namespace Domains\User\Enums;

enum BorrowedBookStatuses: string {
    case NOTAPPROVED = 'not approved';
    case REJECTED = 'rejected';
    case APPROVEDAWAITINGRETURN= 'approved awaiting return';
    case RETURNED = 'returned';
    case REPORTEDLOST = 'reported lost';
    case NOTIFIEDTORETURNBOOKTODAY = 'notified to return book today';
    case NOTIFIEDOFLATERETURN = 'notified of late return';
}
