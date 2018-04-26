<?php
/**
 * Created by PhpStorm.
 * User: francotestori
 * Date: 6/11/17
 * Time: 0:27
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Messages Language Lines
    |--------------------------------------------------------------------------
    |
    |
    */

    'no_items_found' => 'No items have been found.',

    'created' => 'Your :item has been created successfully!',
    'edited' => 'Your :item has been edited successfully!',
    'deleted' => 'Your :item has been deleted successfully!',
    'updated' => 'Update successful !',

    'forbidden' => 'You are not allowed to access this resource!',

    'threads' => [
        'open' => 'The thread is still active.',
        'close' => 'Thread has been close by',
        'operation' => 'Operation was',
        'ACCEPTED' => 'ACCEPTED',
        'REJECTED' => 'REJECTED',
        'USER_REJECTED' => 'REJECTED BY USER',
    ],

    'messenger' => [
        'tuft' => 'All sent and received messages',
        'empty' => 'There are no messages in your inbox !',
        'new' => 'Add a new message.',
        'accepting' => 'By clicking the accept button you\'re CONFIRMING this transaction and it\'s payment..',
        'rejecting' => 'By rejecting it, the operation will be suspended and will be reviewed by our administrators.',
    ],

    'transaction' => 'Your transaction was successful!',

    'attributed' => 'Your transaction was confirmed. You can now check you balance updated!',

    'sales' => 'Sales',
    'sales_subtitle' => 'Here you can see your addspaces\' sales',

    'wallet' =>[
        'tuft' => 'This is your transactions record. You can also withdraw your money here.',
    ],

    'addspaces' =>[
        'tuft' => 'This is your web\'s listing. Here you can create and edit them.',
    ],

    'editor' =>[
        'tuft' => 'This is your Editor panel. Send messages, create or update your webs, check your sales and watch your wallet.',
    ],

    'advertiser' =>[
        'tuft' => 'This is your Advertiser panel. Send messages, search for webs, check your purchases and watch your wallet.',
        'deactivate' => 'You are about to deactivate',
        'confirm' => 'Please confirm.',
    ],

    'filter' => 'Filter',

    'query' => 'Query from @:user related to :url',

    'sender' => 'Sender',
    'paypal_account' => 'Paypal Account',
    'cbu' => 'CBU',
    'alias' => 'Alias',
    'amount' => 'Amount',

    'activated' => ':item has been activated!',
    'paused' => ':item has been paused!',
    'closed' => ':item has been closed!',

    'rollbacked' => 'The transaction was rejected and is waiting for an EMarket admin confirmation.',

    'withdrawal' => [
        'accepted' => 'Withdrawal was accepted. Remember to send the payment!',
        'success' => 'Your withdrawal of u$s :amount has been requested successfully !',
        'failure' => 'Withdrawal must be within EMarketplace limits (u$s :min - u$s :max). You have u$s :available available to withdraw.',
    ],

    'password' => [
        'unauthorized' => 'You are not authorized to perform this action !',
        'different' => 'New password cannot be same as current.',
        'success' => 'Password has been changed successfully !',
    ],
];
