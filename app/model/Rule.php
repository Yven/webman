<?php
declare (strict_types=1);

namespace app\model;

use think\Model;

/**
 * @property integer $id 主键ID(主键)
 * @property mixed $ptype 规则类型
 * @property string $v0 
 * @property string $v1 
 * @property string $v2 
 * @property string $v3 
 * @property string $v4 
 * @property string $v5
 */
class Rule extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wm_rule';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $pk = 'id';
}
