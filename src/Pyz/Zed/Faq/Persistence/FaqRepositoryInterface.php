<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;

interface FaqRepositoryInterface {

    public function findFaqEntityById(int $id): ?FaqTransfer;

    public function getFaqCollection(FaqCollectionTransfer $trans): FaqCollectionTransfer;
    public function getFaqCollectionPaginated(FaqDataCollectionTransfer $trans): FaqDataCollectionTransfer;

    public function findFaqVote(FaqVoteRequestTransfer $trans): bool;
}
