<?php

namespace Pyz\Client\Faq\Zed;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

interface FaqZedStubInterface {

    public function getAllFaqs(FaqCollectionTransfer $trans): FaqCollectionTransfer;
    public function sendVoteRequest(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer;
}
