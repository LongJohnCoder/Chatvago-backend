<?php

return [
    'errors'  => [
        'configuration' =>  [
            
            /**Subscription messages*/
            
            'subscription'  =>  [
                'plan_name_required'            =>  'Please provide the plan name.',
                'plan_id_required'              =>  'Please provide the plan id.',
                'plan_price_required'           =>  'Please provide the plan price.',
                'plan_price_numeric'            =>  'Please provide a valid price.',
                'plan_interval_required'        =>  'Please provide the plan interval.',
                'profile_creation_required'     =>  'Please provide the number of users that can be created with this plan.',
                'profile_creation_integer'      =>  'Please provide a valid input for this field.',
                'pages_per_user_required'       =>  'Please provide the number of pages that can be associated with a user.',
                'pages_per_user_integer'        =>  'Please provide a valid input for this field.',
            ],
            
            /**Subscription Intervals messages*/
            
            'intervals'  =>  [
                'interval_name_required'        =>  'Please provide the interval name.',
                'interval_required'             =>  'Please provide the interval.',
                'interval_count_required'       =>  'Please provide the interval count field.',
            ],

            /**Admin messages*/

            'admin'  =>  [
                'name_required'         =>  'Please provide the admin name.',
                'email_required'        =>  'Please provide the admin email.',
                'email_email'           =>  'Please provide a valid email address.',
                'email_unique'          =>  'This email has already been taken.',
            ],

            /**End User messages*/

            'end_user'  =>  [
                'name_required'                      =>  'Please provide the end user name.',
                'email_required'                     =>  'Please provide the end user email.',
                'email_email'                        =>  'Please provide a valid email address.',
                'email_unique'                       =>  'This email has already been taken.',
                'password_required'                  =>  'Please provide a password.',
                'confirm_password_required'          =>  'Please confirm the password.',
                'confirm_password_same'              =>  'Password and confirm password should match.',
            ]
        ]
    ]
];