<?php

return [
//------------------------//
// SYSTEM SETTINGS
//------------------------//
    'student_list' => true,

    /**
     * Registration Needs Activation.
     *
     * If set to true users will have to activate their accounts using email account activation.
     */
    'rna' => true,

    /**
     * Login With Email.
     *
     * If set to true users will have to login using email/password combo.
     */
    'lwe' => true, 

    /**
     * Force Strong Password.
     *
     * If set to true users will have to use passwords with strength determined by StrengthValidator.
     */
    'fsp' => false,

    /**
     * Set the password reset token expiration time.
     */
    'user.passwordResetTokenExpire' => 3600,

    'brd' => false, //DEFAULT BOARD MESSAGE SETTINGS
    
    'sbr' => false, //DEFAULT SIDEBAR SETTINGS

    'adminEmail' => 'admin@proverbs.com', 

    /**
     * Not used in template.
     * You can set support email here.
     */
    'supportEmail' => 'support@proverbs.com',

    //DEFAULTS
    'pageSize' => 20,

    'avatar' =>  '/uploads/ui/user-blue.svg',

    'pjaxInterval' => 10000,

    'fetchInterval' => 2000,

    'announcementInterval' => 60000,

    'boardInterval' => 50100,
    
    'day' => '-1 day',

    'hour' => '-1 hour',

    'toastTimeout' => 5000,
    
    'pjaxTimeout' => 360000,
];
