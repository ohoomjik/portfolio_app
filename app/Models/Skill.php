<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model{
    protected $hidden = ['pivot'];
    protected $fillable = ['name'];
    public function portfolios() {
        return $this->belongsToMany(Portfolio::class);
    }
}
