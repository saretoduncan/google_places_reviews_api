<?php

declare(strict_types=1);

use App\Controllers\GoogleApiController;



$app->get("/", [GoogleApiController::class, 'getReviews']);
