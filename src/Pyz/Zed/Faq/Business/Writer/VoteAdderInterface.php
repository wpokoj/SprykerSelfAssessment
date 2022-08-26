<?php

namespace Pyz\Zed\Faq\Business\Writer;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;

interface VoteAdderInterface  {

    public function addVote(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer;
}
