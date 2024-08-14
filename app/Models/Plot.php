<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plot extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_id',
        'project_id',
        'block_name',
        'khasra_no',
        'phone_no',
        'mauza_no',
        'address',
        'documents',
        'amount',
        'total_plots',
        'notes',
        'plot_list',
    ];

    protected $casts = [
        'documents'=>'json',
        'plot_list'=>'json'
    ];

    public function owner($id){
        return PlotOwner::findOrFail($id);
    }

    public function project($id){
        return Project::findOrFail($id);
    }
}
