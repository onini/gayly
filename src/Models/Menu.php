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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;
use Onini\Gayly\Traits\ModelTree;
use Onini\Gayly\Traits\Builder;
use Illuminate\Http\Request;

class Menu extends Model
{
	use ModelTree, Builder;

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

	public function getCurrentParentNodes()
	{
		$nodes = $this->allNodes();

		$current = gayly_menu_current();

		$current_id = '';

		collect($nodes)->map(function ($value) use($current, &$current_id) {
			if ($value['uri'] == $current) {
				$current_id = $value['id'];
			}
		});

		return [
			'current_id' => $current_id,
			'parents' => $this->getParentId($nodes, $current_id)
		];
	}

	protected function getParentId($data, $id)
	{
		$array = [];

		foreach($data as $val){
			if($val['id'] == $id){
				$array[] = $val['id'];
				$array=array_merge($this->getParentId($data, $val['parent_id']), $array);
			}
		}

		return $array;
	}
}
