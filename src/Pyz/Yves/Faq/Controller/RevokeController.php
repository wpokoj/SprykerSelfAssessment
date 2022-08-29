<?php

namespace Pyz\Yves\Faq\Controller;

use Generated\Shared\Transfer\FaqCustomerTransfer;
use Generated\Shared\Transfer\FaqVoteRequestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RevokeController extends AbstractController {

    public function indexAction(Request $req): \Symfony\Component\HttpFoundation\RedirectResponse {

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
            ->setValue(false);

        $this->getClient()->sendVoteRequest($data);

        $this->addSuccessMessage('Revoked successfully');
        return $this->redirectResponseInternal('/faq');
    }
}
