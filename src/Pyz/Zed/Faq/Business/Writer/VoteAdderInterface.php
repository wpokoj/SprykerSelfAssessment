<?php

namespace Pyz\Zed\Faq\Business\Writer;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface VoteAdderInterface  {

    public function addVote(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer;
    public function setFaqVote(FaqVoteTransfer $trans): FaqVoteTransfer;
}
