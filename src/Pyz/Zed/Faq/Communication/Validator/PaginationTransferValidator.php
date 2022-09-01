<?php

namespace Pyz\Zed\Faq\Communication\Validator;

use Generated\Shared\Transfer\FaqErrorTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

class PaginationTransferValidator implements PaginationTransferValidatorInterface {


    public function validate(?PaginationTransfer $trans): ?FaqErrorTransfer {

        if($trans === null) {
            return null;
        }

        if($trans->getPage() === null || $trans->getLimit() === null) {
            return (new FaqErrorTransfer())
                ->setDetail('No pagination data')
                ->setCode('002')
                ->setStatus(400);
        }

        if($trans->getPage() <= 0 || $trans->getLimit() <= 0) {
            return (new FaqErrorTransfer())
                ->setDetail('Pagination data invalid')
                ->setCode('002')
                ->setStatus(400);
        }

        return null;
    }
}
