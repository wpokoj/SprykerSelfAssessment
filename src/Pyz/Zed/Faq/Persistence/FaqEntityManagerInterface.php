<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Generated\Shared\Transfer\FaqVoteTransfer;

interface FaqEntityManagerInterface {

    public function createFaqEntity(FaqTransfer $trans): FaqTransfer;
    public function updateFaqEntity(FaqTransfer $trans): FaqTransfer;
    public function deleteFaqEntity(FaqTransfer $trans): void;

    public function addVote(FaqVoteTransfer $trans): FaqVoteTransfer;
    public function revokeVote(FaqVoteTransfer $trans): void;
}
