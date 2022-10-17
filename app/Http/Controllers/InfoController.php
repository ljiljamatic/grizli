<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InfoController extends Controller
{
    public function index()
    {
        return Http::withoutVerifying()->get("https://sys.blockchain-servers.world/v1/chain/get_currency_balance");
    }
}
