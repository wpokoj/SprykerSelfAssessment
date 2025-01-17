<?php

namespace Pyz\Client\FaqsRestApi;

use Generated\Shared\Transfer\FaqCollectionTransfer;
use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;


interface FaqsRestApiClientInterface
{
    /**
     * @api
     * @return \Generated\Shared\Transfer\FaqCollectionTransfer
     */
    public function getFaqCollection(FaqCollectionTransfer $faqCollectionTransfer): FaqCollectionTransfer;
    public function getFaqEntity(FaqTransfer $trans): ?FaqTransfer;

    public function createFaqEntity(FaqTransfer $trans): bool;
    public function deleteFaqEntity(FaqTransfer $trans): bool;
    public function updateFaqEntity(FaqTransfer $trans): bool;

    public function getUserVotesCollection(FaqVoteCollectionTransfer $coll): FaqVoteCollectionTransfer;
    public function getUserVoteByFaqId(FaqVoteTransfer $trans): FaqVoteTransfer;
    public function setUserVote(FaqVoteTransfer $trans): FaqVoteTransfer;
}
