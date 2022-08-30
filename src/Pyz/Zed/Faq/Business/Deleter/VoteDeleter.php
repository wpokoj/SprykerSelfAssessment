<?php

namespace Pyz\Zed\Faq\Business\Deleter;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Zed\Faq\Business\Reader\VoteFinderInterface;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;

class VoteDeleter implements VoteDeleterInterface {

    protected FaqEntityManagerInterface $ent;

    public function __construct(FaqEntityManagerInterface $ent) {
        $this->ent = $ent;
    }

    public function deleteVote(FaqVoteTransfer $trans): void {
        $this->ent->revokeVote($trans);
    }
}
