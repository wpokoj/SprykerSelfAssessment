<?php

namespace Pyz\Yves\Faq\CustomerValidation;

interface CustomerValidatorInterface {

    public function isCustomerLogged(): bool;
    public function getLoggedCustomerId(): ?int;
}
