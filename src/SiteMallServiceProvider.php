<?php

namespace WalkerChiu\SiteMall;

use Illuminate\Support\ServiceProvider;
use WalkerChiu\SiteMall\Providers\EventServiceProvider;

class SiteMallServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfig();
        $this->app['router']->aliasMiddleware('wkSiteEnable' , config('wk-core.class.site-mall.verifyEnable'));

        $this->app->register(EventServiceProvider::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
           __DIR__ .'/config/site-mall.php' => config_path('wk-site-mall.php'),
        ], 'config');

        // Publish migration files
        $from = __DIR__ .'/database/migrations/';
        $to   = database_path('migrations') .'/';
        $this->publishes([
            $from .'create_wk_site_mall_table.php'
                => $to .date('Y_m_d_His', time()) .'_create_wk_site_mall_table.php'
        ], 'migrations');

        $this->loadViewsFrom(__DIR__.'/views', 'php-site-mall');
        $this->publishes([
           __DIR__.'/views' => resource_path('views/vendor/php-site-mall'),
        ]);

        $this->loadTranslationsFrom(__DIR__.'/translations', 'php-site-mall');
        $this->publishes([
            __DIR__.'/translations' => resource_path('lang/vendor/php-site-mall'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                config('wk-site-mall.command.cleaner'),
                config('wk-site-mall.command.initializer')
            ]);
        }

        config('wk-core.class.site-mall.site')::observe(config('wk-core.class.site-mall.siteObserver'));
        config('wk-core.class.site-mall.siteLang')::observe(config('wk-core.class.site-mall.siteLangObserver'));
        config('wk-core.class.site-mall.email')::observe(config('wk-core.class.site-mall.emailObserver'));
        config('wk-core.class.site-mall.emailLang')::observe(config('wk-core.class.site-mall.emailLangObserver'));
        config('wk-core.class.site-mall.layout')::observe(config('wk-core.class.site-mall.layoutObserver'));
        config('wk-core.class.site-mall.layoutLang')::observe(config('wk-core.class.site-mall.layoutLangObserver'));
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
    }

    /**
     * Merges user's and package's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        if (!config()->has('wk-site-mall')) {
            $this->mergeConfigFrom(
                __DIR__ .'/config/site-mall.php', 'wk-site-mall'
            );
        }

        $this->mergeConfigFrom(
            __DIR__ .'/config/site-mall.php', 'site-mall'
        );
    }

    /**
     * Merge the given configuration with the existing configuration.
     *
     * @param String  $path
     * @param String  $key
     * @return void
     */
    protected function mergeConfigFrom($path, $key)
    {
        if (
            !(
                $this->app instanceof CachesConfiguration
                && $this->app->configurationIsCached()
            )
        ) {
            $config = $this->app->make('config');
            $content = $config->get($key, []);

            $config->set($key, array_merge(
                require $path, $content
            ));
        }
    }
}
