<?php

namespace Imdhemy\GooglePlay\Subscriptions;

use Imdhemy\GooglePlay\ValueObjects\AcknowledgementState;
use Imdhemy\GooglePlay\ValueObjects\Cancellation;
use Imdhemy\GooglePlay\ValueObjects\IntroductoryPriceInfo;
use Imdhemy\GooglePlay\ValueObjects\PaymentState;
use Imdhemy\GooglePlay\ValueObjects\Price;
use Imdhemy\GooglePlay\ValueObjects\Promotion;
use Imdhemy\GooglePlay\ValueObjects\PurchaseType;
use Imdhemy\GooglePlay\ValueObjects\SubscriptionPriceChange;
use Imdhemy\GooglePlay\ValueObjects\Time;

/**
 * Subscription purchase class
 * A SubscriptionPurchase resource indicates the status of a user's subscription purchase.
 * @link https://developers.google.com/android-publisher/api-ref/rest/v3/purchases.subscriptions#SubscriptionPurchase
 */
class SubscriptionPurchase
{
    /**
     * @var string|null
     */
    protected $kind;

    /**
     * @var int|null
     */
    protected $startTimeMillis;

    /**
     * @var int|null
     */
    protected $expiryTimeMillis;

    /**
     * @var int|null
     */
    protected $autoResumeTimeMillis;

    /**
     * @var bool|null
     */
    protected $autoRenewing;

    /**
     * @var string|null
     */
    protected $priceCurrencyCode;

    /**
     * @var int|null
     */
    protected $priceAmountMicros;

    /**
     * @var array|null
     */
    protected $introductoryPriceInfo;

    /**
     * @var string|null
     */
    protected $countryCode;

    /**
     * @var string|null
     */
    protected $developerPayload;

    /**
     * @var int|null
     */
    protected $paymentState;

    /**
     * @var int|null
     */
    protected $cancelReason;

    /**
     * @var int|null
     */
    protected $userCancellationTimeMillis;

    /**
     * @var array|null
     */
    protected $cancelSurveyResult;

    /**
     * @var string|null
     */
    protected $orderId;

    /**
     * @var string|null
     */
    protected $linkedPurchaseToken;

    /**
     * @var int|null
     */
    protected $purchaseType;

    /**
     * @var array|null
     */
    protected $priceChange;

    /**
     * @var string|null
     */
    protected $profileName;

    /**
     * @var string|null
     */
    protected $emailAddress;

    /**
     * @var string|null
     */
    protected $givenName;

    /**
     * @var string|null
     */
    protected $familyName;

    /**
     * @var string|null
     */
    protected $profileId;

    /**
     * @var int|null
     */
    protected $acknowledgementState;

    /**
     * @var string|null
     */
    protected $externalAccountId;

    /**
     * @var int|null
     */
    protected $promotionType;

    /**
     * @var string|null
     */
    protected $promotionCode;

    /**
     * @var string|null
     */
    protected $obfuscatedExternalAccountId;
    /**
     * @var string|null
     */
    protected $obfuscatedExternalProfileId;

    /**
     * @var array
     */
    protected $plainResponse;

    /**
     * @param array $responseBody
     * @return self
     */
    public static function fromArray(array $responseBody): self
    {
        $object = new self();

        $attributes = array_keys(get_class_vars(self::class));
        foreach ($attributes as $attribute) {
            if (isset($responseBody[$attribute])) {
                $object->$attribute = $responseBody[$attribute];
            }
        }

        $object->plainResponse = $responseBody;

        return $object;
    }

    /**
     * @ return string|null
     */
    public function getKind(): ?string
    {
        return $this->kind;
    }

    /**
     * @ return bool|null
     */
    public function isAutoRenewing(): ?bool
    {
        return $this->autoRenewing;
    }

    /**
     * @ return string|null
     */
    public function getPriceCurrencyCode(): ?string
    {
        return $this->priceCurrencyCode;
    }

    /**
     * @ return int|null
     */
    public function getPriceAmountMicros(): ?int
    {
        return $this->priceAmountMicros;
    }

