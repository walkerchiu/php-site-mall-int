<?php

namespace WalkerChiu\SiteMall\Models\Entities;

use WalkerChiu\Core\Models\Entities\Lang;

class EmailLang extends Lang
{
    /**
     * Create a new instance.
     *
     * @param Array  $attributes
     * @return void
     */
    public function __construct(array $attributes = [])
    {
        $this->table = config('wk-core.table.site-mall.emails_lang');

        parent::__construct($attributes);
    }
}
