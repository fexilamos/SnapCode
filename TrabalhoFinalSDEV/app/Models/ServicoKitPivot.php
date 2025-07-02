<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ServicoKitPivot extends Pivot
{

    protected $table = 'servico_kit';

    public $timestamps = false;
}
