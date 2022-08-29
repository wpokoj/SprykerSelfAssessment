<?php

namespace Pyz\Zed\Faq\Business\Reader;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;

class VoteFinder implements VoteFinderInterface {

    protected FaqRepositoryInterface $repo;

    public function __construct(FaqRepositoryInterface $repo) {
        $this->repo = $repo;
    }

    public function findVote(FaqVoteRequestTransfer $trans): bool {
        return $this->repo->findFaqVote($trans);
    }
}
