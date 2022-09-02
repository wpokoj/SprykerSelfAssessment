<?php

namespace Pyz\Zed\Faq\Communication\Validator\PaginationTransferValidator;

use Generated\Shared\Transfer\FaqErrorTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

interface PaginationTransferValidatorInterface {

    public function validate(?PaginationTransfer $trans): ?FaqErrorTransfer;
}
