<?php

namespace Pyz\Yves\Faq\Controller;

use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Pyz\Client\Faq\FaqClientInterface;
use Pyz\Yves\Faq\FaqFactory;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method FaqFactory getFactory()
 * @method FaqClientInterface getClient()
 */
class VoteController extends AbstractController {

    public function indexAction(Request $req) {
        $validator = $this->getFactory()->createCustomerValidator();

        if(!$validator->isCustomerLogged()) {
            $this->addErrorMessage('You must be logged in to perform this action');
            return $this->redirectResponseInternal('/faq');
        }

        $faqId = $req->request->get('id-faq');

        if($faqId === null) {
            $this->addErrorMessage('Missing id');
            return $this->redirectResponseInternal('/faq');
        }

        $faqId = intval($faqId);

        $data = (new FaqVoteRequestTransfer())
            ->setFaqCustomer((new FaqCustomerTransfer())
                ->setCustomerId($validator->getLoggedCustomerId()))
            ->setIdFaq($faqId)
            ->setValue(true);

        $this->getClient()->sendVoteRequest($data);

        $this->addSuccessMessage('Voted successfully');
        return $this->redirectResponseInternal('/faq');
    }
}
