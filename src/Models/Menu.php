<?php
// +----------------------------------------------------------------------
// | Gayly [ GOOD GOOD STUDY DAY DAY UP ]
// +----------------------------------------------------------------------
// | Copyright (c) http://smhx.net All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: gayly <tthd@163.com>
// +----------------------------------------------------------------------

namespace Onini\Gayly\Models;

use Illuminate\{
	Database\Eloquent\Model,
	Database\Eloquent\Relations\BelongsToMany,
	Support\Facades\DB
};
use Onini\Gayly\Traits\ModelTree;

class Menu extends Model
{
	use ModelTree;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
		'parent_id', 'order', 'title', 'icon', 'uri'
	];

	/**
     * A Menu belongs to many roles.
     *
     * @return BelongsToMany
     */
    public function roles() : BelongsToMany
    {
        $pivotTable = config('gayly.database.role_menu_table');
        $relatedModel = config('gayly.database.roles_model');
        return $this->belongsToMany($relatedModel, $pivotTable, 'menu_id', 'role_id');
    }

    /**
     * @return array
     */
    public function allNodes() : array
    {
        $orderColumn = DB::getQueryGrammar()->wrap($this->orderColumn);
        $byOrder = $orderColumn.' = 0,'.$orderColumn;
        return static::with('roles')->orderByRaw($byOrder)->get()->toArray();
    }
}
