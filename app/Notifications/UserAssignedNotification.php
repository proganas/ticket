<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;
use App\Models\Ticket;

class UserAssignedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $ticket;

    public function __construct(Ticket $ticket)
    {
        $this->ticket = $ticket;
    }

    // channels: database + mail + broadcast (adjust as needed)
    public function via($notifiable)
    {
//        return ['database', 'mail', 'broadcast'];
        return ['database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject("New ticket assigned: #{$this->ticket->id}")
            ->greeting("Hello {$notifiable->name},")
            ->line("A new ticket was assigned to you.")
            ->line("Subject: {$this->ticket->title}")
            ->action('View Ticket', route('tickets.show', $this->ticket->id)) // return error
            ->line('Thanks.');
    }

    public function toDatabase($notifiable)
    {
        return [
            'ticket_id' => $this->ticket->id,
            'title' => 'New ticket assigned',
            'message' => \Str::limit($this->ticket->description, 120),
            'from_user_id' => $this->ticket->user_id,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage($this->toDatabase($notifiable));
    }

    // optional: type name for JS listeners
    public function broadcastType()
    {
        return 'user.assigned';
    }
}
