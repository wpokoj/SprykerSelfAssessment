<?php

namespace Pyz\Yves\Faq\CustomerValidation;

use Spryker\Client\Customer\CustomerClientInterface;

class CustomerValidator implements CustomerValidatorInterface {

    protected CustomerClientInterface $customerClient;

    public function __construct(CustomerClientInterface $customerClient) {

        $this->customerClient = $customerClient;
    }

    public function isCustomerLogged(): bool {

        return $this->customerClient->isLoggedIn();
    }

    public function getLoggedCustomerId(): ?int {
        // no null safe operator :(
        // return $this->customerClient->getCustomer()?->getIdCustomer;

        $customer = $this->customerClient->getCustomer();

        if($customer === null) {
            return null;
        }

        return $customer->getIdCustomer();
    }
}
