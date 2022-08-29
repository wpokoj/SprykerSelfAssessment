<?php

namespace Pyz\Zed\Faq\Communication\Controller;

use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Pyz\Zed\Faq\Communication\FaqCommunicationFactory;
use Pyz\Zed\Faq\Persistence\FaqEntityManager;
use Spryker\Zed\Kernel\Communication\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @method FaqCommunicationFactory getFactory()
 */
class DebugController extends AbstractController {

    public function indexAction() {

        (new FaqEntityManager())
            ->addVote((new FaqVoteRequestTransfer())
            ->setIdFaq(3)
            ->setFaqCustomer((new FaqCustomerTransfer())
            ->setCustomerId(6)));
    }

    public function  tableAction(): JsonResponse {


    }
}
