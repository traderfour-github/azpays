
<?php

namespace App\Services\Meta;


use App\Enums\Payment\PaymentMeta;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class MetaService
{
    public function create(Model $model, array $metas){
        foreach ($metas as $meta){
            if ($meta[PaymentMeta::Password]){
                $meta['key'] = PaymentMeta::Password;
                $meta['value'] = Hash::make($meta[PaymentMeta::Password]);
            }
            $meta['metaable_id'] = $model->id;
            $meta['metaable_type'] = get_class($model);
            $model->metas()->create($meta);
        }
    }

    public function update(Model $model, array $metas){
        foreach ($metas as $meta){
            if (array_key_exists(PaymentMeta::Password, $meta)){
                $meta['key'] = PaymentMeta::Password;
                $meta['value'] = Hash::make($meta[PaymentMeta::Password]);
                unset($meta[PaymentMeta::Password]);
            }
            $meta['metaable_id'] = $model->id;
            $meta['metaable_type'] = get_class($model);
            $model->metas()->updateOrCreate(['key' => $meta['key']], $meta);
        }
    }

}
