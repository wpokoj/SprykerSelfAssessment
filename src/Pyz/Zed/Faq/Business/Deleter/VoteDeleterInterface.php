<?php

namespace Pyz\Zed\Faq\Business\Deleter;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;

interface VoteDeleterInterface {

    public function deleteVote(FaqVoteRequestTransfer $trans): void;
}
