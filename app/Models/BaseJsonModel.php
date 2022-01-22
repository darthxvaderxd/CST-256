<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class BaseJsonModel extends Model implements \JsonSerializable {
    public function jsonSerialize() {
        // We really don't want all the extra garbage, so cleaning that out
        $json_string = json_encode($this->attributes);
        $json_string = str_replace('[', '{', $json_string);
        $json_string = str_replace(']', '}', $json_string);
        $attribs = json_decode($json_string);
        return get_object_vars($attribs);
    }
}
