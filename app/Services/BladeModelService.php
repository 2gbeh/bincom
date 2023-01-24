<?php

namespace App\Services;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class BladeModelService
{
    private function getItems($row)
    {
        return isset($row[0]) ? $row[0] : null;
    }

    public function getParty(string $party_abbreviation, string $col = null)
    {
        $row = DB::table('party')->where('partyid', $party_abbreviation)->get();
        return is_null($col) ? $this->getItems($row) : $row[0]->$col;
    }

    public function getState(int $state_id, string $col = null)
    {
        $row = DB::table('states')->where('state_id', $state_id)->get();
        return is_null($col) ? $this->getItems($row) : $row[0]->$col;
    }

    public function getLga(int $lga_id, string $col = null)
    {
        $row = DB::table('lga')->where('lga_id', $lga_id)->get();
        return is_null($col) ? $this->getItems($row) : $row[0]->$col;
    }

    public function getWard(int $unique_id, string $col = null)
    {
        $row = DB::table('ward')->where('uniqueid', $unique_id)->get();
        return is_null($col) ? $this->getItems($row) : $row[0]->$col;
    }

    public function getUnit(int $unique_id, string $col = null)
    {
        $row = DB::table('polling_unit')->where('uniqueid', $unique_id)->get();
        return is_null($col) ? $this->getItems($row) : $row[0]->$col;
    }

    public function stackTraceLga(int $lga_id)
    {
        $query = "SELECT
            party_abbreviation,
            sum(party_score) AS sum_party_score
            FROM
            announced_pu_results
            WHERE polling_unit_uniqueid IN
            (SELECT uniqueid FROM polling_unit WHERE lga_id = {$lga_id})
            GROUP BY
            party_abbreviation";

        try {
            $arr = [];
            $res = DB::select($query);

            foreach ($res as $row) {
                $arr[$row->party_abbreviation] = $row->sum_party_score;
            }

            // dd($res, $arr);
            return $arr;
        } catch (QueryException $err) {
            if (isset($err->errorInfo[2])) {
                return $err->errorInfo[2];
            } else {
                $arr = explode('Stack trace:', (string) $err);
                return array_shift($arr);
            }
        }
    }

}
