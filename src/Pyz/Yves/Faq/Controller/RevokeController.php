<?php

namespace Pyz\Yves\Faq\Controller;

use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class RevokeController extends AbstractController {

    public function indexAction(Request $req): \Symfony\Component\HttpFoundation\RedirectResponse {

        return $this->redirectResponseInternal('/faq');
    }
}
