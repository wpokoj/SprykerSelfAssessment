<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqRepositoryInterface {

    public function findFaqEntityById(int $id): ?FaqTransfer;
    public function getFaqCollection(FaqCollectionTransfer $trans): FaqCollectionTransfer;

    public function getFaqVoteCollection(FaqVoteCollectionTransfer $trans): FaqVoteCollectionTransfer;
    public function findFaqVoteById(FaqVoteTransfer $trans): FaqVoteTransfer;
}
