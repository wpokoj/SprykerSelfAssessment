<?php

namespace Pyz\Client\Faq\Zed;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

interface FaqZedStubInterface {

    public function getAllFaqs(FaqDataCollectionTransfer $trans): FaqDataCollectionTransfer;
}
