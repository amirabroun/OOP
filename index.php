<?php

require "./vendor/autoload.php";

use Helper\Helper;

use DataBase\DataBase;

var_dump((new DataBase)->cn);

die;
include "Helper/functions.php";


include "Views/partials/header.php";

include "Views/partials/aside.php";

include "Views/contents/index_content.php";

include "Views/partials/footer.php";
