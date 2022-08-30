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

    public function addVote(FaqVoteTransfer $trans): FaqVoteTransfer {
        return $this->ent->addVote($trans);
    }
}
