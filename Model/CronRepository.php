<?php

namespace Creatuity\CronRunner\Model;


use Magento\Framework\App\ResourceConnection;

class CronRepository
{
    /** @var ResourceConnection */
    private $resourceConnection;

    /**
     * Cron constructor.
     * @param ResourceConnection $resourceConnection
     */
	public function __construct(
		ResourceConnection $resourceConnection
	) {
		$this->resourceConnection = $resourceConnection;
	}

    /**
     * @return array
     */
    public function getExecutionQueue()
    {
        $connection = $this->resourceConnection->getConnection();
        $ret = $connection->fetchCol($connection->select()->from('creatuity_cron', [new \Zend_Db_Expr('CONCAT(group_id, ".", job_name)')])->order('started_at'));
        $this->resourceConnection->closeConnection();
        return $ret;
    }

}
