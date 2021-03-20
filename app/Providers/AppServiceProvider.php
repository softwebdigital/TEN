<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\VerificationToken;
use App\Thrift;
use App\Payment;
use App\Beneficiary;
use App\Observers\UserObserver;
use App\Observers\VerificationTokenObserver;
use App\Observers\PaymentObserver;
use App\Observers\ThriftObserver;
use App\Observers\BeneficiaryObserver;

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
        Schema::defaultStringLength(191);
        User::observe(UserObserver::class);
        VerificationToken::observe(VerificationTokenObserver::class);
        Thrift::observe(ThriftObserver::class);
        Payment::observe(PaymentObserver::class);
        Beneficiary::observe(BeneficiaryObserver::class);
        $this->loadViewsFrom(__DIR__.'/views/vendors', 'larapex-charts'); 
    }
}
