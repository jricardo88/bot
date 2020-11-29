<?php
// Updates Data
$update = json_decode(file_get_contents('php://input'));

$adminId = [''];


@$msg = $update->message;
@$text = $msg->text;
@$mid = $msg->message_id;

//Chat Data
@$cid = $msg->chat->id;
@$type = $msg->chat->type;
@$name = $msg->chat->first_name;
@$chatUsername = $msg->chat->username;

// User Data
@$frid = $msg->from->id;
@$frisbot = $msg->from->is_bot;
@$frname = $msg->from->first_name;
@$frlast = $msg->from->last_name;
@$fruser = $msg->from->username;

// Forward Data
@$fwd = $msg->forward_from->id;

// Reply Data
@$reply = $msg->reply_to_message->from->id;
@$replyfruser = $msg->reply_to_message->from->username;
@$replyfrname = $msg->reply_to_message->from->first_name;
@$replyfrlast = $msg->reply_to_message->from->last_name;
@$replytext = $update->message->reply_to_message->text;

@$replyfwd_id = $msg->reply_to_message->forward_frorm->id;

// Callback Data
@$cb = $update->callback_query;
@$cbid = $cb->id;
@$cbdata = $cb->data;
@$cbfrid = $cb->from->id;
@$cbfrname = $cb->from->first_name;
@$cbfrusername = $cb->from->username;

@$cbmes = $cb->message;
@$cbmesmid = $cbmes->message_id;
@$cbmestx = $cbmes->text;
@$cbmescid = $cbmes->chat->id;
@$cbchtype = $cbmes->chat->type;
#   $step = file_get_contents("step/$cid.step");

@$cbchat_ins = $cb->chat_instance;
@$cbin_mes_mid = $cb->inline_message_id;

// Inline Data
@$inquery = $update->inline_query;
@$inqid = $inquery->id;
@$inqfrid = $inquery->from->id;
@$inqdata = $inquery->query;

// Answer Callback Data - answerCallbackQUERY
@$aCb_cbQ = $update->answerCallbackQuery; //
@$aCb_cbQid = $aCb_cbQ->callback_query_id;
@$aCb_cbQtext = $aCb_cbQ->text;

// Edit Data  -  editMessageTex
@$EMT = $update->editMessageText;
@$edcid = $EMT->chat_id;
@$edmid = $EMT->message_id;
@$edtext = $EMT->text;

// Multimedia Data
@$file_document = $msg->document->file_id;
@$file_document_name = $msg->document->file_name;
@$file_document_size = $msg->document->file_size;
@$file_photo = $msg->photo[0]->file_id;

// Member Data
@$newMember = $msg->new_chat_member;
