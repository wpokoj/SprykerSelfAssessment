<?php

namespace Pyz\Zed\Faq\Dependency;

interface FaqEvents {
    public const ENTITY_PYZ_FAQ_CREATE = 'Entity.pyz_faq.create';
    public const ENTITY_PYZ_FAQ_UPDATE = 'Entity.pyz_faq.update';
    public const ENTITY_PYZ_FAQ_DELETE = 'Entity.pyz_faq.delete';

}
