<?php

namespace Pyz\Zed\Faq\Business\Reader;

use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface VoteFinderInterface {

    public function findVote(FaqVoteRequestTransfer $trans): bool;
    public function getFaqVoteCollection(FaqVoteCollectionTransfer $trans): FaqVoteCollectionTransfer;
    public function getFaqVoteById(FaqVoteTransfer $trans): FaqVoteTransfer;
}
