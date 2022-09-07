<?php

namespace Pyz\Zed\Faq\Communication\Validator\IdCustomerValidator;

use Generated\Shared\Transfer\FaqErrorTransfer;

interface IdCustomerValidatorInterface {

    public function validateIdCustomer(?int $id): ?FaqErrorTransfer;
}
