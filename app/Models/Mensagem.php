<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TelegramBot\Api\BotApi;

class Mensagem extends Model
{

    //Token de acesso ao bot
    const TELEGRAM_BOT_TOKEN = '5083031614:AAESmU-lqPn3udEiN63N-GQ2xyjBnsy0qqw';
    
    //ID da conversa com o bot
    const TELEGRAM_CHAT_ID = -687491354;

     //Método responsável por enviar a mensagem
    public static function sendMessage($message) {
    
        //Instância do bot com o token gerado
        $obBotApi = new Botapi(self::TELEGRAM_BOT_TOKEN);
    
        //Envia a mensagem para o Telegram
        return $obBotApi->sendMessage(self::TELEGRAM_CHAT_ID, $message, 'HTML');
    
    }
    
}
