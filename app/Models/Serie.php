<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];
    //protected $primaryKey = 'series_id';

    public function temporadas(){
        return $this->hasMany(Season::class,'series_id');
    }

    public static function booted(){
        self::addGlobalScope('ordered',function(Builder $queryBuilder){
            $queryBuilder->orderBy('nome','asc');

            });
        }

    }

