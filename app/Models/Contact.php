<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'whatsapp',
        'type',
        'needs',
        'budget',
        'message',
        'contact_consent',
        'privacy_consent',
        'email_sent',
    ];

    protected $casts = [
        'needs' => 'array',
        'contact_consent' => 'boolean',
        'privacy_consent' => 'boolean',
        'email_sent' => 'boolean',
    ];

    public const TYPES = [
        'entrepreneur' => 'Entrepreneur / Porteur de projet',
        'entreprise' => 'Entreprise / DRH',
        'professionnel' => 'Professionnel / Salarié',
        'etudiant' => 'Étudiant / Jeune diplômé',
        'autre' => 'Autre',
    ];

    public const NEEDS = [
        'formation' => 'Formation',
        'entrepreneuriat' => 'Accompagnement entrepreneurial',
        'rh' => 'Ressources humaines / recrutement',
        'structuration' => "Structuration / croissance d'entreprise",
        'audit' => 'Audit',
        'autre' => 'Autre',
    ];

    public const BUDGETS = [
        '<500k' => 'Moins de 500 000 FCFA',
        '500k-1m' => '500 000 - 1 000 000 FCFA',
        '1m-3m' => '1 - 3 millions FCFA',
        '3m-5m' => '3 - 5 millions FCFA',
        '>5m' => 'Plus de 5 millions FCFA',
        'discuter' => 'À discuter',
    ];

    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? (string) $this->type;
    }

    public function getBudgetLabelAttribute(): ?string
    {
        return $this->budget ? (self::BUDGETS[$this->budget] ?? $this->budget) : null;
    }

    public function getNeedsLabelsAttribute(): array
    {
        return collect($this->needs ?? [])->map(fn ($n) => self::NEEDS[$n] ?? $n)->all();
    }
}
