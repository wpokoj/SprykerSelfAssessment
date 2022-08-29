<?php

namespace Pyz\Yves\Faq;

use Pyz\Yves\Faq\CustomerValidation\CustomerValidator;
use Pyz\Yves\Faq\CustomerValidation\CustomerValidatorInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Yves\Kernel\AbstractFactory;

class FaqFactory extends AbstractFactory {

    public function createCustomerValidator(): CustomerValidatorInterface {

        return new CustomerValidator(
            $this->getCustomerClient()
        );
    }

    protected function getCustomerClient(): CustomerClientInterface {

        return $this->getProvidedDependency(FaqDependencyProvider::CUSTOMER_CLIENT);
    }
}
