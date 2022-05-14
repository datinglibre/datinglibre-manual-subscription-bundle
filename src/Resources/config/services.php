<?php

declare(strict_types=1);

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use DatingLibre\AppApi\Subscription\SubscriptionEventServiceInterface;
use DatingLibre\ManualSubscriptionBundle\Services\DatingLibreManualSubscriptionProvider;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services->set(DatingLibreManualSubscriptionProvider::class)
        ->public()
        ->autowire(true)
        ->autoconfigure(true)
        ->args(['%datinglibre.manual_signup_active%', service(SubscriptionEventServiceInterface::class)])
        ->tag('datinglibre.subscription_provider_service', []);
};
