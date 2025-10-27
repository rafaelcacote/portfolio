<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'subject',
        'message',
        'project_type',
        'budget_range',
        'timeline',
        'status',
        'read_at',
        'admin_notes',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime'
    ];

    // Scopes
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    public function scopeNew($query)
    {
        return $query->where('created_at', '>=', now()->subDays(7));
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessors
    protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at >= now()->subDays(7)
        );
    }

    protected function isRead(): Attribute
    {
        return Attribute::make(
            get: fn () => !is_null($this->read_at)
        );
    }

    protected function formattedCreatedAt(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at->format('d/m/Y H:i')
        );
    }

    // Methods
    public function markAsRead()
    {
        $this->update([
            'read_at' => now(),
            'status' => 'read'
        ]);
    }

    public function markAsReplied()
    {
        $this->update(['status' => 'replied']);
    }

    public function archive()
    {
        $this->update(['status' => 'archived']);
    }

    // Static methods
    public static function getProjectTypes()
    {
        return [
            'website' => 'Website/Landing Page',
            'app' => 'Aplicativo Mobile',
            'ecommerce' => 'E-commerce',
            'system' => 'Sistema Web',
            'other' => 'Outro'
        ];
    }

    public static function getBudgetRanges()
    {
        return [
            'under_1k' => 'Até R$ 1.000',
            '1k_5k' => 'R$ 1.000 - R$ 5.000',
            '5k_10k' => 'R$ 5.000 - R$ 10.000',
            '10k_25k' => 'R$ 10.000 - R$ 25.000',
            'over_25k' => 'Acima de R$ 25.000'
        ];
    }
}

