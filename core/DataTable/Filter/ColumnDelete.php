<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @version $Id: ColumnDelete.php 3764 2011-01-17 02:19:39Z matt $
 * 
 * @category Piwik
 * @package Piwik
 */

/**
 * Deletes a column from a datatable
 * 
 * @package Piwik
 * @subpackage Piwik_DataTable
 */
class Piwik_DataTable_Filter_ColumnDelete extends Piwik_DataTable_Filter
{
	private $columnToFilter;
	private $functionToApply;
	
	public function __construct( $table, $columnToDelete )
	{
		parent::__construct($table);
		$this->columnToDelete = $columnToDelete;
		$this->filter($table);
	}
	
	protected function filter($table)
	{
		$table->deleteColumn($this->columnToDelete);
	}
	
}
