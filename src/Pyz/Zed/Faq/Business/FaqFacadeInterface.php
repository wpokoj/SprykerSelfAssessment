<?php

namespace Pyz\Zed\Faq\Business;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqDataCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

interface FaqFacadeInterface {

    public function createFaqEntity(FaqTransfer $trans): FaqTransfer;
    public function updateFaqEntity(FaqTransfer $trans): FaqTransfer;
    public function deleteFaqEntity(FaqTransfer $trans): void;

    public function findFaqEntityById(int $id): ?FaqTransfer;

    public function getFaqCollection(FaqCollectionTransfer $trans): FaqCollectionTransfer;
    public function getFaqCollectionPaginated(FaqDataCollectionTransfer $trans): FaqDataCollectionTransfer;

    public function addFaqVote(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer;
    public function revokeFaqVote(FaqVoteRequestTransfer $trans): void;
    public function findFaqVote(FaqVoteRequestTransfer $trans): bool;

    public function getFaqEntity(FaqTransfer $trans): ?FaqTransfer;
}
