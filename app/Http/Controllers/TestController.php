<?php

namespace App\Http\Controllers;

use App\Models\TestModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    public function calendar() {
        return Inertia::render('Calendar');
    }

    public function read() {
        TestModel::query()->get()->transform(function($item) {
            return [
                $item->name,
                $item->secondName,
                $item->name,
                $item->second_name
            ];
        })->dump();
    }

    public function write() {
        $testModel = new TestModel();
        $testModel->name = "example";
        $testModel->slug = "example-item";
        $testModel->secondName = "example_second_name";

        return $testModel->save()
            ? "OK"
            : "NO";
    }
}
