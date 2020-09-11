<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proposal extends Model
{
    use SoftDeletes;

    // isikan sesuai di column tabel
    protected $fillable = [
    'code','users_id', 'categories_id', 'name', 'brand', 'qty', 'max_requirement', 'satuan', 'price', 'total_price', 'benefit', 'description', 'proposal_status', 'note', 'link', 'slug'
    ];

    protected $hidden = [
        
    ];

    // merelasikan proposal dengan gallery
    public function galleries()
    {
        // ->withTrashed()
        return $this->hasMany(ProposalGallery::class, 'proposals_id', 'id');
    }

    // merelasikan proposal dengan user
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    // merelasikan proposal dengan category
    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }
}
