<?php

namespace markhuot\CraftQL\Services;

use Craft;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\GraphQL;
use GraphQL\Schema;
use Underscore\Types\Arrays;
use markhuot\CraftQL\Plugin;
use yii\base\Component;
use Yii;

class GraphQLService extends Component {

    private $schema;
    private $mutationType;
    private $queryType;

    function __construct(
        \markhuot\CraftQL\Types\Mutation $mutationType,
        \markhuot\CraftQL\Types\Query $queryType
    ) {
        $this->mutationType = $mutationType;
        $this->queryType = $queryType;
    }

    /**
     * Bootstrap the schema
     *
     * @return void
     */
    function bootstrap($writable=false) {
        $schema = [];
        $schema['query'] = $this->queryType->getType();
        $schema['types'] = $this->queryType->getTypes();

        $mutation = $this->mutationType->getType();
        if (count($mutation->getFields()) > 0) {
            $schema['mutation'] = $mutation;
        }

        $this->schema = new Schema($schema);
    }

    function execute($input, $variables = []) {
        return GraphQL::execute($this->schema, $input, null, null, $variables);
    }

}
