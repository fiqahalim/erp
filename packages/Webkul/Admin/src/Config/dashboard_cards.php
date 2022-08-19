<?php

return [
    [
        "sort"          => 1,
        "selected"      => true,
        "card_id"       => "customers",
        "card_type"     => "line_chart",
        "view_url"      => "admin.contacts.persons.index",
        "label"         => 'admin::app.dashboard.customers',
    ], [
        "sort"          => 2,
        "selected"      => true,
        "card_id"       => "products",
        "card_type"     => "line_chart",
        "view_url"      => "admin.products.index",
        "label"         => 'admin::app.dashboard.products',
    ], [
        "sort"          => 3,
        "selected"      => true,
        "card_id"       => "quotes",
        "card_type"     => "line_chart",
        "label"         => 'admin::app.dashboard.quotes',
    ], [
        "sort"          => 4,
        "selected"      => true,
        "card_id"       => "materials",
        "card_type"     => "pie_chart",
        "view_url"      => "admin.materials.index",
        "label"         => 'admin::app.dashboard.graph_material_req',
    ], [
        "sort"          => 5,
        "selected"      => true,
        "card_id"       => "stocks",
        "card_type"     => "line_chart",
        "view_url"      => "admin.stocks.index",
        "label"         => 'admin::app.dashboard.stock_count',
    ]
];
