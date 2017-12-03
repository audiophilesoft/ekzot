<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . 'EntryBase.php';

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends EntryBase
{
    protected function getTableName(): string
    {
        return 'pages';
    }

    protected function setColumns(Blueprint $table)
    {
        $table->boolean('enable_comments')->default(false);
    }
}
