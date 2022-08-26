<?php

namespace Pyz\Zed\Faq\Business\Reader;

use Pyz\Zed\Faq\Persistence\FaqRepositoryInterface;

class VoteFinder implements VoteFinderInterface {

    protected FaqRepositoryInterface $repo;

    public function __construct(FaqRepositoryInterface $repo) {
        $this->repo = $repo;
    }
}
