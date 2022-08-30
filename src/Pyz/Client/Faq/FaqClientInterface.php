<?php

namespace Pyz\Client\Faq;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

interface FaqClientInterface {

    public function getAllFaqs(FaqCollectionTransfer $trans): FaqCollectionTransfer;
    public function sendVoteRequest(FaqVoteTransfer $trans): FaqVoteTransfer;
}
