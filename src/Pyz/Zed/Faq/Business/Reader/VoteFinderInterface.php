<?php

namespace Pyz\Zed\Faq\Business\Reader;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;

interface VoteFinderInterface {

    public function findVote(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer;
}
