<?php
    session_start();
    require_once "../models/Proposal.php";
    require_once "../models/ProposalResponse.php";
    require_once "../models/Binder.php";

    if (!(isset($_GET["action"]))) {
        header("Location: bindr-index.php");
    }

    if ($_GET["action"] == "approve") {
        if (ProposalResponse::get_response_by_user_and_id($_SESSION["id"], $_GET["proposal_id"])) {
            $already_voted = false;
            ProposalResponse::create_response($_GET["proposal_id"], $_SESSION["id"], true);
            
            $approvals = ProposalResponse::get_number_approve($_GET["proposal_id"]);
            $binder = Binder::get_binder_by_id($_GET["binder_id"]);
            if ($approvals >= floatval(sizeof($binder->get_binder_membership())*(2/3))) {
                $user_added = true;
                $final_decision = true;
                $binder->add_user($_GET["proposed_id"]);
                ProposalResponse::remove_responses_by_proposal_id($_GET["proposal_id"]);
                Proposal::delete_proposal_by_id($_GET["proposal_id"]);
            }
            else {
                $user_added = true;
                $final_decision = false;
            }
        }
        else {
            $user_added = false;
            $final_decision = false;
            $already_voted = true;
        }
    }
    else {
        if (ProposalResponse::get_response_by_user_and_id($_SESSION["id"], $_GET["proposal_id"])) {
            $already_voted = false;
            ProposalResponse::create_response($_GET["proposal_id"], $_SESSION["id"], false);

            $binder = Binder::get_binder_by_id($_GET["binder_id"]);
            $disapprovals = ProposalResponse::get_number_disapprove($_GET["proposal_id"]);
            if ($disapprovals >= floatval(sizeof($binder->get_binder_membership())*(2/3))) {
                $user_added= false;
                $final_decision = true;
                ProposalResponse::remove_responses_by_proposal_id($_GET["proposal_id"]);
                Proposal::delete_proposal_by_id($_GET["proposal_id"]);
            }
            else {
                $user_added = false;
                $final_decision = false;
            }
        }
        else {
            $user_added = false;
            $final_decision = false;
            $already_voted = true;
        }
    }

    header("Location: ../home.php?user_added=".$user_added."&already_voted=".$already_voted."&binder_id=".$_GET["binder_id"]."&final_decision=".$final_decision."");
?>