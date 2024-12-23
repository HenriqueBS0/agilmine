<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Tests\Support\AssercoesAlerta;
use Tests\Support\AssercoesModal;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use AssercoesAlerta;
    use AssercoesModal;
}
