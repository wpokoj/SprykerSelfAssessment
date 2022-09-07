<?php

namespace Pyz\Shared\FaqSearch;

class FaqSearchConstants {
    /**
     * Specification:
     * - Queue name as used for processing planet messages
     *
     * @api
     *
     * @var string
     */
    public const FAQ_SYNC_SEARCH_QUEUE = 'sync.search.faq';
}
