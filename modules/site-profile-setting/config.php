<?php

return [
    '__name' => 'site-profile-setting',
    '__version' => '0.0.1',
    '__git' => 'git@github.com:getmim/site-profile-setting.git',
    '__license' => 'MIT',
    '__author' => [
        'name' => 'Iqbal Fauzi',
        'email' => 'iqbalfawz@gmail.com',
        'website' => 'https://iqbalfn.com/'
    ],
    '__files' => [
        'modules/site-profile-setting' => ['install','update','remove'],
        'app/site-profile-setting' => ['install','remove'],
        'theme/site/profile/setting' => ['install','remove']
    ],
    '__dependencies' => [
        'required' => [
            [
                'profile' => NULL
            ],
            [
                'site' => NULL
            ],
            [
                'lib-form' => NULL
            ]
        ],
        'optional' => []
    ],
    'autoload' => [
        'classes' => [
            'SiteProfileSetting\\Controller' => [
                'type' => 'file',
                'base' => 'app/site-profile-setting/controller'
            ],
            'SiteProfileSetting\\Library' => [
                'type' => 'file',
                'base' => 'modules/site-profile-setting/library'
            ]
        ],
        'files' => []
    ],
    'routes' => [
        'site' => [
            'siteProfileSetting' => [
                'path' => [
                    'value' => '/pme/setting/(:type)',
                    'params' => [
                        'type' => 'slug'
                    ]
                ],
                'handler' => 'SiteProfileSetting\\Controller\\Setting::edit',
                'method' => 'GET|POST'
            ]
        ]
    ],
    'libForm' => [
        'forms' => [
            'site.profile.account' => [
                'name' => [
                    'label' => 'Username',
                    'type' => 'text',
                    'slugof' => 'fullname',
                    'rules' => [
                        'required' => TRUE,
                        'empty' => FALSE,
                        'unique' => [
                            'model' => 'Profile\\Model\\Profile',
                            'field' => 'name',
                            'self' => [
                                'service' => 'profile.id',
                                'field' => 'id'
                            ]
                        ]
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'type' => 'email',
                    'rules' => [
                        'required' => TRUE,
                        'email' => TRUE,
                        'unique' => [
                            'model' => 'Profile\\Model\\Profile',
                            'field' => 'email',
                            'self' => [
                                'service' => 'profile.id',
                                'field' => 'id'
                            ]
                        ]
                    ]
                ],
                'phone' => [
                    'label' => 'Phone',
                    'type' => 'tel',
                    'rules' => [
                        'required' => TRUE,
                        'unique' => [
                            'model' => 'Profile\\Model\\Profile',
                            'field' => 'phone',
                            'self' => [
                                'service' => 'profile.id',
                                'field' => 'id'
                            ]
                        ]
                    ]
                ]
            ],
            'site.profile.contact' => [
                'contact-email' => [
                    'label' => 'Public Email',
                    'type' => 'email',
                    'rules' => [
                        'email' => TRUE
                    ]
                ],
                'contact-phone' => [
                    'label' => 'Public Phone',
                    'type' => 'tel',
                    'rules' => []
                ],
                'contact-manager' => [
                    'label' => 'Manager Phone',
                    'type' => 'tel',
                    'rules' => []
                ],
                'addr_country' => [
                    'label' => 'Country',
                    'type' => 'text',
                    'rules' => []
                ],
                'addr_state' => [
                    'label' => 'State',
                    'type' => 'text',
                    'rules' => []
                ],
                'addr_city' => [
                    'label' => 'City',
                    'type' => 'text',
                    'rules' => []
                ],
                'addr_street' => [
                    'label' => 'Street',
                    'type' => 'textarea',
                    'rules' => []
                ]
            ],
            'site.profile.education' => [
                'educations' => [
                    'label' => 'Educations',
                    'type' => 'textarea',
                    'rules' => [
                        'json' => TRUE
                    ]
                ]
            ],
            'site.profile.password' => [
                'password' => [
                    'label' => 'Password',
                    'type' => 'password',
                    'meter' => TRUE,
                    'rules' => [
                        'length' => [
                            'min' => 6
                        ]
                    ]
                ],
                'retype-password' => [
                    'label' => 'Retype Password',
                    'type' => 'password',
                    'meter' => TRUE,
                    'rules' => [
                        'length' => [
                            'min' => 6
                        ]
                    ]
                ]
            ],
            'site.profile.profession' => [
                'profession' => [
                    'label' => 'Professions',
                    'type' => 'textarea',
                    'rules' => [
                        'json' => TRUE
                    ]
                ]
            ],
            'site.profile.general' => [
                'fullname' => [
                    'label' => 'Fullname',
                    'type' => 'text',
                    'rules' => [
                        'required' => TRUE
                    ]
                ],
                'avatar' => [
                    'label' => 'Avatar',
                    'type' => 'image',
                    'form' => 'std-image',
                    'rules' => [
                        'required' => TRUE,
                        'upload' => TRUE
                    ]
                ],
                'bdate' => [
                    'label' => 'Birth Date',
                    'type' => 'date',
                    'rules' => [
                        'required' => TRUE,
                        'empty' => FALSE,
                        'date' => [
                            'format' => 'Y-m-d'
                        ]
                    ]
                ],
                'bplace' => [
                    'label' => 'Birth Place',
                    'type' => 'text',
                    'rules' => []
                ],
                'gender' => [
                    'label' => 'Gender',
                    'type' => 'select',
                    'rules' => [
                        'required' => TRUE,
                        'enum' => 'profile.gender'
                    ]
                ],
                'height' => [
                    'label' => 'Height ( cm )',
                    'type' => 'number',
                    'rules' => [
                        'numeric' => TRUE
                    ],
                    'filters' => [
                        'integer' => TRUE
                    ]
                ],
                'weight' => [
                    'label' => 'Weight ( kg )',
                    'type' => 'number',
                    'rules' => [
                        'numeric' => TRUE
                    ],
                    'filters' => [
                        'integer' => TRUE
                    ]
                ],
                'skin' => [
                    'label' => 'Skin',
                    'type' => 'text',
                    'rules' => []
                ],
                'biography' => [
                    'label' => 'Biography',
                    'type' => 'summernote',
                    'rules' => []
                ]
            ],
            'site.profile.social' => [
                'socials' => [
                    'label' => 'Socials',
                    'type' => 'textarea',
                    'rules' => [
                        'json' => TRUE
                    ]
                ]
            ]
        ]
    ]
];