<?php

namespace Pyz\Zed\Faq\Communication\Validator;

use Generated\Shared\Transfer\FaqErrorTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

interface PaginationTransferValidatorInterface {

    public function validate(?PaginationTransfer $trans): ?FaqErrorTransfer;
}
