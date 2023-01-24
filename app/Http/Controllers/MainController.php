<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function index()
    {
        //
        $page = 'index';
        $title = 'Polling Units';
        $icon = 'fi fi-rs-cube';
        $data = DB::table('polling_unit')->where('polling_unit_id', '>', 0)->orderBy('uniqueid')->get();

        return view($page)->with('data', (object)
            compact(
                'title',
                'icon',
                'data',
            )
        );
    }

    public function create()
    {
        $page = 'create';
        $title = 'Add PU Result';
        $icon = 'fi fi-rs-interactive';
        $lists = (object) [
            'state' => DB::table('states')->orderBy('state_name')->get(),
            'lga' => DB::table('lga')->select('lga_id', 'lga_name')->orderBy('lga_name')->get(),
            'ward' => DB::table('ward')->select('uniqueid', 'ward_name', 'ward_id')->orderBy('ward_name')->get(),
            'polling_unit' => DB::table('polling_unit')->select('uniqueid', 'polling_unit_name', 'polling_unit_number')->where('polling_unit_id', '>', 0)->orderBy('polling_unit_name')->get(),
            'party' => DB::table('party')->orderBy('partyname')->get(),
        ];
        $alert = [];

        return view($page)->with('data', (object)
            compact(
                'title',
                'icon',
                'lists',
                'alert',
            )
        );
    }

    public function store(Request $request)
    {
        // dd($request);
        session()->flash('alert', true);

        return redirect()->back()->withInput()->withErrors([
            'alert_type' => 'success',
            'alert_text' => 'Polling Unit result saved successfully',
        ]);
    }

    public function show(int $id)
    {
        $page = 'show';
        $title = 'Polling Unit Results';
        $icon = 'fi fi-rs-cube';
        $data = DB::table('announced_pu_results')->where('polling_unit_uniqueid', $id)->orderBy('party_score', 'desc')->get();
        $meta = DB::table('polling_unit')->where('uniqueid', 8)->first();

        return view($page)->with('data', (object)
            compact(
                'title',
                'icon',
                'data',
                'meta',
            )
        );
    }

    public function search(Request $request)
    {
        $validated = $request->validate([
            'lga_id' => 'required|numeric',
        ]);

        $lga_id = $validated['lga_id'];

        if ($lga_id > 0) {
            $row = $data = DB::table('lga')->select('lga_name')->where('lga_id', $lga_id)->first();
            $lga_name_f = " ({$row->lga_name})";
        } else {
            $lga_name_f = '';
        }

        $page = 'search';
        $title = "Local Government Results{$lga_name_f}";
        $icon = 'fi fi-rs-bank';
        $data = DB::table('announced_lga_results')->where('lga_name', $lga_id)->orderBy('party_abbreviation')->get();
        $list = DB::table('lga')->select('lga_id', 'lga_name')->orderBy('lga_name')->get();

        return view($page)->with('data', (object)
            compact(
                'title',
                'icon',
                'data',
                'list',
            )
        );
    }
}
