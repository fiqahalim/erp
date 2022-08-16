<?php

return [
    [
        "selected"      => true,
        "card_id"       => "customers",
        "sort"          => 7,
        "card_type"     => "line_chart",
        "view_url"      => "admin.contacts.persons.index",
        "label"         => 'admin::app.dashboard.customers',
    ], [
        "selected"      => true,
        "card_id"       => "products",
        "sort"          => 9,
        "card_type"     => "line_chart",
        "view_url"      => "admin.products.index",
        "label"         => 'admin::app.dashboard.products',
    ], [
        "sort"          => 10,
        "selected"      => true,
        "card_id"       => "quotes",
        "card_type"     => "line_chart",
        "label"         => 'admin::app.dashboard.quotes',
    ], [
        "sort"          => 11,
        "card_type"     => "custom_card",
        "card_border"   => "dashed",
        "selected"      => false,
    ]
];
