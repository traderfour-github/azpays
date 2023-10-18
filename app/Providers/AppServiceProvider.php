<?php

namespace App\Providers;

use App\Repositories\Discount\DiscountRepository;
use App\Repositories\Discount\IDiscountRepository;
use App\Repositories\Gateways\GatewayRepository;
use App\Repositories\Gateways\IGatewayRepository;
use App\Repositories\Networks\INetworkRepository;
use App\Repositories\Networks\NetworkRepository;
use App\Repositories\Rates\IRateRepository;
use App\Repositories\Rates\RateRepository;
use App\Repositories\Subscription\ISubscriptionRepository;
use App\Repositories\Subscription\SubscriptionRepository;
use App\Repositories\SubscriptionPlan\ISubscriptionPlanRepository;
use App\Repositories\SubscriptionPlan\SubscriptionPlanRepository;
use App\Repositories\SubscriptionPurchase\ISubscriptionPurchaseRepository;
use App\Repositories\SubscriptionPurchase\SubscriptionPurchaseRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\Purse\PurseRepository;
use App\Repositories\Purse\IPurseRepository;
use App\Repositories\Payments\PaymentRepository;
use App\Repositories\Payments\IPaymentRepository;
use App\Repositories\Merchants\MerchantRepository;
use App\Repositories\Merchants\IMerchantRepository;
use App\Repositories\Transactions\TransactionRepository;
use App\Repositories\Transactions\ITransactionRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        app()->bind(IMerchantRepository::class, MerchantRepository::class);
        app()->bind(ITransactionRepository::class, TransactionRepository::class);
        app()->bind(IDiscountRepository::class, DiscountRepository::class);
        app()->bind(IPaymentRepository::class, PaymentRepository::class);
        app()->bind(IPurseRepository::class, PurseRepository::class);
        app()->bind(ISubscriptionRepository::class, SubscriptionRepository::class);
        app()->bind(ISubscriptionPlanRepository::class, SubscriptionPlanRepository::class);
        app()->bind(ISubscriptionPurchaseRepository::class, SubscriptionPurchaseRepository::class);
        app()->bind(IRateRepository::class, RateRepository::class);
        app()->bind(INetworkRepository::class, NetworkRepository::class);
        app()->bind(IGatewayRepository::class, GatewayRepository::class);
    }
}
