<?php



    $lost_data = ["id" => "",
    "first" => "",
    "last" => "",
    "description" => "",
    "category" => "",
    "location_lost" => "",
    "date_lost" => "",
    "phone" => "",
    "additional_details" => ""
    ];

    
    
    $found_data = ["id" => "",
    "description" => "",
    "category" => "",
    "found_location" => "",
    "date_found" => "",
    "date_turned_in" => "",
    "current_location" => "",
    "additional_details" => ""
    ];

    $category = ["id" => "",
    "name" => ""
    ];

    $categories = ["Electronics - Cellphone/Laptop/Camera", 
    "Electronics - All others",
    "Personal - Wallet/Glasses/Keys/ID",
    "Clothing - Coat/Jacket/Hats/etc",
    "Bags - Bookbag/Bag/Purse",
    "Tickets/Cash/Credit Card/Debit Card",
    "Transportation - Bicycles/Skateboards/etc",
    "Books",
    "Jewelry",
    "Sports Equipment",
    "Medical",
    "Media - USB drives/Notebooks",
    "Miscellaneous"    
];

$users = ["id" => "id",
    "username" => "calvinn",
    "password" => "sesame",   
    "logged_in" => "False" 
];

    $tables = ["lost" => $lost_data, "found" => $found_data, 
    "category" => $category, "users" => $users];

?>