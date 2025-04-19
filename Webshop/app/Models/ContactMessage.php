<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'subject',
        'topic',
        'message',
        'ip_address',
        'user_agent',
        'status',
        'admin_notes',
        'reply_sent',
        'replied_by',
        'replied_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'replied_at' => 'datetime',
        'reply_sent' => 'boolean',
    ];

    /**
     * A kapcsolatfelvételi témák
     *
     * @return array
     */
    public static function getTopics()
    {
        return [
            'general' => 'Általános kérdés',
            'order' => 'Rendeléssel kapcsolatos',
            'product' => 'Termékkel kapcsolatos',
            'warranty' => 'Garancia, szerviz',
            'other' => 'Egyéb'
        ];
    }

    /**
     * Téma megjelenítendő neve
     *
     * @return string
     */
    public function getTopicNameAttribute()
    {
        $topics = self::getTopics();
        return $topics[$this->topic] ?? $this->topic;
    }

    /**
     * Státusz megjelenítendő neve
     *
     * @return string
     */
    public function getStatusNameAttribute()
    {
        $statuses = [
            'new' => 'Új',
            'in_progress' => 'Folyamatban',
            'replied' => 'Megválaszolva',
            'closed' => 'Lezárva',
            'spam' => 'Spam'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    /**
     * A felhasználó (admin) aki megválaszolta az üzenetet
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function repliedByUser()
    {
        return $this->belongsTo(User::class, 'replied_by');
    }
}