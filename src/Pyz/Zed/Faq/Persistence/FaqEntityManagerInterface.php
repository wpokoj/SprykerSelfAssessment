<?php

namespace Pyz\Zed\Faq\Persistence;

use Generated\Shared\Transfer\FaqTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;

interface FaqEntityManagerInterface {

    public function createFaqEntity(FaqTransfer $trans): FaqTransfer;
    public function updateFaqEntity(FaqTransfer $trans): FaqTransfer;
    public function deleteFaqEntity(FaqTransfer $trans): void;

    public function addVote(FaqVoteRequestTransfer $trans): FaqVoteRequestTransfer;
    public function revokeVote(FaqVoteRequestTransfer $trans): void;
}
