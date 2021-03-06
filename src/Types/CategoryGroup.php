<?php

namespace markhuot\CraftQL\Types;

use GraphQL\Type\Definition\Type;
use markhuot\CraftQL\Request;
use markhuot\CraftQL\Builders\Schema;

class CategoryGroup extends Schema {

    function boot() {
        $this->addIntField('id');
        $this->addStringField('name');
        $this->addStringField('handle');
    }

}