<?php

return [
//------------------------//
// SYSTEM SETTINGS
//------------------------//

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
];
