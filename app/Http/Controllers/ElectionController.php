<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ElectionController extends Controller
{
    public function showPollingUnitResults()
    {
        $pollingUnitResults = DB::select('SELECT DISTINCT announced_pu_results.polling_unit_uniqueid, polling_unit.polling_unit_name, SUM(announced_pu_results.party_score) as sum_party_score FROM `announced_pu_results` INNER JOIN polling_unit on announced_pu_results.polling_unit_uniqueid = polling_unit.uniqueid GROUP BY announced_pu_results.polling_unit_uniqueid DESC');

        return view('polling_unit', [
            'pollingUnitResults' => $pollingUnitResults,
        ]);
    }

    public function showLgaResultsView()
    {
        $lga = DB::select('SELECT lga_id, lga_name FROM `lga`');

        return view('lga', [
            'lga' => $lga,
        ]);
    }

    public function showLgaResults($lga_id)
    {
        $lga_id = request('lga_id');

        $LgaResults = DB::select('SELECT DISTINCT announced_pu_results.polling_unit_uniqueid, polling_unit.lga_id, SUM(announced_pu_results.party_score) as sum_party_score FROM `announced_pu_results` INNER JOIN `polling_unit` ON announced_pu_results.polling_unit_uniqueid = polling_unit.uniqueid WHERE polling_unit.lga_id= ? GROUP BY polling_unit_uniqueid', [$lga_id]);

        return $LgaResults;
    }

    public function insertResultsView()
    {
        $party = DB::select('SELECT partyid FROM `party`');

        return view('party_result', [
            'party' => $party,
        ]);
    }

    public function insertResults(Request $request)
    {
        $party = $request->party;
        $party_score = $request->party_score;
        $entered_by = $request->entered_by;
        $date = now();
        $ip = '127.0.0.1';

        $check = DB::select('SELECT * FROM `announced_pu_results` WHERE polling_unit_uniqueid = ? AND party_abbreviation = ?', [999, $party]);

        if (count($check) > 0) {
            return response()->json([
                'message' => 'Error: result already exists for this party',
                'status' => 'fail'
            ], 200);
        } else {
            $store = DB::insert('insert into `announced_pu_results` (polling_unit_uniqueid, party_abbreviation, party_score, entered_by_user, date_entered, user_ip_address) values (?, ?, ?, ?, ?, ?)', [999, $party, $party_score, $entered_by, $date, $ip]);

            return response()->json([
                'message' => 'Successful insertion',
                'status' => 'success'
            ], 200);
        }
    }
}
