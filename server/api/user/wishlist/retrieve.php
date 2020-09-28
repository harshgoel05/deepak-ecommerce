<?php

use function Utility\HttpUtil\sendSuccessResponse;

require_once(__DIR__ . '/../../../config/other-configs.php');
require_once(__ROOT__ . '/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureUserLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

$wagonModel = getSingleton('\\Models\\',__DIR__);

$userId = \Utility\SessionUtil\getUserSessionIdentifier();

$wagonItems = $wagonModel->getItems($userId);

sendSuccessResponse($wagonItems);

