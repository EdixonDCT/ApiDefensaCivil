<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User\User;
use App\Models\DocumentType\DocumentType;
use App\Models\Gender\Gender;
use App\Models\Organization\Organization;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = ['id','user_id','names','last_names','birth_date','document_type_id','document_number','gender_id','organization_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class,'document_type_id');
    }
    public function gender()
    {
        return $this->belongsTo(Gender::class,'gender_id');
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class,'organization_id');
    }
}
