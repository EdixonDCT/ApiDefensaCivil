<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\Organization;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','names','last_names','birth_date','document_type_id','document_number','gender_id','organization_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
