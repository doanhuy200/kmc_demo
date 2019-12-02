<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $table = "entry";
    protected $fillable = [
        'kshow_id', 'kuser_id', 'name', 'type', 'media_type', 'data', 'thumbnail', 'views', 'votes',
        'comments', 'favorites', 'total_rank', 'rank', 'tags', 'anonymous', 'status', 'source', 'source_id',
        'source_link', 'license_type', 'credit', 'length_in_mses', 'created_at', 'updated_at', 'partner_id',
        'display_in_search', 'subp_id', 'custom_data', 'screen_name', 'site_url', 'permission', 'group_id',
        'plays', 'partner_data', 'int_id', 'indexed_custom_data_1', 'description', 'media_date', 'admin_tags',
        'moderation_count', 'modified_at', 'puser_id', 'access_control_id', 'conversion_profile_id', 'categories',
        'categories_ids', 'flavor_params_ids', 'start_date', 'end_date', 'available', 'last_played_at'
    ];
}
