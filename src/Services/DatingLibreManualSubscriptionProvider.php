<?php

declare(strict_types=1);

namespace DatingLibre\ManualSubscriptionBundle\Services;

use DatingLibre\AppApi\Subscription\SubscriptionEventServiceInterface;
use DatingLibre\AppApi\Subscription\SubscriptionProviderInterface;
use Symfony\Component\Uid\Uuid;

class DatingLibreManualSubscriptionProvider implements SubscriptionProviderInterface
{
    private bool $isSignupActive;
    private const SUBSCRIPTION_PROVIDER_NAME = 'manual';
    private SubscriptionEventServiceInterface $subscriptionEventService;

    public function __construct(bool $isSignupActive, SubscriptionEventServiceInterface $subscriptionEventService)
    {
        $this->isSignupActive = $isSignupActive;
        $this->subscriptionEventService = $subscriptionEventService;
    }

    public function getName(): string
    {
        return self::SUBSCRIPTION_PROVIDER_NAME;
    }

    public function getSignupUrl(Uuid $userId): string
    {
        return '';
    }

    public function isSignupActive(): bool
    {
        return $this->isSignupActive;
    }

    public function getCancellationUrl(Uuid $userId, string $subscriptionId): ?string
    {
        return null;
    }

    /**
     * The event generated in this function would usually come from
     * a webhook, however as this is a manual subscription, we generate
     * it ourselves.
     */
    public function cancel(string $subscriptionId, array $data): string
    {
        $this->subscriptionEventService->cancel(self::SUBSCRIPTION_PROVIDER_NAME, $subscriptionId, $data);
        return 'Posted cancellation event';
    }

    public function getStatus(string $subscriptionId): string
    {
        return 'Search user subscriptions to display status of manual subscriptions';
    }

    public function refund(string $subscriptionId, array $data): string
    {
        $this->subscriptionEventService->refund(self::SUBSCRIPTION_PROVIDER_NAME, $subscriptionId, $data);
        return 'Posted refund event';
    }

    public function verifyWebhookIps(): ?bool
    {
        return true;
    }
}
