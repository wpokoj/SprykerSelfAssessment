<?php

namespace Pyz\Zed\Faq\Business\Reader;

use Generated\Shared\Transfer\FaqVoteCollectionTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;

class VoteFinder implements VoteFinderInterface {

    protected FaqRepositoryInterface $repo;

    public function __construct(FaqRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function findVote(FaqVoteRequestTransfer $trans): bool {
        return $this->repo->findFaqVote($trans);
    }

    public function getFaqVoteCollection(FaqVoteCollectionTransfer $trans): FaqVoteCollectionTransfer {
        return $this->repo->getFaqVoteCollection($trans);
    }

    public function getFaqVoteById(FaqVoteTransfer $trans): FaqVoteTransfer {
        return $this->repo->getFaqVoteById($trans);
    }
}
