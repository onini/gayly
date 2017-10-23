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

namespace Onini\Gayly\Support\Form\Field;

use Onini\Gayly\Support\Form\Field;
use Gayly;

class Editor extends Field
{
    protected static $js = [
        '/vendor/gayly/assets/plugins/ckeditor/ckeditor.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

        if ( CKEDITOR.env.ie && CKEDITOR.env.version < 9 )
        	CKEDITOR.tools.enableHtml5Elements( document );

        CKEDITOR.config.filebrowserUploadUrl = '/gayly/cms/article/upload?_token='+Gayly.token;
        CKEDITOR.config.image_previewText = '';
        // The trick to keep the editor in the sample quite small
        // unless user specified own height.
        CKEDITOR.config.height = 350;
        CKEDITOR.config.width = 'auto';
        CKEDITOR.replace('{$this->id}');

EOT;

        return parent::render();
    }
}
