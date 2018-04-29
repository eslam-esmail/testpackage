<?php

namespace OlaHub\Events;

use Illuminate\Queue\SerializesModels;

abstract class OlaHubAdminEvent
{
    use SerializesModels;
}
