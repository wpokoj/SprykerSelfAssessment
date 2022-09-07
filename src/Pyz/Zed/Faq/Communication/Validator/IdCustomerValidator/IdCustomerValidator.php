<?php

namespace Pyz\Zed\Faq\Communication\Validator\IdCustomerValidator;

use Generated\Shared\Transfer\FaqErrorTransfer;

class IdCustomerValidator implements IdCustomerValidatorInterface {

    public function validateIdCustomer(?int $id): ?FaqErrorTransfer {

        return ($id > 0 || $id === null)
            ? null
            : (new FaqErrorTransfer())
                ->setCode('003')
                ->setStatus(400)
                ->setDetail('Customer Id must be a positive integer');
    }
}
