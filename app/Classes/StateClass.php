<?php
/**
 * Created by PhpStorm.
 * User: kuehn_000
 * Date: 01.02.2019
 * Time: 16:55
 */

namespace App\Classes;


class StateClass
{

    public function projects($id) {

        switch ($id) {
            case 0:
                $state['color'] = "text-success";
                $state['state'] = "active";
                break;
            case 1:
                $state['color'] = "text-warning";
                $state['state'] = "paused";
                break;
            case 2:
                $state['color'] = "text-secondary";
                $state['state'] = "canceled";
                break;
            case 3:
                $state['color'] = "#19A3B8";
                $state['state'] = "finished";
                break;
            default:
                $state['color'] = "text-secondary";
                $state['state'] = "open";
        }

        return $state;

    }

    public function plans($id){

        switch ($id) {
            case 0:
                $state['color'] = "text-secondary";
                $state['state'] = "Saved";
                break;
            case 1:
                $state['color'] = "text-warning";
                $state['state'] = "Sent";
                break;
            case 2:
                $state['color'] = "text-success";
                $state['state'] = "Funded";
                break;
            default:
                $state['color'] = "text-secondary";
                $state['state'] = "saved";
        }

        return $state;

    }


    public function milestones($id){

        switch ($id) {
            case 0:
                $state['color'] = "grey";
                $state['state'] = "open";
                $state['info'] = "This milestone has not been funded yet";
                break;
            case 1:
                $state['color'] = "#d39c06";
                $state['state'] = "sent";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 2:
                $state['color'] = "#19A3B8";
                $state['state'] = "funded";
                $state['info'] = 'Your client will receive a message notifying them this work has been completed.';
                break;
            case 3:
                $state['color'] = "blue";
                $state['state'] = "payout created";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 4:
                $state['color'] = "#19A3B8";
                $state['state'] = "payout succeeded";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 5:
                $state['color'] = "#d39c06";
                $state['state'] = "pending";
                $state['info'] = "Status will update when money arrives.";
                break;
            case 6:
                $state['color'] = "#d39c06";
                $state['state'] = "pending";
                $state['info'] = "Please see your E-mails: Transfer the amount into escrow and mark transaction as complete.";
                break;
            case 7:
                $state['color'] = "#19A3B8";
                $state['state'] = "work completed";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 8:
                $state['color'] = "#19A3B8";
                $state['state'] = "money released";
                $state['info'] = "The money can be paid out as soon as you have provided your bank details.";
                break;
            case 9:
                $state['color'] = "#19A3B8";
                $state['state'] = "released (pending)";
                $state['info'] = "This money will be paid out as soon as you verify your account.";
                break;
            case 10:
                $state['color'] = "#19A3B8";
                $state['state'] = "money released";
                $state['info'] = "The money can be paid out as soon as you have completed the verification and provided your bank details.";
                break;
            case 11:
                $state['color'] = "#19A3B8";
                $state['state'] = "work completed";
                $state['info'] = "It is waited for the customer to confirm this.";
                break;
            default:
                $state['color'] = "text-secondary";
                $state['state'] = "open";
                $state['info'] = "";
        }

        return $state;

    }


    public function milestonesClient($id){

        switch ($id) {
            case 0:
                $state['color'] = "grey";
                $state['state'] = "open";
                $state['info'] = "Please pay by milestone due date.";
                break;
            case 1:
                $state['color'] = "#d39c06";
                $state['state'] = "sent";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 2:
                $state['color'] = "#055366";
                $state['state'] = "funded";
                $state['info'] = 'Once work is complete, click "release" to pay your freelancer.';
                break;
            case 3:
                $state['color'] = "blue";
                $state['state'] = "payout created";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 4:
                $state['color'] = "#19A3B8";
                $state['state'] = "payout succeeded";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 5:
                $state['color'] = "#d39c06";
                $state['state'] = "pending";
                $state['info'] = "Status will update when money arrives.";
                break;
            case 6:
                $state['color'] = "#d39c06";
                $state['state'] = "pending";
                $state['info'] = "Please see your E-mails: Transfer the amount into escrow and mark transaction as complete.";
                break;
            case 7:
                $state['color'] = "#19A3B8";
                $state['state'] = "work completed";
                $state['info'] = "Waiting for the freelancer to finish the work.";
                break;
            case 8:
                $state['color'] = "#19A3B8";
                $state['state'] = "paid";
                $state['info'] = null;
                break;
            case 9:
                $state['color'] = "#19A3B8";
                $state['state'] = "paid";
                $state['info'] = null;
                break;
            case 10:
                $state['color'] = "#19A3B8";
                $state['state'] = "paid";
                $state['info'] = null;
                break;
            case 11:
                $state['color'] = "#19A3B8";
                $state['state'] = "work completed";
                $state['info'] = "Please release the money.";
                break;
            default:
                $state['color'] = "text-secondary";
                $state['state'] = "open";
                $state['info'] = "";
        }

        return $state;

    }

}