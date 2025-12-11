<?php

namespace App\Models\DocumentType;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Profile\Profile;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = ['id','state'];

    public function profile()
    {
        return $this->hasMany(Profile::class, 'document_type_id');
    }
}
