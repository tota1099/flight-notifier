<?php

namespace App\modules\Requests;

require_once dirname(__DIR__) . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\modules\Requests\CurlRequest;
use App\modules\Requests\Exceptions\RequestException;
use Exception;

class RequestsTest extends TestCase {

    private $request;
    function setUp()
    {
        $this->request = new CurlRequest();
    }

    public function testInvalidUrl() {
        $this->expectException(RequestException::class);
        $this->expectExceptionMessage('Url invalid!');
        $this->request->get();
    }
}