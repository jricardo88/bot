<?php

$API_KEY = 'BOT_TOKEN';
define('API_KEY', $API_KEY);

function Request($method, $data=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

/*======================================================

                Methods..: parse()
                Enviar objetos al chat

=======================================================*/
function parse($obj){
    $parse = json_encode($obj, JSON_PRETTY_PRINT);
    return $parse;
}

/*======================================================

                Methods..: _getMe()
                Información del bot

=======================================================*/
function _getMe(){
    return Request('getMe');
}

/*======================================================

                Methods..: _getChatAdministrators()
                Listra de administardores

=======================================================*/
function _getChatAdministrators($chatId){
    $data = ['chat_id' => $chatId];
    return Request('getChatAdministrators', $data);
}

/*======================================================

                Methods..: _sendMessage()

=======================================================*/
function _sendMessage($chatId, $text, $keyboard = null){
    if(isset($keyboard)) {
        $keyboard = json_encode($keyboard);
    }

    $data = [
        'chat_id'       => $chatId,
        'parse_mode'    => 'HTML',
        'text'          => $text,
        'reply_markup'  => $keyboard,
    ];
 
    return Request('sendMessage', $data);
}

/*======================================================

                Methods..: _sendMessageReply()

=======================================================*/
function _sendMessageReply($chatId, $messageId, $text){

    $data = [
        'chat_id' => $chatId,
        'reply_to_message_id'=>$messageId,
        'parse_mode'=>'HTML',
        'disable_web_page_preview'=>true, 
        'text' => $text
    ];
 
    return Request('sendMessage', $data);
}



/*======================================================

                Methods..: _deleteMessage()

=======================================================*/
function _deleteMessage($chatId, $messageId){
    $data = [
        'chat_id' => $chatId,
        'message_id' => $messageId
    ];
 
    return Request('deleteMessage', $data);
}

/*======================================================

                Methods..: _restrictOn()

=======================================================*/
function _restrictOn($chatId, $userId){
    $data = [
    'chat_id' => $chatId,
    'user_id' => $userId,
    'can_send_messages' => false,
    'can_send_media_messages' => false,
    'can_send_polls' => false,
    'can_send_other_messages' => false,
    'can_add_web_page_previews' => false,
    'can_change_info' => false,
    'can_invite_users' => false,
    'can_pin_messages' => false,
  ];
 
    return Request('restrictChatMember', $data);
}

/*======================================================

                Methods..: _restrictOff()

=======================================================*/
function _restrictOff($chatId, $userId){
    $data = [
    'chat_id' => $chatId,
    'user_id' => $userId,
    'can_send_messages' => true,
    'can_send_media_messages' => true,
    'can_send_polls' => true,
    'can_send_other_messages' => true,
    'can_add_web_page_previews' => true,
    'can_change_info' => true,
    'can_invite_users' => true,
    'can_pin_messages' => true,
  ];
 
    return Request('restrictChatMember', $data);
}

/*======================================================

                Methods..: _getMember()

=======================================================*/
function _getMember($chatId, $userId){
    $data = [
        'chat_id' => $chatId,
        'user_id' => $userId
    ];
 
    return Request('getChatMember', $data);
}

/*======================================================

                Methods..: _ban()

=======================================================*/
function _ban($chatId, $userId){
    $data = [
        'chat_id' => $chatId,
        'user_id' => $userId
    ];
 
    return Request('kickChatMember', $data);
}

/*======================================================

                Methods..: _unban()

=======================================================*/
function _unban($chatId, $userId){
    $data = [
        'chat_id' => $chatId,
        'user_id' => $userId
    ];
 
    return Request('unbanChatMember', $data);
}

/*======================================================

                Methods..: _answerCallbackQuery()

=======================================================*/
function _answerCallbackQuery($callback_query_id, $text, $show_alert = false) {
    $data = [
        'callback_query_id' => $callback_query_id,
        'text'              => $text,
        'show_alert'        => $show_alert
    ];

    return Request('answerCallbackQuery', $data);
}

/*======================================================

                Methods..: _editMessageText()

=======================================================*/

function _editMessageText($chatId, $mesage_id, $text, $keyboard = null){
    // Si hay botonera parseamos la misma
    if(isset($keyboard)) {
        $keyboard = json_encode($keyboard);
    }

    $data = [
        'chat_id'                  => $chatId,
        'message_id'                => $mesage_id,
        'text'                     => $text,
        'parse_mode'               => 'HTML',
        'reply_markup'             => $keyboard,
    ];
 
    return Request('editMessageText', $data);
}

/*======================================================

                Methods..: _sendPhoto()

=======================================================*/

function _sendPhoto($chatId, $photo, $caption = null){
    
    $data = [
        'chat_id'   => $chatId,
        'photo'     => $photo,
        'caption'   => $caption
    ];

    return Request('sendPhoto', $data);
}

/*======================================================

                Methods..: _sendDocument()

=======================================================*/

function _sendDocument($chatId, $document, $caption = null){
    
    $data = [
        'chat_id'   => $chatId,
        'document'     => $document,
        'caption'   => $caption
    ];

    return Request('sendDocument', $data);
}

function _leave($chatId)
{
    $data = [
        'chat_id' => $chatId
    ];
    return Request('leaveChat', $data);
}

/*======================================================

                Methods..: _answerInlineQuery()

=======================================================*/

function _answerInlineQuery($inlineQueryId,$result = [])
{
    $data = [
        'inline_query_id' => $inlineQueryId,
        'results' => json_encode(
            $result
        ),
        'cache_time' => 0,
    ];

    return Request('answerInlineQuery', $data);
}
