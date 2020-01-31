<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Default Settings Store
	|--------------------------------------------------------------------------
	|
	| This option controls the default settings store that gets used while
	| using this settings library.
	|
	| Supported: "json", "database"
	|
	*/
	'store' => 'database',

	/*
	|--------------------------------------------------------------------------
	| JSON Store
	|--------------------------------------------------------------------------
	|
	| If the store is set to "json", settings are stored in the defined
	| file path in JSON format. Use full path to file.
	|
	*/
	'path' => storage_path().'/settings.json',

	/*
	|--------------------------------------------------------------------------
	| Database Store
	|--------------------------------------------------------------------------
	|
	| The settings are stored in the defined file path in JSON format.
	| Use full path to JSON file.
	|
	*/
	// If set to null, the default connection will be used.
	'connection' => null,
	// Name of the table used.
	'table' => 'settings',
	// Cache usage configurations.
	'enableCache' => false,
	'forgetCacheByWrite' => true,
	'cacheTtl' => 15,
	// If you want to use custom column names in database store you could
	// set them in this configuration
	'keyColumn' => 'key',
	'valueColumn' => 'value',
    
    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    |
    | Define all default settings that will be used before any settings are set,
    | this avoids all settings being set to false to begin with and avoids
    | hardcoding the same defaults in all 'Settings::get()' calls
    |
    */
    'defaults' => [
        'general_page_title' => 'McShop.io',
        'general_page_description' => 'Proudly powered by McShop.io!',
        'general_page_tags' => 'mcshop.io,mcshop,io,mc,shop,sms,item,vmc,vmcshop,minecraft,mine,craft',
        'general_page_favicon' => env('APP_URL') . '/images/default-server-image.png',
        'general_page_logo' => env('APP_URL') . '/images/logo.png',
        'general_page_background' => env('APP_URL') . '/images/background.png',
        
        'layout_theme' => 'mcshop'
    ]
];
