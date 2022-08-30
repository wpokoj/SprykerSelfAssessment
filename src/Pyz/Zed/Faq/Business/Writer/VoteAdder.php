<?php

namespace Pyz\Zed\Faq\Business\Writer;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;

class VoteAdder implements VoteAdderInterface {

    protected FaqEntityManagerInterface $ent;

    public function __construct(FaqEntityManagerInterface $ent) {
        $this->ent = $ent;
    }

    public function addVote(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer {
        return $this->ent->addVote($trans);
    }

    public function setFaqVote(FaqVoteTransfer $trans): FaqVoteTransfer {
        return $trans;
    }
}
