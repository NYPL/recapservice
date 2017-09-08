<?php
namespace NYPL\Services\Model\DataModel;

use NYPL\Starter\Model\ModelTrait\SierraTrait\SierraReadTrait;
use NYPL\Starter\ModelSet;

class SierraItemSet extends ModelSet
{
    use SierraReadTrait;

    /**
     * @param string|null $id
     *
     * @return string
     */
    public function getSierraPath($id = null)
    {
        if ($this->getFilters()) {
            foreach ($this->getFilters() as $filter) {
                $query[$filter->getFilterColumn()] = $filter->getFilterValue();
            }
        }

        return 'items/?limit=1000&' . http_build_query($query);
    }

    public function getIdFields()
    {
        return ['id'];
    }
}
