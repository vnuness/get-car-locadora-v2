<?php

return [
    "telas" => [
        "Menu Principal" => [
            "menu" => ['type' => 'title'],
            "itens" => [
                "Home" => [
                    "menu" => ['type' => 'link', "route" => "home", "icon-class" => "ti-home"],
                    "permissions" => [
                        'dashboard.view' => 'Visualizar página',
                    ]
                ],
                "Veiculos" => [
                    "menu" => ['type' => 'link', "route" => "veiculos.index", "icon-class" => "ti-car"],
                    "permissions" => [
                        'veiculos.view' => 'Visualizar página',
                    ]
                ],
                "Pedidos" => [
                    "menu" => ['type' => 'link', "route" => "pedidos.index", "icon-class" => "mdi mdi-truck-delivery"],
                    "permissions" => [
                        'pedidos.view' => 'Visualizar página',
                    ]
                ],
                "Credenciais" => [
                    "menu" => ['type' => 'sub-menu', "icon-class" => "fa fa-address-book-o"],
                    "itens" => [
                        "Perfis" => [
                            "menu" => ["type" => "link", "route" => "credentials.profiles.index"],
                            "permissions" => [
                                'credentials.profiles.list' => 'Listar',
                                'credentials.profiles.create' => 'Cadastrar',
                                'credentials.profiles.show' => 'Detalhes',
                                'credentials.profiles.edit' => 'Editar',
                                'credentials.profiles.delete' => 'Apagar'
                            ]
                        ],
                        "Usuários" => [
                            "menu" => ["type" => "link", "route" => "credentials.users.index"],
                            "permissions" => [
                                'credentials.users.list' => 'Listar',
                                'credentials.users.create' => 'Cadastrar',
                                'credentials.users.edit' => 'Editar',
                                'credentials.users.delete' => 'Apagar'
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    "system" => [

    ]
];
