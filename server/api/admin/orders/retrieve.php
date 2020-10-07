<?php

use Utility\Fallacy;

use function Utility\HeadersUtil\addCommonHeaders;

require_once(__DIR__.'/../../../config/other-configs.php');
require_once(__ROOT__.'/utility/utilities.php');

\Utility\HeadersUtil\addCommonHeaders();
\Utility\SessionUtil\ensureAdminLoggedIn();
\Utility\SessionUtil\ensureRequestMethod('GET');

$ordersModel = \Models\Orders::getInstance();

$temp_res = $ordersModel->getFilteredOrders($_GET);

if($temp_res instanceof Fallacy)
{
    \Utility\HttpErrorHandlers\badRequestErrorHandler($temp_res);
}
else {
    \Utility\HttpUtil\sendSuccessResponse($temp_res);
}