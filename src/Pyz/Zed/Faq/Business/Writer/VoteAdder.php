<?php

namespace Pyz\Zed\Faq\Business\Writer;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Pyz\Zed\Faq\Persistence\FaqEntityManagerInterface;

class VoteAdder implements VoteAdderInterface {

    protected FaqEntityManagerInterface $ent;

    public function __construct(FaqEntityManagerInterface $ent) {
        $this->ent = $ent;
    }

    public function addVote(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer {
        return $this->ent->addVote($trans);
    }
}
