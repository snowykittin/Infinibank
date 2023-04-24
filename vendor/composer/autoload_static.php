<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit1ead6ce07a3836fe5762e9902a70ffd1
{
    public static $classMap = array (
        'AboutView' => __DIR__ . '/../..' . '/views/about/about_view.class.php',
        'Account' => __DIR__ . '/../..' . '/models/account/account.class.php',
        'AccountController' => __DIR__ . '/../..' . '/controllers/account_controller.class.php',
        'AccountCreate' => __DIR__ . '/../..' . '/views/account/create/account_create.class.php',
        'AccountDetail' => __DIR__ . '/../..' . '/views/account/detail/account_detail.class.php',
        'AccountIndex' => __DIR__ . '/../..' . '/views/account/index/account_index.class.php',
        'AccountModel' => __DIR__ . '/../..' . '/models/account/account_model.class.php',
        'AccountSearch' => __DIR__ . '/../..' . '/views/account/search/account_search.class.php',
        'AccountTransaction' => __DIR__ . '/../..' . '/views/account/transaction/account_transaction.class.php',
        'AccountType' => __DIR__ . '/../..' . '/models/account/account_type.class.php',
        'ComposerAutoloaderInit1ead6ce07a3836fe5762e9902a70ffd1' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit1ead6ce07a3836fe5762e9902a70ffd1' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Currency' => __DIR__ . '/../..' . '/models/account/currency.class.php',
        'DataMissingException' => __DIR__ . '/../..' . '/exceptions/data_missing_exception.class.php',
        'Database' => __DIR__ . '/../..' . '/application/database.class.php',
        'DatabaseException' => __DIR__ . '/../..' . '/exceptions/database_exception.class.php',
        'Dispatcher' => __DIR__ . '/../..' . '/application/dispatcher.class.php',
        'ErrorView' => __DIR__ . '/../..' . '/views/error.class.php',
        'HomeController' => __DIR__ . '/../..' . '/controllers/home_controller.class.php',
        'HomeIndex' => __DIR__ . '/../..' . '/views/home/home_index.class.php',
        'IndexView' => __DIR__ . '/../..' . '/views/index_view.class.php',
        'InsufficientFundsException' => __DIR__ . '/../..' . '/exceptions/insufficient_funds_exception.class.php',
        'PageloadException' => __DIR__ . '/../..' . '/exceptions/pageload_exception.class.php',
        'Transaction' => __DIR__ . '/../..' . '/models/account/transaction.class.php',
        'TransactionSearch' => __DIR__ . '/../..' . '/views/account/search/transaction_search.class.php',
        'UnauthorizedAccessException' => __DIR__ . '/../..' . '/exceptions/unauthorized_access_exception.class.php',
        'User' => __DIR__ . '/../..' . '/models/user/user.class.php',
        'UserController' => __DIR__ . '/../..' . '/controllers/user_controller.class.php',
        'UserDetail' => __DIR__ . '/../..' . '/views/user/detail/user_detail.class.php',
        'UserEdit' => __DIR__ . '/../..' . '/views/user/edit/user_edit.class.php',
        'UserIndex' => __DIR__ . '/../..' . '/views/user/index/user_index.class.php',
        'UserIndexView' => __DIR__ . '/../..' . '/views/user/user_index_view.class.php',
        'UserLogin' => __DIR__ . '/../..' . '/views/user/login/user_login.class.php',
        'UserLogout' => __DIR__ . '/../..' . '/views/user/logout/user_logout.class.php',
        'UserModel' => __DIR__ . '/../..' . '/models/user/user_model.class.php',
        'UserNonVerify' => __DIR__ . '/../..' . '/views/user/login/user_nonverify.class.php',
        'UserRegister' => __DIR__ . '/../..' . '/views/user/register/user_register.class.php',
        'UserUpdate' => __DIR__ . '/../..' . '/views/user/update/user_update.class.php',
        'UserVerify' => __DIR__ . '/../..' . '/views/user/login/user_verify.class.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit1ead6ce07a3836fe5762e9902a70ffd1::$classMap;

        }, null, ClassLoader::class);
    }
}
