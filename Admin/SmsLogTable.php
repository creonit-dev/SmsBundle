<?php

declare(strict_types=1);

namespace Creonit\SmsBundle\Admin;

use Creonit\AdminBundle\Component\Request\ComponentRequest;
use Creonit\AdminBundle\Component\Response\ComponentResponse;
use Creonit\AdminBundle\Component\Scope\ListRowScope;
use Creonit\AdminBundle\Component\Scope\ListRowScopeRelation;
use Creonit\AdminBundle\Component\Scope\Scope;
use Creonit\AdminBundle\Component\TableComponent;
use Creonit\SmsBundle\Model\SmsLogQuery;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;

class SmsLogTable extends TableComponent
{
    /**
     * @title СМС
     *
     * @header
     * <div class="clearfix">
     *     <form class="form-inline pull-right">
     *         {{ filterSearch | text({placeholder: 'Поиск', size: 'sm'}) }}
     *         {{ submit('Применить фильтры', {size: 'sm'}) }}
     *     </form>
     * </div>
     *
     * @cols . , Телефон, Текст, Статус, Дата отправки
     *
     * \SmsLog
     * @entity Creonit\SmsBundle\Model\SmsLog
     * @pagination 20
     *
     * @field status {load: 'entity.getStatusLabel()'}
     *
     * @col {{ id }}
     * @col {{ phone | open('SmsLogEditor', {key: _key}) }}
     * @col {{ content }}
     * @col {{ status }}
     * @col {{ created_at | date('d.m.Y H:i:s') }}
     */
    public function schema()
    {

    }

    /**
     * @param SmsLogQuery $query
     */
    protected function filter(ComponentRequest $request, ComponentResponse $response, $query, Scope $scope, $relation, $relationValue, $level)
    {
        parent::filter($request, $response, $query, $scope, $relation, $relationValue, $level);

        $query->orderById(Criteria::DESC);

        if ($filterSearch = $request->query->get('filterSearch')) {
            $query->filterByPhone("%$filterSearch%", Criteria::LIKE);
        }
    }
}
