<?php

return [
    'meta'      => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Hoá chất HBC", // set false to total remove
            'description'  => 'Cung cấp , phân phối các loại hoá chất và thiết bị hoá chất chính hãng, quốc tế', // set false to total remove
            'separator'    => ' - ',
            'keywords'     => [],
            'canonical'    => false, // Set null for using Url::current(), set false to total remove
        ],

        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => 'nhienphan',
            'bing'      => 'nhienphan',
            'alexa'     => 'nhienphan',
            'pinterest' => 'nhienphan',
            'yandex'    => 'nhienphan',
        ],
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => 'Hoá chất HBC', // set false to total remove
            'description' => 'Cung cấp , phân phối các loại hoá chất và thiết bị hoá chất chính hãng, quốc tế', // set false to total remove
            'url'         => false, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => false,
            'images'      => [],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
          //'card'        => 'summary',
          //'site'        => '@LuizVinicius73',
        ],
    ],
];
