<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 26.06.2018
 * Time: 14:08
 */

namespace App\Http\Controllers\Backend\Provider;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\DatabaseModels\Clients;
use App\DatabaseModels\Provider;
use App\DatabaseModels\ContractsProposal;
use App\Http\Controllers\Controller;
use Auth, Form, Session, Redirect;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Array_;

class ContractsController extends Controller
{

    public function getTypes() {


        return view('backend.documents.types', compact('test'));

    }

    public function createProposal() {

        Session::set('session_create_doc', Str::random(64));
        return view('backend.documents.proposal.create-proposal', compact('test'));

    }

    public function createProposalBlank() {

        $blade["user"] = Auth::user();
        $session = Session::get('session_create_doc');
        $contract_data = ContractsProposal::where("session", "=", $session)
                ->first();

        if(empty($contract_data)){

            $contract_data = array(
                "date" => "",
                "clients_fk" => "",
                "expires"   => "",
            );
        }

        $clients = Clients::where("service_provider_fk", "=", $blade["user"]->service_provider_fk)
            ->get();

        $provider = Provider::where("id", "=", $blade["user"]->service_provider_fk)
            ->first();

        return view('backend.documents.proposal.contractors-proposal', compact('clients', 'provider', 'contract_data'));

    }


    public function saveProposalBlank() {

        $blade["user"] = Auth::user();
        $proposal_get = json_decode($_GET["proposal"]);


        $proposal = new ContractsProposal();
        $proposal->service_provider_fk = $blade["user"]->service_provider_fk;
        //$proposal->clients_fk = $proposal_get->client;
        $date = date('Y-m-d', strtotime($proposal_get->dateproposal));
        $proposal->date = $date;

        $proposal->session = Session::get('session_create_doc');
        $proposal->expires = date('Y-m-d', strtotime($proposal_get->expiresdate));
        $proposal->save();

        return view('backend.documents.proposal.payment', compact('proposal'));

    }

    public function loadProposalTemplate() {

        $test="";
        return Redirect::to(env("/en/provider/load-proposal-blank-template/"));

    }




}