    /**
     * @ return string|null
     */
    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }

    /**
     * @ return string|null
     */
    public function getDeveloperPayload(): ?string
    {
        return $this->developerPayload;
    }

    /**
     * @ return string|null
     */
    public function getOrderId(): ?string
    {
        return $this->orderId;
    }

    /**
     * @ return string|null
     */
    public function getLinkedPurchaseToken(): ?string
    {
        return $this->linkedPurchaseToken;
    }

    /**
     * @ return string|null
     */
    public function getEmailAddress(): ?string
    {
        return $this->emailAddress;
    }

    /**
     * @ return string|null
     */
    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    /**
     * @ return string|null
     */
    public function getProfileId(): ?string
    {
        return $this->profileId;
    }

    /**
     * @ return string|null
     */
    public function getExternalAccountId(): ?string
    {
        return $this->externalAccountId;
    }

    /**
     * @ return string|null
     */
    public function getObfuscatedExternalAccountId(): ?string
    {
        return $this->obfuscatedExternalAccountId;
    }

    /**
     * @ return string|null
     */
    public function getObfuscatedExternalProfileId(): ?string
    {
        return $this->obfuscatedExternalProfileId;
    }

    /**
     * @return Time|null
     */
    public function getStartTime(): ?Time
    {
        return $this->startTimeMillis ? new Time($this->startTimeMillis) : null;
    }

    /**
     * @return Time|null
     */
    public function getExpiryTime(): ?Time
    {
        return $this->expiryTimeMillis ? new Time($this->expiryTimeMillis) : null;
    }

    /**
     * @return Time|null
     */
    public function getAutoResumeTime(): ?Time
    {
        return $this->autoResumeTimeMillis ? new Time($this->autoResumeTimeMillis) : null;
    }

    /**
     * @return IntroductoryPriceInfo|null
     */
    public function getIntroductoryPriceInfo(): ?IntroductoryPriceInfo
    {
        return $this->introductoryPriceInfo ?
            IntroductoryPriceInfo::fromArray($this->introductoryPriceInfo) :
            null;
    }

    /**
     * @return SubscriptionPriceChange|null
     */
    public function getPriceChange(): ?SubscriptionPriceChange
    {
        if (is_null($this->priceChange)) {
            return null;
        }

        $newPrice = Price::fromArray($this->priceChange['newPrice']);
        $state = $this->priceChange['state'];

        return new SubscriptionPriceChange($newPrice, $state);
    }

    /**
     * @return Cancellation|null
     */
    public function getCancellation(): ?Cancellation
    {
        if (
            is_null($this->cancelReason)
            && is_null($this->userCancellationTimeMillis)
            && is_null($this->cancelSurveyResult)
        ) {
            return null;
        }

        return Cancellation::fromScalars(
            $this->cancelReason,
            $this->userCancellationTimeMillis,
            $this->cancelSurveyResult
        );
    }

    /**
     * @return AcknowledgementState|null
     */
    public function getAcknowledgementState(): ?AcknowledgementState
    {
        return is_int($this->acknowledgementState) ?
            new AcknowledgementState($this->acknowledgementState) :
            null;
    }

    /**
     * @return PaymentState|null
     */
    public function getPaymentState(): ?PaymentState
    {
        return is_int($this->paymentState) ?
            new PaymentState($this->paymentState) :
            null;
    }

    /**
     * @return PurchaseType|null
     */
    public function getPurchaseType(): ?PurchaseType
    {
        return is_int($this->purchaseType) ? new PurchaseType($this->purchaseType) : null;
    }

    /**
     * @return string|null
     */
    public function getProfileName(): ?string
    {
        return $this->profileName;
    }

    /**
     * @return string|null
     */
    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    /**
     * @return Promotion|null
     */
    public function getPromotion(): ?Promotion
    {
        if (is_null($this->promotionType)) {
            return null;
        }

        return new Promotion($this->promotionType, $this->promotionCode);
    }

    /**
     * @return array
     */
    public function getPlainResponse(): array
    {
        return $this->plainResponse;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return $this->getPlainResponse();
    }
}
