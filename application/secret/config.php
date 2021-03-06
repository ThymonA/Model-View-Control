<?php

/**
 * Class config
 * @author   Thymon Arens <contact@thymonarens.nl>
 * @version 1.0 2017-08-22-STARTED (NOT RELEASED)
 * @link https://github.com/ThymonA/webshop/
 */

class config
{
    //======================================================================================================//
    //@todo                                          Config                                                 //
    //======================================================================================================//
    //                                            Basic Config                                              //
    //======================================================================================================//
    const development_mode = true;                          // Example: false                               //
    const website_language = 'nl';                          // Example: 'en'                                //
    const website_content_language = 'nl_nl';               // Example: 'en-gb'                             //
    const application_name = 'Thymon Arens MVC';            // Example: 'Thymon & Co'                       //
    //======================================================================================================//
    //                                          Database Config                                             //
    //======================================================================================================//
    const db_type = 'mysql';                                // Example: 'mysql'                             //
    const db_server = '127.0.0.1';                          // Example: 'localhost' or '127.0.0.1'          //
    const db_username = 'username';                         // Example: 'username'                          //
    const db_password = '';                         // Example: 'password'                          //
    const db_database = 'database';                         // Example: 'database'                          //
    const db_port = 3306;                                   // Example: 3306                                //
    const db_charset = 'utf8';                              // Example: 'utf8'                              //
    //======================================================================================================//
    //                                           Server Config                                              //
    //======================================================================================================//
    const serverSalt = 'L6mXiW5LxCHnMfYVBNnasRqeCiGLNBPQ';  // Example: 'QITdCK0tUzfJnced70LhY4dLOSBWNWX9'  //
    //======================================================================================================//
    //                                           Google Config                                              //
    //======================================================================================================//
    const analytics_code = '';                              // Example: 'UA-12345-1'                        //
    const analytics_visitorCookieTimeout = 15768000000;     // Example: 15768000000                         //
    const analytics_domainName = '';                        // Example: 'example.com'                       //
    const analytics_ignoredOrganic = '';                    // Example: 'example.com'                       //
    //======================================================================================================//
    //                                             End Config                                               //
    //======================================================================================================//
}