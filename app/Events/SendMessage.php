<?php
namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Carbon\Carbon;
class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $message;
    public $sender_id;
    public $sendername;
    public $senderimage;
    public $receiver_id;
    public $receivername;
    public $receiverimage;
    public $msgdate;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message,$sender_id,$sendername,$senderimage,$receiver_id,$receivername,$receiverimage,$msgdate)
    {
        $this->message        = $message;
        $this->sender_id      = $sender_id;
        $this->$sendername    = $sendername;
        $this->$senderimage   = $senderimage;
        $this->$receiver_id   = $receiver_id;
        $this->$receivername  = $receivername;
        $this->$receiverimage = $receiverimage;
        $this->$msgdate       = Carbon::createFromTimeStamp(strtotime($msgdate))->diffForHumans();   
    }
    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }
    
}
