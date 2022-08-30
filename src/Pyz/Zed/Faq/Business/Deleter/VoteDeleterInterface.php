<?php

namespace Pyz\Zed\Faq\Business\Deleter;

use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface VoteDeleterInterface {

    public function deleteVote(FaqVoteTransfer $trans): void;
}
