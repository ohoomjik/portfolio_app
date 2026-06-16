<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    protected $fillable = ['portfolio_id', 'title', 'description'];
    public function portfolio() {
        return $this->belongsTo(Portfolio::class);
    }
}
