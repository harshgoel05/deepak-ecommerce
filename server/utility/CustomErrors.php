<?php
namespace Utility;

require_once(__DIR__.'/../config/other-configs.php');

abstract class CustomErrors 
{
    const TYPE_ERROR = 'TypeError';
    const VALUE_ERROR = 'ValueError';
    const AUTH_ERROR = 'AuthenticationError';
    const UNAUTHORIZED_ACCESS_ERROR = 'UnauthorizedAccessError';
}