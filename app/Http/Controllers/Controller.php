<?php

namespace App\Http\Controllers;

use App\Models\Curriculum;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $defaultCurriculum ;
    public function __construct() {
        //membuat global variable, curriculum yang default/sedang berjalan
        $this->defaultCurriculum = Curriculum::where("is_default", "1")->first();
    }
}

