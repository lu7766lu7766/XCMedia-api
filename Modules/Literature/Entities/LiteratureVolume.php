<?php

namespace Modules\Literature\Entities;

use Modules\Base\Entities\BaseORM;
use Modules\Files\Entities\EditorFilesUsedHelper;

class LiteratureVolume extends BaseORM
{
    use EditorFilesUsedHelper;
    protected $table = 'literature_volume';
    protected $fillable = [
        'title',
        'open_at',
        'views',
        'status',
        'content',
        'literature_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function literature()
    {
        return $this->belongsTo(Literature::class);
    }
}
