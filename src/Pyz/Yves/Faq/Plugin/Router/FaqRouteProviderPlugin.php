<?php

namespace Pyz\Yves\Faq\Plugin\Router;

use Spryker\Yves\Router\Plugin\RouteProvider\AbstractRouteProviderPlugin;
use Spryker\Yves\Router\Route\RouteCollection;

class FaqRouteProviderPlugin extends AbstractRouteProviderPlugin {

    protected const ROUTE_FAQ_INDEX  = '/faq';
    protected const ROUTE_FAQ_VOTE   = '/faq/vote';
    protected const ROUTE_FAQ_REVOKE   = '/faq/revoke';

    /**
     * Specification:
     * - Adds Routes to the RouteCollection.
     *
     * @param RouteCollection $routeCollection
     *
     * @return RouteCollection
     * @api
     *
     */
    public function addRoutes(RouteCollection $routeCollection): RouteCollection {

        $routeCollection = $this->addFaqIndexRoute($routeCollection);

        return $routeCollection;
    }

    /**
     * @param RouteCollection $routeCollection
     *
     * @return RouteCollection
     */
    protected function addFaqIndexRoute(RouteCollection $routeCollection): RouteCollection {

        $route = $this->buildRoute('/faq', 'Faq', 'Index', 'indexAction');
        $routeCollection->add(static::ROUTE_FAQ_INDEX, $route);

        $route = $this->buildRoute('/faq/vote', 'Faq', 'Vote', 'voteAction');
        $routeCollection->add(static::ROUTE_FAQ_VOTE, $route);

        $route = $this->buildRoute('/faq/revoke', 'Faq', 'Vote', 'revokeAction');
        $routeCollection->add(static::ROUTE_FAQ_REVOKE, $route);

        return $routeCollection;
    }
}
