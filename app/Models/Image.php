<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Image extends Model {
    protected $fillable = ['portfolio_id', 'image_url'];
    public function portfolio() {
        return $this->belongsTo(Portfolio::class);
    }
}
