<?php

/////////
//Create
/////////

Db_Schema_Myisam::getTablesCreateSql();

		$tables = array(
			'user' => "CREATE TABLE {$prefixTables}user (
						  login VARCHAR(100) NOT NULL,
						  password CHAR(32) NOT NULL,
						  alias VARCHAR(45) NOT NULL,
						  email VARCHAR(100) NOT NULL,
						  token_auth CHAR(32) NOT NULL,
						  date_registered TIMESTAMP NULL,
						  PRIMARY KEY(login),
						  UNIQUE KEY uniq_keytoken(token_auth)
						)  DEFAULT CHARSET=utf8
			",

			'access' => "CREATE TABLE {$prefixTables}access (
						  login VARCHAR(100) NOT NULL,
						  idsite INTEGER UNSIGNED NOT NULL,
						  access VARCHAR(10) NULL,
						  PRIMARY KEY(login, idsite)
						)  DEFAULT CHARSET=utf8
			",

			'site' => "CREATE TABLE {$prefixTables}site (
						  idsite INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
						  name VARCHAR(90) NOT NULL,
						  main_url VARCHAR(255) NOT NULL,
  						  ts_created TIMESTAMP NULL,
  						  timezone VARCHAR( 50 ) NOT NULL,
  						  currency CHAR( 3 ) NOT NULL,
  						  excluded_ips TEXT NOT NULL,
  						  excluded_parameters VARCHAR ( 255 ) NOT NULL,
  						  `group` VARCHAR(250) NOT NULL, 
						  PRIMARY KEY(idsite)
						)  DEFAULT CHARSET=utf8
			",

			'site_url' => "CREATE TABLE {$prefixTables}site_url (
							  idsite INTEGER(10) UNSIGNED NOT NULL,
							  url VARCHAR(255) NOT NULL,
							  PRIMARY KEY(idsite, url)
						)  DEFAULT CHARSET=utf8
			",

			'goal' => "	CREATE TABLE `{$prefixTables}goal` (
							  `idsite` int(11) NOT NULL,
							  `idgoal` int(11) NOT NULL,
							  `name` varchar(50) NOT NULL,
							  `match_attribute` varchar(20) NOT NULL,
							  `pattern` varchar(255) NOT NULL,
							  `pattern_type` varchar(10) NOT NULL,
							  `case_sensitive` tinyint(4) NOT NULL,
							  `allow_multiple` tinyint(4) NOT NULL,
							  `revenue` float NOT NULL,
							  `deleted` tinyint(4) NOT NULL default '0',
							  PRIMARY KEY  (`idsite`,`idgoal`)
							)  DEFAULT CHARSET=utf8
			",

			'logger_message' => "CREATE TABLE {$prefixTables}logger_message (
									  idlogger_message INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
									  timestamp TIMESTAMP NULL,
									  message TEXT NULL,
									  PRIMARY KEY(idlogger_message)
									)  DEFAULT CHARSET=utf8
			",

			'logger_api_call' => "CREATE TABLE {$prefixTables}logger_api_call (
									  idlogger_api_call INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
									  class_name VARCHAR(255) NULL,
									  method_name VARCHAR(255) NULL,
									  parameter_names_default_values TEXT NULL,
									  parameter_values TEXT NULL,
									  execution_time FLOAT NULL,
									  caller_ip INT UNSIGNED NULL,
									  timestamp TIMESTAMP NULL,
									  returned_value TEXT NULL,
									  PRIMARY KEY(idlogger_api_call)
									)  DEFAULT CHARSET=utf8
			",

			'logger_error' => "CREATE TABLE {$prefixTables}logger_error (
									  idlogger_error INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
									  timestamp TIMESTAMP NULL,
									  message TEXT NULL,
									  errno INTEGER UNSIGNED NULL,
									  errline INTEGER UNSIGNED NULL,
									  errfile VARCHAR(255) NULL,
									  backtrace TEXT NULL,
									  PRIMARY KEY(idlogger_error)
									) DEFAULT CHARSET=utf8
			",

			'logger_exception' => "CREATE TABLE {$prefixTables}logger_exception (
									  idlogger_exception INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
									  timestamp TIMESTAMP NULL,
									  message TEXT NULL,
									  errno INTEGER UNSIGNED NULL,
									  errline INTEGER UNSIGNED NULL,
									  errfile VARCHAR(255) NULL,
									  backtrace TEXT NULL,
									  PRIMARY KEY(idlogger_exception)
									)  DEFAULT CHARSET=utf8
			",

			'log_action' => "CREATE TABLE {$prefixTables}log_action (
									  idaction INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
									  name TEXT,
									  hash INTEGER(10) UNSIGNED NOT NULL,
  									  type TINYINT UNSIGNED NULL,
									  PRIMARY KEY(idaction),
									  INDEX index_type_hash (type, hash)
						)  DEFAULT CHARSET=utf8
			",

			'log_visit' => "CREATE TABLE {$prefixTables}log_visit (
							  idvisit INTEGER(10) UNSIGNED NOT NULL AUTO_INCREMENT,
							  idsite INTEGER(10) UNSIGNED NOT NULL,
							  idvisitor BINARY(8) NOT NULL,
							  visitor_localtime TIME NOT NULL,
							  visitor_returning TINYINT(1) NOT NULL,
							  visitor_count_visits SMALLINT(5) UNSIGNED NOT NULL,
							  visitor_days_since_last SMALLINT(5) UNSIGNED NOT NULL,
							  visitor_days_since_first SMALLINT(5) UNSIGNED NOT NULL,
							  visit_first_action_time DATETIME NOT NULL,
							  visit_last_action_time DATETIME NOT NULL,
							  visit_exit_idaction_url INTEGER(11) UNSIGNED NOT NULL,
							  visit_exit_idaction_name INTEGER(11) UNSIGNED NOT NULL,
							  visit_entry_idaction_url INTEGER(11) UNSIGNED NOT NULL,
							  visit_entry_idaction_name INTEGER(11) UNSIGNED NOT NULL,
							  visit_total_actions SMALLINT(5) UNSIGNED NOT NULL,
							  visit_total_time SMALLINT(5) UNSIGNED NOT NULL,
							  visit_goal_converted TINYINT(1) NOT NULL,
							  referer_type TINYINT(1) UNSIGNED NULL,
							  referer_name VARCHAR(70) NULL,
							  referer_url TEXT NOT NULL,
							  referer_keyword VARCHAR(255) NULL,
							  config_id BINARY(8) NOT NULL,
							  config_os CHAR(3) NOT NULL,
							  config_browser_name VARCHAR(10) NOT NULL,
							  config_browser_version VARCHAR(20) NOT NULL,
							  config_resolution VARCHAR(9) NOT NULL,
							  config_pdf TINYINT(1) NOT NULL,
							  config_flash TINYINT(1) NOT NULL,
							  config_java TINYINT(1) NOT NULL,
							  config_director TINYINT(1) NOT NULL,
							  config_quicktime TINYINT(1) NOT NULL,
							  config_realplayer TINYINT(1) NOT NULL,
							  config_windowsmedia TINYINT(1) NOT NULL,
							  config_gears TINYINT(1) NOT NULL,
							  config_silverlight TINYINT(1) NOT NULL,
							  config_cookie TINYINT(1) NOT NULL,
							  location_ip INT UNSIGNED NOT NULL,
							  location_browser_lang VARCHAR(20) NOT NULL,
							  location_country CHAR(3) NOT NULL,
							  location_continent CHAR(3) NOT NULL,
							  custom_var_k1 VARCHAR(50) DEFAULT NULL,
							  custom_var_v1 VARCHAR(50) DEFAULT NULL,
							  custom_var_k2 VARCHAR(50) DEFAULT NULL,
							  custom_var_v2 VARCHAR(50) DEFAULT NULL,
							  custom_var_k3 VARCHAR(50) DEFAULT NULL,
							  custom_var_v3 VARCHAR(50) DEFAULT NULL,
							  custom_var_k4 VARCHAR(50) DEFAULT NULL,
							  custom_var_v4 VARCHAR(50) DEFAULT NULL,
							  custom_var_k5 VARCHAR(50) DEFAULT NULL,
							  custom_var_v5 VARCHAR(50) DEFAULT NULL,
							  PRIMARY KEY(idvisit),
							  INDEX index_idsite_config_datetime (idsite, config_id, visit_last_action_time),
							  INDEX index_idsite_datetime (idsite, visit_last_action_time),
							  INDEX index_idsite_idvisitor (idsite, idvisitor)
							)  DEFAULT CHARSET=utf8
			",

			'log_conversion' => "CREATE TABLE `{$prefixTables}log_conversion` (
									  idvisit int(10) unsigned NOT NULL,
									  idsite int(10) unsigned NOT NULL,
									  idvisitor BINARY(8) NOT NULL,
									  server_time datetime NOT NULL,
									  idaction_url int(11) default NULL,
									  idlink_va int(11) default NULL,
									  referer_visit_server_date date default NULL,
									  referer_type int(10) unsigned default NULL,
									  referer_name varchar(70) default NULL,
									  referer_keyword varchar(255) default NULL,
									  visitor_returning tinyint(1) NOT NULL,
        							  visitor_count_visits SMALLINT(5) UNSIGNED NOT NULL,
        							  visitor_days_since_first SMALLINT(5) UNSIGNED NOT NULL,
									  location_country char(3) NOT NULL,
									  location_continent char(3) NOT NULL,
									  url text NOT NULL,
									  idgoal int(10) unsigned NOT NULL,
									  revenue float default NULL,
									  buster int unsigned NOT NULL,
        							  custom_var_k1 VARCHAR(50) DEFAULT NULL,
        							  custom_var_v1 VARCHAR(50) DEFAULT NULL,
        							  custom_var_k2 VARCHAR(50) DEFAULT NULL,
        							  custom_var_v2 VARCHAR(50) DEFAULT NULL,
        							  custom_var_k3 VARCHAR(50) DEFAULT NULL,
        							  custom_var_v3 VARCHAR(50) DEFAULT NULL,
        							  custom_var_k4 VARCHAR(50) DEFAULT NULL,
        							  custom_var_v4 VARCHAR(50) DEFAULT NULL,
        							  custom_var_k5 VARCHAR(50) DEFAULT NULL,
        							  custom_var_v5 VARCHAR(50) DEFAULT NULL,
									  PRIMARY KEY (idvisit, idgoal, buster),
									  INDEX index_idsite_datetime ( idsite, server_time )
									) DEFAULT CHARSET=utf8
			",

			'log_link_visit_action' => "CREATE TABLE {$prefixTables}log_link_visit_action (
											  idlink_va INTEGER(11) NOT NULL AUTO_INCREMENT,
									          idsite int(10) UNSIGNED NOT NULL,
									  		  idvisitor BINARY(8) NOT NULL,
									          server_time DATETIME NOT NULL,
											  idvisit INTEGER(10) UNSIGNED NOT NULL,
											  idaction_url INTEGER(10) UNSIGNED NOT NULL,
											  idaction_url_ref INTEGER(10) UNSIGNED NOT NULL,
											  idaction_name INTEGER(10) UNSIGNED,
											  idaction_name_ref INTEGER(10) UNSIGNED NOT NULL,
											  time_spent_ref_action INTEGER(10) UNSIGNED NOT NULL,
											  PRIMARY KEY(idlink_va),
											  INDEX index_idvisit(idvisit),
									          INDEX index_idsite_servertime ( idsite, server_time )
											)  DEFAULT CHARSET=utf8
			",

			'log_profiling' => "CREATE TABLE {$prefixTables}log_profiling (
								  query TEXT NOT NULL,
								  count INTEGER UNSIGNED NULL,
								  sum_time_ms FLOAT NULL,
								  UNIQUE KEY query(query(100))
								)  DEFAULT CHARSET=utf8
			",

			'option' => "CREATE TABLE `{$prefixTables}option` (
								option_name VARCHAR( 255 ) NOT NULL,
								option_value LONGTEXT NOT NULL,
								autoload TINYINT NOT NULL DEFAULT '1',
								PRIMARY KEY ( option_name ),
								INDEX autoload( autoload )
								)  DEFAULT CHARSET=utf8
			",

			'archive_numeric'	=> "CREATE TABLE {$prefixTables}archive_numeric (
									  idarchive INTEGER UNSIGNED NOT NULL,
									  name VARCHAR(255) NOT NULL,
									  idsite INTEGER UNSIGNED NULL,
									  date1 DATE NULL,
								  	  date2 DATE NULL,
									  period TINYINT UNSIGNED NULL,
								  	  ts_archived DATETIME NULL,
								  	  value FLOAT NULL,
									  PRIMARY KEY(idarchive, name),
									  INDEX index_idsite_dates_period(idsite, date1, date2, period, ts_archived),
									  INDEX index_period_archived(period, ts_archived)
									)  DEFAULT CHARSET=utf8
			",

			'archive_blob'	=> "CREATE TABLE {$prefixTables}archive_blob (
									  idarchive INTEGER UNSIGNED NOT NULL,
									  name VARCHAR(255) NOT NULL,
									  idsite INTEGER UNSIGNED NULL,
									  date1 DATE NULL,
									  date2 DATE NULL,
									  period TINYINT UNSIGNED NULL,
									  ts_archived DATETIME NULL,
									  value MEDIUMBLOB NULL,
									  PRIMARY KEY(idarchive, name),
									  INDEX index_period_archived(period, ts_archived)
									)  DEFAULT CHARSET=utf8
			",
		);
		
/////////
Updates_0_2_24::getSql($schema = 'Myisam');

		return array(
			'CREATE INDEX index_type_name
				ON '. Piwik_Common::prefixTable('log_action') .' (type, name(15))' => false,
			'CREATE INDEX index_idsite_date
				ON '. Piwik_Common::prefixTable('log_visit') .' (idsite, visit_server_date)' => false,
			'DROP INDEX index_idsite ON '. Piwik_Common::prefixTable('log_visit') => false,
			'DROP INDEX index_visit_server_date ON '. Piwik_Common::prefixTable('log_visit') => false,
		);

/////////
Updates_0_2_27::getSql($schema = 'Myisam');
		
		$sqlarray = array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				ADD `visit_goal_converted` VARCHAR( 1 ) NOT NULL AFTER `visit_total_time`' => false,
			// 0.2.27 [826]
			'ALTER IGNORE TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				CHANGE `visit_goal_converted` `visit_goal_converted` TINYINT(1) NOT NULL' => false,
		);
		$sqlarray[ 'CREATE INDEX index_all ON '. $tableName .' (`idsite`,`date1`,`date2`,`name`,`ts_archived`)' ] = false;
		
/////////
Updates_0_5_5::getSql($schema = 'Myisam');

		$sqlarray = array(
			'DROP INDEX index_idsite_date ON ' . Piwik_Common::prefixTable('log_visit') => '1091',
			'CREATE INDEX index_idsite_date_config ON ' . Piwik_Common::prefixTable('log_visit') . ' (idsite, visit_server_date, config_md5config(8))' => '1061',
		);
		
			if(preg_match('/archive_/', $tableName) == 1)
			{
				$sqlarray[ 'DROP INDEX index_all ON '. $tableName ] = '1091';
			}
			if(preg_match('/archive_numeric_/', $tableName) == 1)
			{
				$sqlarray[ 'CREATE INDEX index_idsite_dates_period ON '. $tableName .' (idsite, date1, date2, period)' ] = '1061';
			}

/////////
Updates_0_5::getSql($schema = 'Myisam');

		return array(
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_action') . ' ADD COLUMN `hash` INTEGER(10) UNSIGNED NOT NULL AFTER `name`;' => '1060',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_visit') . ' CHANGE visit_exit_idaction visit_exit_idaction_url INTEGER(11) NOT NULL;' => '1054',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_visit') . ' CHANGE visit_entry_idaction visit_entry_idaction_url INTEGER(11) NOT NULL;' => '1054',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_link_visit_action') . ' CHANGE `idaction_ref` `idaction_url_ref` INTEGER(10) UNSIGNED NOT NULL;' => '1054',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_link_visit_action') . ' CHANGE `idaction` `idaction_url` INTEGER(10) UNSIGNED NOT NULL;' => '1054', 
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_link_visit_action') . ' ADD COLUMN `idaction_name` INTEGER(10) UNSIGNED AFTER `idaction_url_ref`;' => '1060',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_conversion') . ' CHANGE `idaction` `idaction_url` INTEGER(11) UNSIGNED NOT NULL;' => '1054',
			'UPDATE ' . Piwik_Common::prefixTable('log_action') . ' SET `hash` = CRC32(name);' => false,
			'CREATE INDEX index_type_hash ON ' . Piwik_Common::prefixTable('log_action') . ' (type, hash);' => '1061',
			'DROP INDEX index_type_name ON ' . Piwik_Common::prefixTable('log_action') . ';' => '1091',
		);

/////////
Cache_Backend_Sqlite::getMetadatas($id);		

        $res = $this->_query("SELECT name FROM tag WHERE id='$id'");
        $this->_query('CREATE TABLE cache (id TEXT PRIMARY KEY, content BLOB, lastModified INTEGER, expire INTEGER)');
        $res = $this->_query("SELECT lastModified,expire FROM cache WHERE id='$id'");

/////////
Cache_Backend_Sqlite::_buildStructure();

        $this->_query('DROP INDEX tag_id_index');
        $this->_query('DROP INDEX tag_name_index');
        $this->_query('DROP INDEX cache_id_expire_index');
        $this->_query('DROP TABLE version');
        $this->_query('DROP TABLE cache');
        $this->_query('DROP TABLE tag');
        $this->_query('CREATE TABLE version (num INTEGER PRIMARY KEY)');
        $this->_query('CREATE TABLE cache (id TEXT PRIMARY KEY, content BLOB, lastModified INTEGER, expire INTEGER)');
        $this->_query('CREATE TABLE tag (name TEXT, id TEXT)');
        $this->_query('CREATE INDEX tag_id_index ON tag(id)');
        $this->_query('CREATE INDEX tag_name_index ON tag(name)');
        $this->_query('CREATE INDEX cache_id_expire_index ON cache(id, expire)');
        $this->_query('INSERT INTO version (num) VALUES (1)');

/////////
Dashboard::install();

			$sql = "CREATE TABLE ". Piwik_Common::prefixTable('user_dashboard')." (
					login VARCHAR( 100 ) NOT NULL ,
					iddashboard INT NOT NULL ,
					layout TEXT NOT NULL,
					PRIMARY KEY ( login , iddashboard )
					)  DEFAULT CHARSET=utf8 " ;

/////////
LanguagesManager::install();

			$sql = "CREATE TABLE ". Piwik_Common::prefixTable('user_language')." (
					login VARCHAR( 100 ) NOT NULL ,
					language VARCHAR( 10 ) NOT NULL ,
					PRIMARY KEY ( login )
					)  DEFAULT CHARSET=utf8 " ;
			
/////////
PDFReports::install();
			
		$queries[] = "
                CREATE TABLE ".Piwik_Common::prefixTable('pdf')." (
					idreport INT(11) NOT NULL AUTO_INCREMENT,
					idsite INTEGER(11) NOT NULL,
					login VARCHAR(100) NOT NULL,
					description VARCHAR(255) NOT NULL,
					period VARCHAR(10) NULL,
					email_me TINYINT NULL,
					additional_emails TEXT NULL,
					reports TEXT NOT NULL,
					ts_created TIMESTAMP NULL,
					ts_last_sent TIMESTAMP NULL,
					deleted tinyint(4) NOT NULL default '0',
					PRIMARY KEY (idreport)
				) DEFAULT CHARSET=utf8";

		
/////////
//Select
/////////
Archive_Array_IndexedByDate::getDataTableFromNumeric( $fields );

		$sql = "SELECT value, name, date1 as startDate
				FROM $table
				WHERE idarchive IN ( $inIds )
				AND name IN ( $inNames )
				ORDER BY date1, name";

/////////
Archive_Array_IndexedBySite::loadValuesFromDB($fields);

 		$sql = "SELECT value, name, idarchive, idsite
								FROM {$this->getNumericTableName()}
								WHERE idarchive IN ( $archiveIds )
									AND name IN ( $inNames )";

/////////
Archive_Single::get( $name, $typeValue = 'numeric' );
 		
		$value = $db->fetchOne("SELECT value 
								FROM $table
								WHERE idarchive = ?
									AND name = ?",	
								array( $this->idArchive , $name) 
							);

/////////
Archive_Single::preFetchBlob( $name );

		$query = $db->query("SELECT value, name
								FROM $tableBlob
								WHERE idarchive = ?
									AND name LIKE '$name%'",	
								array( $this->idArchive ) 
							);

/////////
ArchiveProcessing_Day::isThereSomeVisits();

			$query = "SELECT 	count(distinct idvisitor) as nb_uniq_visitors, 
								count(*) as nb_visits,
								sum(visit_total_actions) as nb_actions, 
								max(visit_total_actions) as max_actions, 
								sum(visit_total_time) as sum_visit_length,
								sum(case visit_total_actions when 1 then 1 else 0 end) as bounce_count,
								sum(case visit_goal_converted when 1 then 1 else 0 end) as nb_visits_converted
						FROM ".Piwik_Common::prefixTable('log_visit')."
						WHERE visit_last_action_time >= ?
							AND visit_last_action_time <= ?
							AND idsite = ?
							$sqlSegment
						ORDER BY NULL";


/////////
ArchiveProcessing_Day::getSimpleDataTableFromSelect($select, $labelCount);

		$query = "SELECT $select 
			 	FROM ".Piwik_Common::prefixTable('log_visit')." 
			 	WHERE visit_last_action_time >= ?
						AND visit_last_action_time <= ?
			 			AND idsite = ?
			 			$sqlSegment";

/////////
ArchiveProcessing_Day::queryVisitsByDimension($label, $where = '');

		$query = "SELECT 	$select,
							count(distinct idvisitor) as `". Piwik_Archive::INDEX_NB_UNIQ_VISITORS ."`, 
							count(*) as `". Piwik_Archive::INDEX_NB_VISITS ."`,
							sum(visit_total_actions) as `". Piwik_Archive::INDEX_NB_ACTIONS ."`, 
							max(visit_total_actions) as `". Piwik_Archive::INDEX_MAX_ACTIONS ."`, 
							sum(visit_total_time) as `". Piwik_Archive::INDEX_SUM_VISIT_LENGTH ."`,
							sum(case visit_total_actions when 1 then 1 else 0 end) as `". Piwik_Archive::INDEX_BOUNCE_COUNT ."`,
							sum(case visit_goal_converted when 1 then 1 else 0 end) as `". Piwik_Archive::INDEX_NB_VISITS_CONVERTED ."`
				FROM ".Piwik_Common::prefixTable('log_visit')."
				WHERE visit_last_action_time >= ?
						AND visit_last_action_time <= ?
						AND idsite = ?
						$where
						$segment
				GROUP BY $groupBy
				ORDER BY NULL";
						
/////////
ArchiveProcessing_Day::queryConversionsByDimension($label, $where = '');

		$query = "SELECT idgoal,
						count(*) as `". Piwik_Archive::INDEX_GOAL_NB_CONVERSIONS ."`,
						truncate(sum(revenue),2) as `". Piwik_Archive::INDEX_GOAL_REVENUE ."`,
						count(distinct idvisit) as `". Piwik_Archive::INDEX_GOAL_NB_VISITS_CONVERTED."`,
						$select
			 	FROM ".Piwik_Common::prefixTable('log_conversion')."
			 	WHERE server_time >= ?
						AND server_time <= ?
			 			AND idsite = ?
			 			$where
						$segment
			 	GROUP BY idgoal, $groupBy
				ORDER BY NULL";


/////////
ArchiveProcessing_Period::computeNbUniqVisitors();

		$query = "
			SELECT count(distinct idvisitor) as nb_uniq_visitors 
			FROM ".Piwik_Common::prefixTable('log_visit')."
			WHERE visit_last_action_time >= ?
    				AND visit_last_action_time <= ? 
    				AND idsite = ?
    				$sqlSegment
    				";

/////////
ArchiveProcessing_Period::postCompute();

			$result = Piwik_FetchAll("
							SELECT idarchive
							FROM $numericTable
							WHERE name LIKE 'done%'
								AND value = ". Piwik_ArchiveProcessing::DONE_OK_TEMPORARY ."
								AND ts_archived < ?", array($yesterday));
			
   			$query = "DELETE 
    						FROM %s
    						WHERE idarchive IN (".implode(',',$idArchivesToDelete).")
    						";
			
    		$query = "DELETE 
    					FROM %s
    					WHERE period = ?
    						AND ts_archived < ?";
    			
/////////
Db_Pdo_Mssql::getServerVersion();

			$stmt = $this->query("SELECT CAST(SERVERPROPERTY('productversion') as VARCHAR) as productversion");

/////////
Tracker_Action::getSqlSelectActionId();

			$sql = "SELECT idaction, type 
								FROM ".Piwik_Common::prefixTable('log_action')
							."  WHERE "
							."		( hash = CRC32(?) AND name = ? AND type = ? ) ";

/////////
Tracker_Visit::recognizeTheVisitor();

		{
			printDebug("Matching the visitor based on his idcookie: ".bin2hex($this->visitorInfo['idvisitor']) ."...");
			
			$where .= ' AND idvisitor = ?';
			$bindSql[] = $this->visitorInfo['idvisitor'];
		}
		
		$sql = " SELECT  	idvisitor,
							visit_last_action_time,
							visit_first_action_time,
							idvisit,
							visit_exit_idaction_url,
							visit_exit_idaction_name,
							visitor_returning,
							visitor_days_since_first,
							referer_name,
							referer_keyword,
							referer_type,
							visitor_count_visits
				FROM ".Piwik_Common::prefixTable('log_visit').
				" WHERE ".$where."
				ORDER BY visit_last_action_time DESC
				LIMIT 1";

/////////
Access::getSqlAccessSite($select);

		return "SELECT ". $select ."
						  FROM ".Piwik_Common::prefixTable('access'). " as t1 
							JOIN ".Piwik_Common::prefixTable('site')." as t2 USING (idsite) ".
						" WHERE login = ?";

		
/////////
ArchiveProcessing::loadNextIdarchive();

		$id = $db->fetchOne("SELECT max(idarchive) 
							FROM ".$this->tableArchiveNumeric->getTableName());
		
/////////
ArchiveProcessing::get($name);

		$value = Piwik_FetchOne( 'SELECT option_value '. 
							'FROM `' . Piwik_Common::prefixTable('option') . '`'.
							'WHERE option_name = ?', $name);

/////////
ArchiveProcessing::isArchived();

		if($done != $doneAllPluginsProcessed)
		{
			$sqlSegmentsFindArchiveAllPlugins = "OR (name = '".$doneAllPluginsProcessed."' AND value = ".Piwik_ArchiveProcessing::DONE_OK.")
					OR (name = '".$doneAllPluginsProcessed."' AND value = ".Piwik_ArchiveProcessing::DONE_OK_TEMPORARY.")";
		}
		$sqlQuery = "	SELECT idarchive, value, name, date1 as startDate
						FROM ".$this->tableArchiveNumeric->getTableName()."
						WHERE idsite = ?
							AND date1 = ?
							AND date2 = ?
							AND period = ?
							AND ( (name = '".$done."' AND value = ".Piwik_ArchiveProcessing::DONE_OK.")
									OR (name = '".$done."' AND value = ".Piwik_ArchiveProcessing::DONE_OK_TEMPORARY.")
									$sqlSegmentsFindArchiveAllPlugins
									OR name = 'nb_visits')
							$timeStampWhere
						ORDER BY ts_archived DESC";

							
/////////
Option::get($name);

		$value = Piwik_FetchOne( 'SELECT option_value '. 
							'FROM `' . Piwik_Common::prefixTable('option') . '`'.
							'WHERE option_name = ?', $name);

/////////
Option::autoload();

		$all = Piwik_FetchAll('SELECT option_value, option_name
								FROM `'. Piwik_Common::prefixTable('option') . '` 
								WHERE autoload = 1');

/////////
Piwik::printSqlProfilingReportTracker( $db = null );

		$all = $db->fetchAll('SELECT * FROM '.$tableName );

/////////
Cache_Backend_Sqlite::load($id, $doNotTestCacheValidity = false);

        $sql = "SELECT content FROM cache WHERE id='$id'";
        if (!$doNotTestCacheValidity) {
            $sql = $sql . " AND (expire=0 OR expire>" . time() . ')';
        }

/////////
Cache_Backend_Sqlite::test($id);

        $sql = "SELECT lastModified FROM cache WHERE id='$id' AND (expire=0 OR expire>" . time() . ')';

/////////
Cache_Backend_Sqlite::remove($id);
        
        $res = $this->_query("SELECT COUNT(*) AS nbr FROM cache WHERE id='$id'");
        $result1 = @sqlite_fetch_single($res);
        $result2 = $this->_query("DELETE FROM cache WHERE id='$id'");
        $result3 = $this->_query("DELETE FROM tag WHERE id='$id'");

/////////
Cache_Backend_Sqlite::getIds();

        $res = $this->_query("SELECT id FROM cache WHERE (expire=0 OR expire>" . time() . ")");

/////////
Cache_Backend_Sqlite::getTags();

        $res = $this->_query("SELECT DISTINCT(name) AS name FROM tag");

/////////
Cache_Backend_Sqlite::getIdsMatchingTags($tags = array());

        $res = $this->_query("SELECT DISTINCT(id) AS id FROM tag WHERE name='$tag'");

/////////
Cache_Backend_Sqlite::getIdsNotMatchingTags($tags = array());
        
        $res = $this->_query("SELECT id FROM cache");
        $res = $this->_query("SELECT COUNT(*) AS nbr FROM tag WHERE name='$tag' AND id='$id'");
        
/////////
Cache_Backend_Sqlite::getIdsNotMatchingTags($tags = array());

        $res = $this->_query("SELECT id FROM cache");
        $res = $this->_query("SELECT COUNT(*) AS nbr FROM tag WHERE name='$tag' AND id='$id'");
        
/////////
Cache_Backend_Sqlite::getIdsMatchingAnyTags($tags = array());

        $res = $this->_query("SELECT DISTINCT(id) AS id FROM tag WHERE name='$tag'");

/////////
Cache_Backend_Sqlite::getMetadatas($id);

        $res = $this->_query("SELECT name FROM tag WHERE id='$id'");
        $this->_query('CREATE TABLE cache (id TEXT PRIMARY KEY, content BLOB, lastModified INTEGER, expire INTEGER)');
        $res = $this->_query("SELECT lastModified,expire FROM cache WHERE id='$id'");
        
/////////
Cache_Backend_Sqlite::touch($id, $extraLifetime);

        $sql = "SELECT expire FROM cache WHERE id='$id' AND (expire=0 OR expire>" . time() . ')';
        $res = $this->_query("UPDATE cache SET lastModified=" . time() . ", expire=$newExpire WHERE id='$id'");
        
/////////
Cache_Backend_Sqlite::_checkStructureVersion();

        $result = $this->_query("SELECT num FROM version");

/////////
Cache_Backend_Sqlite::_clean($mode = Zend_Cache::CLEANING_MODE_ALL, $tags = array());

                $res1 = $this->_query('DELETE FROM cache');
                $res2 = $this->_query('DELETE FROM tag');
                $res1 = $this->_query("DELETE FROM tag WHERE id IN (SELECT id FROM cache WHERE expire>0 AND expire<=$mktime)");
                $res2 = $this->_query("DELETE FROM cache WHERE expire>0 AND expire<=$mktime");
                
/////////
Zend_Db_Adapter_Pdo_Ibm_Db2::listTables();
        $sql = "SELECT tabname "
        . "FROM SYSCAT.TABLES ";

/////////
Zend_Db_Adapter_Pdo_Ibm_Db2::describeTable($tableName, $schemaName = null);
        $sql = "SELECT DISTINCT c.tabschema, c.tabname, c.colname, c.colno,
                c.typename, c.default, c.nulls, c.length, c.scale,
                c.identity, tc.type AS tabconsttype, k.colseq
                FROM syscat.columns c
                LEFT JOIN (syscat.keycoluse k JOIN syscat.tabconst tc
                 ON (k.tabschema = tc.tabschema
                   AND k.tabname = tc.tabname
                   AND tc.type = 'P'))
                 ON (c.tabschema = k.tabschema
                 AND c.tabname = k.tabname
                 AND c.colname = k.colname)
            WHERE "
            . $this->_adapter->quoteInto('UPPER(c.tabname) = UPPER(?)', $tableName);
        if ($schemaName) {
            $sql .= $this->_adapter->quoteInto(' AND UPPER(c.tabschema) = UPPER(?)', $schemaName);
        }
        $sql .= " ORDER BY c.colno";

/////////
Zend_Db_Adapter_Pdo_Ibm_Db2::limit($sql, $count, $offset = 0);

            $limit_sql = $sql . " FETCH FIRST $count ROWS ONLY";
            $limit_sql = "SELECT z2.*
              FROM (
                  SELECT ROW_NUMBER() OVER() AS \"ZEND_DB_ROWNUM\", z1.*
                  FROM (
                      " . $sql . "
                  ) z1
              ) z2
              WHERE z2.zend_db_rownum BETWEEN " . ($offset+1) . " AND " . ($offset+$count);
                
/////////
Zend_Db_Adapter_Pdo_Ibm_Db2::lastSequenceId($sequenceName);

        $sql = 'SELECT PREVVAL FOR '.$this->_adapter->quoteIdentifier($sequenceName).' AS VAL FROM SYSIBM.SYSDUMMY1';

/////////
Zend_Db_Adapter_Pdo_Ibm_Db2::nextSequenceId($sequenceName);

        $sql = 'SELECT NEXTVAL FOR '.$this->_adapter->quoteIdentifier($sequenceName).' AS VAL FROM SYSIBM.SYSDUMMY1';
        
/////////
Zend_Db_Adapter_Pdo_Ibm_Ids::listTables();

		$sql = "SELECT tabname "
        . "FROM systables ";


/////////
Zend_Db_Adapter_Pdo_Ibm_Ids::describeTable($tableName, $schemaName = null);

        $sql= "SELECT DISTINCT t.owner, t.tabname, c.colname, c.colno, c.coltype,
               d.default, c.collength, t.tabid
               FROM syscolumns c
               JOIN systables t ON c.tabid = t.tabid
               LEFT JOIN sysdefaults d ON c.tabid = d.tabid AND c.colno = d.colno
               WHERE "
                . $this->_adapter->quoteInto('UPPER(t.tabname) = UPPER(?)', $tableName);
        if ($schemaName) {
            $sql .= $this->_adapter->quoteInto(' AND UPPER(t.owner) = UPPER(?)', $schemaName);
        }
        $sql .= " ORDER BY c.colno";

        $desc = array();
        $stmt = $this->_adapter->query($sql);

        $result = $stmt->fetchAll(Zend_Db::FETCH_NUM);

/////////
Zend_Db_Adapter_Pdo_Ibm_Ids::_getPrimaryInfo($tabid);
        
        $sql = "SELECT i.part1, i.part2, i.part3, i.part4, i.part5, i.part6,
                i.part7, i.part8, i.part9, i.part10, i.part11, i.part12,
                i.part13, i.part14, i.part15, i.part16
                FROM sysindexes i
                JOIN sysconstraints c ON c.idxname = i.idxname
                WHERE i.tabid = " . $tabid . " AND c.constrtype = 'P'";

/////////
Zend_Db_Adapter_Pdo_Ibm_Ids::limit($sql, $count, $offset = 0);

              $limit_sql = str_ireplace("SELECT", "SELECT * FROM (SELECT", $sql);
              $limit_sql .= ") WHERE 0 = 1";
            if ($offset == 0) {
                $limit_sql = str_ireplace("SELECT", "SELECT FIRST $count", $sql);
            } else {
                $limit_sql = str_ireplace("SELECT", "SELECT SKIP $offset LIMIT $count", $sql);
            }
              
/////////
Zend_Db_Adapter_Pdo_Ibm_Ids::lastSequenceId($sequenceName);

        $sql = 'SELECT '.$this->_adapter->quoteIdentifier($sequenceName).'.CURRVAL FROM '
               .'systables WHERE tabid = 1';

/////////
Zend_Db_Adapter_Pdo_Ibm_Ids::nextSequenceId($sequenceName);

        $sql = 'SELECT '.$this->_adapter->quoteIdentifier($sequenceName).'.NEXTVAL FROM '
               .'systables WHERE tabid = 1';

/////////
Zend_Db_Adapter_Pdo_Ibm::getServerVersion();

        $stmt = $this->query('SELECT service_level, fixpack_num FROM TABLE (sysproc.env_get_inst_info()) as INSTANCEINFO');
               
/////////
Zend_Db_Adapter_Pdo_Mssql::listTables();

        $sql = "SELECT name FROM sysobjects WHERE type = 'U' ORDER BY name";

/////////
Zend_Db_Adapter_Pdo_Mssql::limit($sql, $count, $offset = 0);

        $sql = preg_replace(
            '/^SELECT\s+(DISTINCT\s)?/i',
            'SELECT $1TOP ' . ($count+$offset) . ' ',
            $sql
            );
        $orderby = stristr($sql, 'ORDER BY');
        $inv = preg_replace('/\s+desc$/i', ' ASC', $orderPart, 1, $pregReplaceCount);
        $inv = preg_replace('/\s+asc$/i', ' DESC', $orderPart, 1, $pregReplaceCount);
		$orderbyInverseParts[] = $orderPart . ' DESC';
        $orderbyInverse = 'ORDER BY ' . implode(', ', $orderbyInverseParts);
        
        $sql = 'SELECT * FROM (SELECT TOP ' . $count . ' * FROM (' . $sql . ') AS inner_tbl';
        $sql .= ') AS outer_tbl';
        
/////////
Zend_Db_Adapter_Pdo_Mssql::lastInsertId($tableName = null, $primaryKey = null);

        $sql = 'SELECT SCOPE_IDENTITY()';

/////////
Zend_Db_Adapter_Pdo_Mssql::getServerVersion();

        $stmt = $this->query("SELECT SERVERPROPERTY('productversion')");

/////////
Zend_Db_Adapter_Pdo_Mysql::limit($sql, $count, $offset = 0);

        $sql .= " LIMIT $count";
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

/////////
Zend_Db_Adapter_Pdo_Oci::listTables();

        $data = $this->fetchCol('SELECT table_name FROM all_tables');

/////////
Zend_Db_Adapter_Pdo_Oci::describeTable($tableName, $schemaName = null);        

        if (($version === null) || version_compare($version, '9.0.0', '>=')) {
            $sql = "SELECT TC.TABLE_NAME, TC.OWNER, TC.COLUMN_NAME, TC.DATA_TYPE,
                    TC.DATA_DEFAULT, TC.NULLABLE, TC.COLUMN_ID, TC.DATA_LENGTH,
                    TC.DATA_SCALE, TC.DATA_PRECISION, C.CONSTRAINT_TYPE, CC.POSITION
                FROM ALL_TAB_COLUMNS TC
                LEFT JOIN (ALL_CONS_COLUMNS CC JOIN ALL_CONSTRAINTS C
                    ON (CC.CONSTRAINT_NAME = C.CONSTRAINT_NAME AND CC.TABLE_NAME = C.TABLE_NAME AND CC.OWNER = C.OWNER AND C.CONSTRAINT_TYPE = 'P'))
                  ON TC.TABLE_NAME = CC.TABLE_NAME AND TC.COLUMN_NAME = CC.COLUMN_NAME
                WHERE UPPER(TC.TABLE_NAME) = UPPER(:TBNAME)";
            $bind[':TBNAME'] = $tableName;
            if ($schemaName) {
                $sql .= ' AND UPPER(TC.OWNER) = UPPER(:SCNAME)';
                $bind[':SCNAME'] = $schemaName;
            }
            $sql .= ' ORDER BY TC.COLUMN_ID';
        } else {
            $subSql="SELECT AC.OWNER, AC.TABLE_NAME, ACC.COLUMN_NAME, AC.CONSTRAINT_TYPE, ACC.POSITION
                from ALL_CONSTRAINTS AC, ALL_CONS_COLUMNS ACC
                  WHERE ACC.CONSTRAINT_NAME = AC.CONSTRAINT_NAME
                    AND ACC.TABLE_NAME = AC.TABLE_NAME
                    AND ACC.OWNER = AC.OWNER
                    AND AC.CONSTRAINT_TYPE = 'P'
                    AND UPPER(AC.TABLE_NAME) = UPPER(:TBNAME)";
            $bind[':TBNAME'] = $tableName;
            if ($schemaName) {
                $subSql .= ' AND UPPER(ACC.OWNER) = UPPER(:SCNAME)';
                $bind[':SCNAME'] = $schemaName;
            }
            $sql="SELECT TC.TABLE_NAME, TC.OWNER, TC.COLUMN_NAME, TC.DATA_TYPE,
                    TC.DATA_DEFAULT, TC.NULLABLE, TC.COLUMN_ID, TC.DATA_LENGTH,
                    TC.DATA_SCALE, TC.DATA_PRECISION, CC.CONSTRAINT_TYPE, CC.POSITION
                FROM ALL_TAB_COLUMNS TC, ($subSql) CC
                WHERE UPPER(TC.TABLE_NAME) = UPPER(:TBNAME)
                  AND TC.OWNER = CC.OWNER(+) AND TC.TABLE_NAME = CC.TABLE_NAME(+) AND TC.COLUMN_NAME = CC.COLUMN_NAME(+)";
            if ($schemaName) {
                $sql .= ' AND UPPER(TC.OWNER) = UPPER(:SCNAME)';
            }
            $sql .= ' ORDER BY TC.COLUMN_ID';

/////////
Zend_Db_Adapter_Pdo_Oci::lastSequenceId($sequenceName);

        $value = $this->fetchOne('SELECT '.$this->quoteIdentifier($sequenceName, true).'.CURRVAL FROM dual');

/////////
Zend_Db_Adapter_Pdo_Oci::nextSequenceId($sequenceName);

        $value = $this->fetchOne('SELECT '.$this->quoteIdentifier($sequenceName, true).'.NEXTVAL FROM dual');


/////////
Zend_Db_Adapter_Pdo_Oci::limit($sql, $count, $offset = 0);

        $limit_sql = "SELECT z2.*
            FROM (
                SELECT z1.*, ROWNUM AS \"zend_db_rownum\"
                FROM (
                    " . $sql . "
                ) z1
            ) z2
            WHERE z2.\"zend_db_rownum\" BETWEEN " . ($offset+1) . " AND " . ($offset+$count);

/////////
Zend_Db_Adapter_Pdo_Pgsql::listTables();

        $sql = "SELECT c.relname AS table_name "
             . "FROM pg_class c, pg_user u "
             . "WHERE c.relowner = u.usesysid AND c.relkind = 'r' "
             . "AND NOT EXISTS (SELECT 1 FROM pg_views WHERE viewname = c.relname) "
             . "AND c.relname !~ '^(pg_|sql_)' "
             . "UNION "
             . "SELECT c.relname AS table_name "
             . "FROM pg_class c "
             . "WHERE c.relkind = 'r' "
             . "AND NOT EXISTS (SELECT 1 FROM pg_views WHERE viewname = c.relname) "
             . "AND NOT EXISTS (SELECT 1 FROM pg_user WHERE usesysid = c.relowner) "
             . "AND c.relname !~ '^pg_'";

/////////
Zend_Db_Adapter_Pdo_Pgsql::lastSequenceId($sequenceName);

        $value = $this->fetchOne("SELECT CURRVAL("
               . $this->quote($this->quoteIdentifier($sequenceName, true))
               . ")");


/////////
Zend_Db_Adapter_Pdo_Pgsql::nextSequenceId($sequenceName);

        $value = $this->fetchOne("SELECT NEXTVAL("
               . $this->quote($this->quoteIdentifier($sequenceName, true))
               . ")");

/////////
Zend_Db_Adapter_Pdo_Sqlite::listTables();
               
        $sql = "SELECT name FROM sqlite_master WHERE type='table' "
             . "UNION ALL SELECT name FROM sqlite_temp_master "
             . "WHERE type='table' ORDER BY name";

/////////
Zend_Db_Adapter_Db2::describeTable($tableName, $schemaName = null);

        if (!$this->_isI5) {

            $sql = "SELECT DISTINCT c.tabschema, c.tabname, c.colname, c.colno,
                c.typename, c.default, c.nulls, c.length, c.scale,
                c.identity, tc.type AS tabconsttype, k.colseq
                FROM syscat.columns c
                LEFT JOIN (syscat.keycoluse k JOIN syscat.tabconst tc
                ON (k.tabschema = tc.tabschema
                    AND k.tabname = tc.tabname
                    AND tc.type = 'P'))
                ON (c.tabschema = k.tabschema
                    AND c.tabname = k.tabname
                    AND c.colname = k.colname)
                WHERE "
                . $this->quoteInto('UPPER(c.tabname) = UPPER(?)', $tableName);

            if ($schemaName) {
               $sql .= $this->quoteInto(' AND UPPER(c.tabschema) = UPPER(?)', $schemaName);
            }

            $sql .= " ORDER BY c.colno";

        } else {

            // DB2 On I5 specific query
            $sql = "SELECT DISTINCT C.TABLE_SCHEMA, C.TABLE_NAME, C.COLUMN_NAME, C.ORDINAL_POSITION,
                C.DATA_TYPE, C.COLUMN_DEFAULT, C.NULLS ,C.LENGTH, C.SCALE, LEFT(C.IDENTITY,1),
                LEFT(tc.TYPE, 1) AS tabconsttype, k.COLSEQ
                FROM QSYS2.SYSCOLUMNS C
                LEFT JOIN (QSYS2.syskeycst k JOIN QSYS2.SYSCST tc
                    ON (k.TABLE_SCHEMA = tc.TABLE_SCHEMA
                      AND k.TABLE_NAME = tc.TABLE_NAME
                      AND LEFT(tc.type,1) = 'P'))
                    ON (C.TABLE_SCHEMA = k.TABLE_SCHEMA
                       AND C.TABLE_NAME = k.TABLE_NAME
                       AND C.COLUMN_NAME = k.COLUMN_NAME)
                WHERE "
                . $this->quoteInto('UPPER(C.TABLE_NAME) = UPPER(?)', $tableName);

            if ($schemaName) {
                $sql .= $this->quoteInto(' AND UPPER(C.TABLE_SCHEMA) = UPPER(?)', $schemaName);
            }

            $sql .= " ORDER BY C.ORDINAL_POSITION FOR FETCH ONLY";
        }


/////////
Zend_Db_Adapter_Db2::lastSequenceId($sequenceName);

        if (!$this->_isI5) {
            $quotedSequenceName = $this->quoteIdentifier($sequenceName, true);
            $sql = 'SELECT PREVVAL FOR ' . $quotedSequenceName . ' AS VAL FROM SYSIBM.SYSDUMMY1';
        } else {
            $quotedSequenceName = $sequenceName;
            $sql = 'SELECT PREVVAL FOR ' . $this->quoteIdentifier($sequenceName, true) . ' AS VAL FROM QSYS2.QSQPTABL';
        }

/////////
Zend_Db_Adapter_Db2::nextSequenceId($sequenceName);

        $sql = 'SELECT NEXTVAL FOR '.$this->quoteIdentifier($sequenceName, true).' AS VAL FROM SYSIBM.SYSDUMMY1';

/////////
Zend_Db_Adapter_Db2::lastInsertId($tableName = null, $primaryKey = null, $idType = null);

        $sql = 'SELECT IDENTITY_VAL_LOCAL() AS VAL FROM SYSIBM.SYSDUMMY1';

/////////
Zend_Db_Adapter_Db2::limit($sql, $count, $offset = 0);

        if ($offset == 0) {
            $limit_sql = $sql . " FETCH FIRST $count ROWS ONLY";
            return $limit_sql;
        }
        $limit_sql = "SELECT z2.*
            FROM (
                SELECT ROW_NUMBER() OVER() AS \"ZEND_DB_ROWNUM\", z1.*
                FROM (
                    " . $sql . "
                ) z1
            ) z2
            WHERE z2.zend_db_rownum BETWEEN " . ($offset+1) . " AND " . ($offset+$count);
        
/////////
Zend_Db_Adapter_Db2::_i5LastInsertId($objectName = null, $idType = null);

        $sql = 'SELECT IDENTITY_VAL_LOCAL() AS VAL FROM QSYS2.QSQPTABL';
        return $this->fetchOne('SELECT IDENTITY_VAL_LOCAL() from ' . $this->quoteIdentifier($tableName));
            
/////////
Zend_Db_Adapter_Mysqli::limit($sql, $count, $offset = 0);
        $sql .= " LIMIT $count";
        if ($offset > 0) {
            $sql .= " OFFSET $offset";
        }

/////////
Zend_Db_Adapter_Oracle::lastSequenceId($sequenceName);

        $sql = 'SELECT '.$this->quoteIdentifier($sequenceName, true).'.CURRVAL FROM dual';

/////////
Zend_Db_Adapter_Oracle::nextSequenceId($sequenceName);        

        $sql = 'SELECT '.$this->quoteIdentifier($sequenceName, true).'.NEXTVAL FROM dual';

/////////
Zend_Db_Adapter_Oracle::listTables();

		$data = $this->fetchCol('SELECT table_name FROM all_tables');

/////////
Zend_Db_Adapter_Oracle::describeTable($tableName, $schemaName = null);

        $version = $this->getServerVersion();
        if (($version === null) || version_compare($version, '9.0.0', '>=')) {
            $sql = "SELECT TC.TABLE_NAME, TC.OWNER, TC.COLUMN_NAME, TC.DATA_TYPE,
                    TC.DATA_DEFAULT, TC.NULLABLE, TC.COLUMN_ID, TC.DATA_LENGTH,
                    TC.DATA_SCALE, TC.DATA_PRECISION, C.CONSTRAINT_TYPE, CC.POSITION
                FROM ALL_TAB_COLUMNS TC
                LEFT JOIN (ALL_CONS_COLUMNS CC JOIN ALL_CONSTRAINTS C
                    ON (CC.CONSTRAINT_NAME = C.CONSTRAINT_NAME AND CC.TABLE_NAME = C.TABLE_NAME AND CC.OWNER = C.OWNER AND C.CONSTRAINT_TYPE = 'P'))
                  ON TC.TABLE_NAME = CC.TABLE_NAME AND TC.COLUMN_NAME = CC.COLUMN_NAME
                WHERE UPPER(TC.TABLE_NAME) = UPPER(:TBNAME)";
            $bind[':TBNAME'] = $tableName;
            if ($schemaName) {
                $sql .= ' AND UPPER(TC.OWNER) = UPPER(:SCNAME)';
                $bind[':SCNAME'] = $schemaName;
            }
            $sql .= ' ORDER BY TC.COLUMN_ID';
        } else {
            $subSql="SELECT AC.OWNER, AC.TABLE_NAME, ACC.COLUMN_NAME, AC.CONSTRAINT_TYPE, ACC.POSITION
                from ALL_CONSTRAINTS AC, ALL_CONS_COLUMNS ACC
                  WHERE ACC.CONSTRAINT_NAME = AC.CONSTRAINT_NAME
                    AND ACC.TABLE_NAME = AC.TABLE_NAME
                    AND ACC.OWNER = AC.OWNER
                    AND AC.CONSTRAINT_TYPE = 'P'
                    AND UPPER(AC.TABLE_NAME) = UPPER(:TBNAME)";
            $bind[':TBNAME'] = $tableName;
            if ($schemaName) {
                $subSql .= ' AND UPPER(ACC.OWNER) = UPPER(:SCNAME)';
                $bind[':SCNAME'] = $schemaName;
            }
            $sql="SELECT TC.TABLE_NAME, TC.OWNER, TC.COLUMN_NAME, TC.DATA_TYPE,
                    TC.DATA_DEFAULT, TC.NULLABLE, TC.COLUMN_ID, TC.DATA_LENGTH,
                    TC.DATA_SCALE, TC.DATA_PRECISION, CC.CONSTRAINT_TYPE, CC.POSITION
                FROM ALL_TAB_COLUMNS TC, ($subSql) CC
                WHERE UPPER(TC.TABLE_NAME) = UPPER(:TBNAME)
                  AND TC.OWNER = CC.OWNER(+) AND TC.TABLE_NAME = CC.TABLE_NAME(+) AND TC.COLUMN_NAME = CC.COLUMN_NAME(+)";
            if ($schemaName) {
                $sql .= ' AND UPPER(TC.OWNER) = UPPER(:SCNAME)';
            }
            $sql .= ' ORDER BY TC.COLUMN_ID';
        }

/////////
Zend_Db_Adapter_Oracle::limit($sql, $count, $offset = 0);

                $limit_sql = "SELECT z2.*
            FROM (
                SELECT z1.*, ROWNUM AS \"zend_db_rownum\"
                FROM (
                    " . $sql . "
                ) z1
            ) z2
            WHERE z2.\"zend_db_rownum\" BETWEEN " . ($offset+1) . " AND " . ($offset+$count);
        return $limit_sql;
    }
/////////
Zend_Db_Adapter_Sqlsrv;//protected $_lastInsertSQL = 'SELECT SCOPE_IDENTITY() as Current_Identity';
    
/////////
Zend_Db_Adapter_Sqlsrv::lastInsertId($tableName = null, $primaryKey = null);

		$sql       = 'SELECT IDENT_CURRENT (' . $tableName . ') as Current_Identity';

/////////
Zend_Db_Adapter_Sqlsrv::insert($table, /*array*/ $bind);

        $sql = "INSERT INTO "
             . $this->quoteIdentifier($table, true)
             . ' (' . implode(', ', $cols) . ') '
             . 'VALUES (' . implode(', ', $vals) . ')'
             . ' ' . $this->_lastInsertSQL;

/////////
Zend_Db_Adapter_Sqlsrv::listTables();

        $sql = "SELECT name FROM sysobjects WHERE type = 'U' ORDER BY name";

/////////
Zend_Db_Adapter_Sqlsrv::limit($sql, $count, $offset = 0);

        if ($offset == 0) {
            $sql = preg_replace('/^SELECT\s/i', 'SELECT TOP ' . $count . ' ', $sql);
        } else {
            $orderby = stristr($sql, 'ORDER BY');

            if (!$orderby) {
                $over = 'ORDER BY (SELECT 0)';
            } else {
                $over = preg_replace('/\"[^,]*\".\"([^,]*)\"/i', '"inner_tbl"."$1"', $orderby);
            }

            // Remove ORDER BY clause from $sql
            $sql = preg_replace('/\s+ORDER BY(.*)/', '', $sql);

            // Add ORDER BY clause as an argument for ROW_NUMBER()
            $sql = "SELECT ROW_NUMBER() OVER ($over) AS \"ZEND_DB_ROWNUM\", * FROM ($sql) AS inner_tbl";

            $start = $offset + 1;
            $end = $offset + $count;

            $sql = "WITH outer_tbl AS ($sql) SELECT * FROM outer_tbl WHERE \"ZEND_DB_ROWNUM\" BETWEEN $start AND $end";
        }

/////////
plugins_Actions_Actions::archiveDay( $notification );

			$sqlJoinVisitTable = "LEFT JOIN ".Piwik_Common::prefixTable('log_visit')." as log_visit ON (log_visit.idvisit = log_link_visit_action.idvisit)"; 
			$sqlSegmentWhere = ' AND '.$segmentSql['sql'];
		$queryString = "SELECT name,
							type,
							idaction,
							count(distinct log_link_visit_action.idvisit) as `". Piwik_Archive::INDEX_NB_VISITS ."`, 
							count(distinct log_link_visit_action.idvisitor) as `". Piwik_Archive::INDEX_NB_UNIQ_VISITORS ."`,
							count(*) as `". Piwik_Archive::INDEX_PAGE_NB_HITS ."`							
					FROM ".Piwik_Common::prefixTable('log_link_visit_action')." as log_link_visit_action
							LEFT JOIN ".Piwik_Common::prefixTable('log_action')." as log_action ON (log_link_visit_action.%s = idaction)
							$sqlJoinVisitTable
					WHERE server_time >= ?
						AND server_time <= ?
						AND log_link_visit_action.idsite = ?
				 		AND %s > 0
				 		$sqlSegmentWhere
					GROUP BY idaction
					ORDER BY `". Piwik_Archive::INDEX_PAGE_NB_HITS ."` DESC";

		$queryString = "SELECT %s as idaction,
							count(distinct idvisitor) as `". Piwik_Archive::INDEX_PAGE_ENTRY_NB_UNIQ_VISITORS ."`, 
							count(*) as `". Piwik_Archive::INDEX_PAGE_ENTRY_NB_VISITS ."`,
							sum(visit_total_actions) as `". Piwik_Archive::INDEX_PAGE_ENTRY_NB_ACTIONS ."`,
							sum(visit_total_time) as `". Piwik_Archive::INDEX_PAGE_ENTRY_SUM_VISIT_LENGTH ."`,							
							sum(case visit_total_actions when 1 then 1 else 0 end) as `". Piwik_Archive::INDEX_PAGE_ENTRY_BOUNCE_COUNT ."`
					FROM ".Piwik_Common::prefixTable('log_visit')." 
					WHERE visit_last_action_time >= ?
						AND visit_last_action_time <= ?
						AND idsite = ?
				 		AND %s > 0
				 		$sqlSegmentWhere
					GROUP BY %s, idaction";
				 		
		$queryString = "SELECT %s as idaction,
							count(distinct idvisitor) as `". Piwik_Archive::INDEX_PAGE_EXIT_NB_UNIQ_VISITORS ."`,
							count(*) as `". Piwik_Archive::INDEX_PAGE_EXIT_NB_VISITS ."`
				 	FROM ".Piwik_Common::prefixTable('log_visit')." 
				 	WHERE visit_last_action_time >= ?
						AND visit_last_action_time <= ?
				 		AND idsite = ?
				 		AND %s > 0
				 		$sqlSegmentWhere
				 	GROUP BY %s, idaction";
				 		
		$queryString = "SELECT %s as idaction,
							sum(time_spent_ref_action) as `".Piwik_Archive::INDEX_PAGE_SUM_TIME_SPENT."`
					FROM ".Piwik_Common::prefixTable('log_link_visit_action')." AS log_link_visit_action
							$sqlJoinVisitTable
					WHERE server_time >= ?
						AND server_time <= ?
				 		AND log_link_visit_action.idsite = ?
				 		AND time_spent_ref_action > 0
				 		AND %s > 0
				 		$sqlSegmentWhere
				 	GROUP BY %s, idaction";
				 		
/////////
plugins_Dashboard_Controller::getLayoutForUser( $login, $idDashboard);

		$return = Piwik_FetchAll('SELECT layout 
								FROM '.Piwik_Common::prefixTable('user_dashboard') .
								' WHERE login = ? 
									AND iddashboard = ?', $paramsBind);


/////////
plugins_ExampleFeedburner::feedburner();        

		$feedburnerFeedName = Piwik_FetchOne('SELECT feedburnerName 
											  FROM '.Piwik_Common::prefixTable('site').
											' WHERE idsite = ?', $idSite );

/////////
plugins_ExamplePlugin::index();

		$txtQuery = "SELECT token_auth FROM ".Piwik_Common::prefixTable('user')." WHERE login = ?";
		$result = Piwik_FetchOne($txtQuery, array('anonymous'));

/////////
plugins_ExampleUI_API::getTemperaturesEvolution($date, $period);

		$query = "SELECT AVG(temperature)
					FROM server_temperatures
					WHERE date > ?
						AND date < ?
					GROUP BY date
					ORDER BY date ASC";

/////////
plugins_Goals_API::getGoals( $idSite );

		$goals = Piwik_FetchAll("SELECT * 
								FROM ".Piwik_Common::prefixTable('goal')." 
								WHERE idsite IN (".implode(", ", $idSite).")
									AND deleted = 0");

/////////
plugins_LanguagesManager_API::getLanguageForUser( $login );

		return Piwik_FetchOne('SELECT language FROM '.Piwik_Common::prefixTable('user_language') .
					' WHERE login = ? ', array($login ));

/////////
plugins_Live_API::getCounters($idSite, $lastMinutes, $segment = false);

		$sql = "SELECT 
				count(*) as visits,
				SUM(visit_total_actions) as actions,
				SUM(visit_goal_converted) as visitsConverted
		FROM ". Piwik_Common::prefixTable('log_visit') ." 
		WHERE idsite = ?
			AND visit_last_action_time >= ?
			$sqlSegment
		";

/////////
plugins_Live_API::getCleanedVisitorsFromDetails($visitorDetails, $idSite);

			$sql = "
				SELECT
					log_action.type as type,
					log_action.name AS url,
					log_action_title.name AS pageTitle,
					log_action.idaction AS pageIdAction,
					log_link_visit_action.idlink_va AS pageId,
					log_link_visit_action.server_time as serverTimePretty
				FROM " .Piwik_Common::prefixTable('log_link_visit_action')." AS log_link_visit_action
					INNER JOIN " .Piwik_Common::prefixTable('log_action')." AS log_action
					ON  log_link_visit_action.idaction_url = log_action.idaction
					LEFT JOIN " .Piwik_Common::prefixTable('log_action')." AS log_action_title
					ON  log_link_visit_action.idaction_name = log_action_title.idaction
				WHERE log_link_visit_action.idvisit = ?
				 ";
			$actionDetails = Piwik_FetchAll($sql, array($idvisit));
			
			// If the visitor converted a goal, we shall select all Goals
			$sql = "
				SELECT 
						'goal' as type,
						goal.name as goalName,
						goal.revenue as revenue,
						log_conversion.idlink_va as goalPageId,
						log_conversion.server_time as serverTimePretty,
						log_conversion.url as url
				FROM ".Piwik_Common::prefixTable('log_conversion')." AS log_conversion
				LEFT JOIN ".Piwik_Common::prefixTable('goal')." AS goal 
					ON (goal.idsite = log_conversion.idsite
						AND  
						goal.idgoal = log_conversion.idgoal)
					AND goal.deleted = 0
				WHERE log_conversion.idvisit = ?
			";

/////////
plugins_Live_API::loadLastVisitorDetailsFromDatabase($idSite, $period = false, $date = false, $segment = false, $filter_limit = false, $maxIdVisit = false, $visitorId = false, $minTimestamp = false);

		$where[] = "log_visit.idsite = ? ";
		$whereBind[] = $idSite;
		
		if(!empty($visitorId))
		{
			$where[] = "log_visit.idvisitor = ? ";
			$whereBind[] = Piwik_Common::hex2bin($visitorId);
		}

		if(!empty($maxIdVisit))
		{
			$where[] = "log_visit.idvisit < ? ";
			$whereBind[] = $maxIdVisit;
		}
		
		if(!empty($minTimestamp))
		{
			$where[] = "log_visit.visit_last_action_time > ? ";
			$whereBind[] = date("Y-m-d H:i:s", $minTimestamp);
		}

			$where[] = "log_visit.visit_last_action_time >= ?";
			$whereBind[] = $dateStart->toString('Y-m-d H:i:s');
			
			if(!in_array($date, array('now', 'today', 'yesterdaySameTime'))
				&& strpos($date, 'last') === false
				&& strpos($date, 'previous') === false
				&& Piwik_Date::factory($dateString)->toString('Y-m-d') != date('Y-m-d'))
			{
				$dateEnd = $processedPeriod->getDateEnd()->setTimezone($currentTimezone);
				$where[] = " log_visit.visit_last_action_time <= ?";
				$dateEndString = $dateEnd->addDay(1)->toString('Y-m-d H:i:s');
				$whereBind[] = $dateEndString;
			}

			$sqlWhere = "
			WHERE " . join(" 
				AND ", $where);
			
		$sql = "
				SELECT sub.* 
				FROM ( 
					SELECT 	*
					FROM " . Piwik_Common::prefixTable('log_visit') . " AS log_visit
					$sqlWhere
					$sqlSegment
					ORDER BY idsite, visit_last_action_time DESC
					LIMIT ".(int)$filter_limit."
				) AS sub
				GROUP BY sub.idvisit
				ORDER BY sub.visit_last_action_time DESC
			"; 
			
/////////
plugins_Login_Auth::authenticate();

			$login = Piwik_FetchOne(
					'SELECT login
					FROM '.Piwik_Common::prefixTable('user').' 
					WHERE token_auth = ?',
					array($this->token_auth)
			);
			
			$userToken = Piwik_FetchOne(
					'SELECT token_auth
					FROM '.Piwik_Common::prefixTable('user').' 
					WHERE login = ?',
					array($login)
			);
			

/////////
plugins_PDFReports_API::addReport( $idSite, $description, $period, $reports, $emailMe = true, $additionalEmails = false);

		$idReport = $db->fetchOne("SELECT max(idreport) + 1 
								FROM ".Piwik_Common::prefixTable('pdf'));


/////////
plugins_PDFReports_API::getReports($idSite = false, $period = false, $idReport = false, $ifSuperUserReturnOnlySuperUserReports = false);

		if(!Piwik::isUserIsSuperUser()
			|| $ifSuperUserReturnOnlySuperUserReports)
		{
			$sqlWhere .= "AND login = ?";
			$bind[] = Piwik::getCurrentUserLogin();
		}
		
		if(!empty($period))
		{
			$this->checkPeriod($period);
			$sqlWhere .= " AND period = ? ";
			$bind[] = $period;
		}
		if(!empty($idSite))
		{
			Piwik::checkUserHasViewAccess($idSite);
			$sqlWhere .= " AND idsite = ?";
			$bind[] = $idSite;
		}
		if(!empty($idReport))
		{
			$sqlWhere .= " AND idreport = ?";
			$bind[] = $idReport;
		}
		
		// Joining with the site table to work around pre-1.3 where reports could still be linked to a deleted site
		$reports = Piwik_FetchAll("SELECT * 
    							FROM ".Piwik_Common::prefixTable('pdf')." 
    								JOIN ".Piwik_Common::prefixTable('site')."
    								USING (idsite)
    							WHERE deleted = 0
    								$sqlWhere", $bind);

/////////
plugins_SitesManager_API::getSitesFromGroup($group);

		$sites = Zend_Registry::get('db')->fetchAll("SELECT * 
													FROM ".Piwik_Common::prefixTable("site")." 
													WHERE `group` = ?", $group);

/////////
plugins_SitesManager_API::getSitesGroups();

		$groups = Zend_Registry::get('db')->fetchAll("SELECT DISTINCT `group` FROM ".Piwik_Common::prefixTable("site"));

/////////
plugins_SitesManager_API::getSiteFromId( $idSite );

		$site = Zend_Registry::get('db')->fetchRow("SELECT * 
													FROM ".Piwik_Common::prefixTable("site")." 
													WHERE idsite = ?", $idSite);

/////////
plugins_SitesManager_API::getAliasSiteUrlsFromId( $idsite );

		$result = $db->fetchAll("SELECT url 
								FROM ".Piwik_Common::prefixTable("site_url"). " 
								WHERE idsite = ?", $idsite);

/////////
plugins_SitesManager_API::getSitesId();

		$result = Piwik_FetchAll("SELECT idsite FROM ".Piwik_Common::prefixTable('site'));

/////////
plugins_SitesManager_API::getSitesFromIds( $idSites, $limit = false );

		if($limit)
		{
			$limit = "LIMIT " . (int)$limit;		
		}
		
		$db = Zend_Registry::get('db');
		$sites = $db->fetchAll("SELECT * 
								FROM ".Piwik_Common::prefixTable("site")." 
								WHERE idsite IN (".implode(", ", $idSites).")
								ORDER BY idsite ASC $limit");

/////////
plugins_SitesManager_API::getSitesIdFromSiteUrl( $url );

		if(Piwik::isUserIsSuperUser())
		{
			$ids = Zend_Registry::get('db')->fetchAll(
					'SELECT idsite 
					FROM ' . Piwik_Common::prefixTable('site') . ' 
					WHERE main_url = ? ' .
					'UNION 
					SELECT idsite 
					FROM ' . Piwik_Common::prefixTable('site_url') . ' 
					WHERE url = ?', array($url, $url));
		}
		else
		{
			$login = Piwik::getCurrentUserLogin();
			$ids = Zend_Registry::get('db')->fetchAll(
					'SELECT idsite 
					FROM ' . Piwik_Common::prefixTable('site') . ' 
					WHERE main_url = ? ' .
						'AND idsite IN (' . Piwik_Access::getSqlAccessSite('idsite') . ') ' .
					'UNION 
					SELECT idsite 
					FROM ' . Piwik_Common::prefixTable('site_url') . ' 
					WHERE url = ? ' .
						'AND idsite IN (' . Piwik_Access::getSqlAccessSite('idsite') . ')', 
					array($url, $login, $url, $login));
		}

/////////
plugins_SitesManager_API::getUniqueSiteTimezones();
		
		$results = Piwik_FetchAll("SELECT distinct timezone FROM ".Piwik_Common::prefixTable('site'));

/////////
plugins_SitesManager_API::getPatternMatchSites($pattern);

		$bind = array('%'.$pattern.'%', 'http%'.$pattern.'%');
		$sites = $db->fetchAll("SELECT idsite, name, main_url 
								FROM ".Piwik_Common::prefixTable('site')." s	
								WHERE (		s.name like ? 
										OR 	s.main_url like ?) 
									AND idsite in ($ids_str) 
								LIMIT ".Piwik::getWebsitesCountToDisplay(), 
							$bind) ;

/////////
plugins_UserSettings::getDataTablePlugin();

		$toSelect = "sum(case config_pdf when 1 then 1 else 0 end) as pdf, 
							sum(case config_flash when 1 then 1 else 0 end) as flash, 
							sum(case config_java when 1 then 1 else 0 end) as java, 
							sum(case config_director when 1 then 1 else 0 end) as director,
							sum(case config_quicktime when 1 then 1 else 0 end) as quicktime,
							sum(case config_realplayer when 1 then 1 else 0 end) as realplayer,
							sum(case config_windowsmedia when 1 then 1 else 0 end) as windowsmedia,
							sum(case config_gears when 1 then 1 else 0 end) as gears,
							sum(case config_silverlight when 1 then 1 else 0 end) as silverlight,
							sum(case config_cookie when 1 then 1 else 0 end) as cookie	";

/////////
plugins_UsersManager_API::getUsers( $userLogins = '' );							

		$users = $db->fetchAll("SELECT * 
								FROM ".Piwik_Common::prefixTable("user")."
								$where 
								ORDER BY login ASC", $bind);

/////////
plugins_UsersManager_API::getUsersLogin();

		$users = $db->fetchAll("SELECT login 
								FROM ".Piwik_Common::prefixTable("user")." 
								ORDER BY login ASC");

/////////
plugins_UsersManager_API::getUsersSitesFromAccess( $access );

		$users = $db->fetchAll("SELECT login,idsite 
								FROM ".Piwik_Common::prefixTable("access")
								." WHERE access = ?
								ORDER BY login, idsite", $access);

/////////
plugins_UsersManager_API::getUsersAccessFromSite( $idSite );

		$users = $db->fetchAll("SELECT login,access 
								FROM ".Piwik_Common::prefixTable("access")
								." WHERE idsite = ?", $idSite);

/////////
plugins_UsersManager_API::getUsersWithSiteAccess( $idSite, $access );

		$users = $db->fetchAll("SELECT login
								FROM ".Piwik_Common::prefixTable("access")
								." WHERE idsite = ? AND access = ?", array($idSite, $access));

/////////
plugins_UsersManager_API::getSitesAccessFromUser( $userLogin );

		$users = $db->fetchAll("SELECT idsite,access 
								FROM ".Piwik_Common::prefixTable("access")
								." WHERE login = ?", $userLogin);

/////////
plugins_UsersManager_API::getUser( $userLogin );

		$user = $db->fetchRow("SELECT * 
								FROM ".Piwik_Common::prefixTable("user")
								." WHERE login = ?", $userLogin);

/////////
plugins_UsersManager_API::getUserByEmail( $userEmail );

		$user = $db->fetchRow("SELECT * 
								FROM ".Piwik_Common::prefixTable("user")
								." WHERE email = ?", $userEmail);

/////////
plugins_UsersManager_API::userExists( $userLogin );

		$count = Piwik_FetchOne("SELECT count(*) 
													FROM ".Piwik_Common::prefixTable("user"). " 
													WHERE login = ?", $userLogin);

/////////
plugins_UsersManager_API::userEmailExists( $userEmail );

		$count = Piwik_FetchOne("SELECT count(*) 
													FROM ".Piwik_Common::prefixTable("user"). " 
													WHERE email = ?", $userEmail);

/////////
plugins_VisitFrequency::archiveDay($notification);

		$query = "SELECT 	count(distinct idvisitor) as nb_uniq_visitors_returning,
							count(*) as nb_visits_returning, 
							sum(visit_total_actions) as nb_actions_returning,
							max(visit_total_actions) as max_actions_returning, 
							sum(visit_total_time) as sum_visit_length_returning,							
							sum(case visit_total_actions when 1 then 1 else 0 end) as bounce_count_returning,
							sum(case visit_goal_converted when 1 then 1 else 0 end) as nb_visits_converted_returning
				 	FROM ".Piwik_Common::prefixTable('log_visit')."
				 	WHERE visit_last_action_time >= ?
						AND visit_last_action_time <= ?
				 		AND idsite = ?
				 		AND visitor_returning = 1";

/////////
plugins_VisitorInterest::getTablePageGap();

			if(count($gap) == 2)
			{
				$minGap = $gap[0];
				$maxGap = $gap[1];
				$gapName = "'$minGap-$maxGap'";
				$select[] = "sum(case when visit_total_actions between $minGap and $maxGap then 1 else 0 end) as $gapName ";
			}
			else
			{
				$minGap = $gap[0];
				$plusEncoded = urlencode('+');
				$gapName = "'".$minGap.$plusEncoded."'";
				$select[] = "sum(case when visit_total_actions > $minGap then 1 else 0 end) as $gapName ";
			}

/////////
plugins_VisitorInterest::getTableTimeGap();

			if(count($gap) == 2)
			{
				$minGap = $gap[0] * 60;
				$maxGap = $gap[1] * 60;
				
				$gapName = "'".$minGap."-".$maxGap."'";
				$select[] = "sum(case when visit_total_time between $minGap and $maxGap then 1 else 0 end) as $gapName ";
			}
			else
			{
				$minGap = $gap[0] * 60;
				$gapName = "'$minGap'";
				$select[] = "sum(case when visit_total_time > $minGap then 1 else 0 end) as $gapName ";
			}

/////////
//Alter
/////////
Updates_0_2_10::getSql($schema = 'Myisam');

		return array(
			$tables['option'] => false,

			// 0.1.7 [463]
			'ALTER IGNORE TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				 CHANGE `location_provider` `location_provider` VARCHAR( 100 ) DEFAULT NULL' => '1054',

			// 0.1.7 [470]
			'ALTER TABLE `'. Piwik_Common::prefixTable('logger_api_call') .'`
				CHANGE `parameter_names_default_values` `parameter_names_default_values` TEXT,
				CHANGE `parameter_values` `parameter_values` TEXT,
				CHANGE `returned_value` `returned_value` TEXT' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('logger_error') .'`
				CHANGE `message` `message` TEXT' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('logger_exception') .'`
				CHANGE `message` `message` TEXT' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('logger_message') .'`
				CHANGE `message` `message` TEXT' => false,

			// 0.2.2 [489]
			'ALTER IGNORE TABLE `'. Piwik_Common::prefixTable('site') .'`
				 CHANGE `feedburnerName` `feedburnerName` VARCHAR( 100 ) DEFAULT NULL' => '1054',
		);

/////////
Updates_0_2_12::getSql($schema = 'Myisam');

		return array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('site') .'`
				CHANGE `ts_created` `ts_created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				DROP `config_color_depth`' => false,

			// 0.2.12 [673]
			// Note: requires INDEX privilege
			'DROP INDEX index_idaction ON `'. Piwik_Common::prefixTable('log_action') .'`' => '1091',
		);

/////////
Updates_0_2_27::getSql($schema = 'Myisam');
		
		$sqlarray = array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				ADD `visit_goal_converted` VARCHAR( 1 ) NOT NULL AFTER `visit_total_time`' => false,
			// 0.2.27 [826]
			'ALTER IGNORE TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				CHANGE `visit_goal_converted` `visit_goal_converted` TINYINT(1) NOT NULL' => false,
		);

		$sqlarray[ 'CREATE INDEX index_all ON '. $tableName .' (`idsite`,`date1`,`date2`,`name`,`ts_archived`)' ] = false;

/////////
Updates_0_2_32::getSql($schema = 'Myisam');
		
		return array(
			// 0.2.32 [941]
			'ALTER TABLE `'. Piwik_Common::prefixTable('access') .'`
				CHANGE `login` `login` VARCHAR( 100 ) NOT NULL' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('user') .'`
				CHANGE `login` `login` VARCHAR( 100 ) NOT NULL' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('user_dashboard') .'`
				CHANGE `login` `login` VARCHAR( 100 ) NOT NULL' => '1146',
			'ALTER TABLE `'. Piwik_Common::prefixTable('user_language') .'`
				CHANGE `login` `login` VARCHAR( 100 ) NOT NULL' => '1146',
		);

/////////
Updates_0_2_33::getSql($schema = 'Myisam');

		$sqlarray = array(
			// 0.2.33 [1020]
			'ALTER TABLE `'. Piwik_Common::prefixTable('user_dashboard') .'`
				CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci ' => '1146',
			'ALTER TABLE `'. Piwik_Common::prefixTable('user_language') .'`
				CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci ' => '1146',
		);
			$sqlarray[ 'ALTER TABLE `'. $table .'`
				CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci ' ] = false;
		
/////////
Updates_0_2_35::getSql($schema = 'Myisam');
			
		return array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('user_dashboard') .'`
				CHANGE `layout` `layout` TEXT NOT NULL' => false,
		);

/////////
Updates_0_4_1::getSql($schema = 'Myisam');

		return array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_conversion') .'`
				CHANGE `idlink_va` `idlink_va` INT(11) DEFAULT NULL' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_conversion') .'`
				CHANGE `idaction` `idaction` INT(11) DEFAULT NULL' => '1054',
		);

/////////
Updates_0_4_2::getSql($schema = 'Myisam');

		return array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				ADD `config_java` TINYINT(1) NOT NULL AFTER `config_flash`' => '1060',
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				ADD `config_quicktime` TINYINT(1) NOT NULL AFTER `config_director`' => '1060',
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				ADD `config_gears` TINYINT(1) NOT NULL AFTER  `config_windowsmedia`,
				ADD `config_silverlight` TINYINT(1) NOT NULL AFTER `config_gears`' => false,
		);

/////////
Updates_0_4::getSql($schema = 'Myisam');
		return array(
			// 0.4 [1140]
			'UPDATE `'. Piwik_Common::prefixTable('log_visit') .'`
				SET location_ip=location_ip+CAST(POW(2,32) AS UNSIGNED) WHERE location_ip < 0' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				CHANGE `location_ip` `location_ip` BIGINT UNSIGNED NOT NULL' => false,
			'UPDATE `'. Piwik_Common::prefixTable('logger_api_call') .'`
				SET caller_ip=caller_ip+CAST(POW(2,32) AS UNSIGNED) WHERE caller_ip < 0' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('logger_api_call') .'`
				CHANGE `caller_ip` `caller_ip` BIGINT UNSIGNED' => false,
		);

/////////
Updates_0_5_4::getSql($schema = 'Myisam');

		return array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_action') .'`
				 CHANGE `name` `name` TEXT' => false,
		);

/////////
Updates_0_5::getSql($schema = 'Myisam');
		
		return array(
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_action') . ' ADD COLUMN `hash` INTEGER(10) UNSIGNED NOT NULL AFTER `name`;' => '1060',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_visit') . ' CHANGE visit_exit_idaction visit_exit_idaction_url INTEGER(11) NOT NULL;' => '1054',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_visit') . ' CHANGE visit_entry_idaction visit_entry_idaction_url INTEGER(11) NOT NULL;' => '1054',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_link_visit_action') . ' CHANGE `idaction_ref` `idaction_url_ref` INTEGER(10) UNSIGNED NOT NULL;' => '1054',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_link_visit_action') . ' CHANGE `idaction` `idaction_url` INTEGER(10) UNSIGNED NOT NULL;' => '1054', 
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_link_visit_action') . ' ADD COLUMN `idaction_name` INTEGER(10) UNSIGNED AFTER `idaction_url_ref`;' => '1060',
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_conversion') . ' CHANGE `idaction` `idaction_url` INTEGER(11) UNSIGNED NOT NULL;' => '1054',
			'UPDATE ' . Piwik_Common::prefixTable('log_action') . ' SET `hash` = CRC32(name);' => false,
			'CREATE INDEX index_type_hash ON ' . Piwik_Common::prefixTable('log_action') . ' (type, hash);' => '1061',
			'DROP INDEX index_type_name ON ' . Piwik_Common::prefixTable('log_action') . ';' => '1091',
		);

/////////
Updates_0_6_rc1::getSql($schema = 'Myisam');
		
		return array(
			'ALTER TABLE ' . Piwik_Common::prefixTable('user') . ' CHANGE date_registered date_registered TIMESTAMP NULL' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('site') . ' CHANGE ts_created ts_created TIMESTAMP NULL' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('site') . ' ADD `timezone` VARCHAR( 50 ) NOT NULL AFTER `ts_created` ;' => false,
			'UPDATE ' . Piwik_Common::prefixTable('site') . ' SET `timezone` = "'.$defaultTimezone.'";' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('site') . ' ADD currency CHAR( 3 ) NOT NULL AFTER `timezone` ;' => false,
			'UPDATE ' . Piwik_Common::prefixTable('site') . ' SET `currency` = "'.$defaultCurrency.'";' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('site') . ' ADD `excluded_ips` TEXT NOT NULL AFTER `currency` ;' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('site') . ' ADD excluded_parameters VARCHAR( 255 ) NOT NULL AFTER `excluded_ips` ;' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_visit') . ' ADD INDEX `index_idsite_datetime_config`  ( `idsite` , `visit_last_action_time`  , `config_md5config` ( 8 ) ) ;' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_visit') . ' ADD INDEX index_idsite_idvisit (idsite, idvisit) ;' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_conversion') . ' DROP INDEX index_idsite_date' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_conversion') . ' DROP visit_server_date;' => false,
			'ALTER TABLE ' . Piwik_Common::prefixTable('log_conversion') . ' ADD INDEX index_idsite_datetime ( `idsite` , `server_time` )' => false,
		);

/////////
Updates_0_6_3::getSql($schema = 'Myisam');
		
		return array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'`
				CHANGE `location_ip` `location_ip` INT UNSIGNED NOT NULL' => false,
			'ALTER TABLE `'. Piwik_Common::prefixTable('logger_api_call') .'`
				CHANGE `caller_ip` `caller_ip` INT UNSIGNED' => false,
		);

/////////
Updates_0_7::getSql($schema = 'Myisam');

		return array(
			'ALTER TABLE `'. Piwik_Common::prefixTable('option') .'`
				CHANGE `option_name` `option_name` VARCHAR(255) NOT NULL' => false,
		);

/////////
Updates_1_2_rc1::getSql($schema = 'Myisam');
		
		return array(
			// Various performance improvements schema updates
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'` 
			    DROP `visit_server_date`,
			    DROP INDEX `index_idsite_date_config`,
			    DROP INDEX `index_idsite_datetime_config`,
		    	ADD `visit_entry_idaction_name` INT UNSIGNED NOT NULL AFTER `visit_entry_idaction_url`,
			    ADD `visit_exit_idaction_name` INT UNSIGNED NOT NULL AFTER `visit_exit_idaction_url`,
			    CHANGE `visit_exit_idaction_url` `visit_exit_idaction_url` INT UNSIGNED NOT NULL, 
			    CHANGE `visit_entry_idaction_url` `visit_entry_idaction_url` INT UNSIGNED NOT NULL,
			    CHANGE `referer_type` `referer_type` TINYINT UNSIGNED NULL DEFAULT NULL,
			    ADD `idvisitor` BINARY(8) NOT NULL AFTER `idsite`, 
			    ADD visitor_count_visits SMALLINT(5) UNSIGNED NOT NULL AFTER `visitor_returning`,
			    ADD visitor_days_since_last SMALLINT(5) UNSIGNED NOT NULL,
			    ADD visitor_days_since_first SMALLINT(5) UNSIGNED NOT NULL,
			    ADD `config_id` BINARY(8) NOT NULL AFTER `config_md5config`,
			    ADD custom_var_k1 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v1 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k2 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v2 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k3 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v3 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k4 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v4 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k5 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v5 VARCHAR(50) DEFAULT NULL
			   ' => false,
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_link_visit_action') .'` 
				ADD `idsite` INT( 10 ) UNSIGNED NOT NULL AFTER `idlink_va` , 
				ADD `server_time` DATETIME AFTER `idsite`,
				ADD `idvisitor` BINARY(8) NOT NULL AFTER `idsite`,
				ADD `idaction_name_ref` INT UNSIGNED NOT NULL AFTER `idaction_name`,
				ADD INDEX `index_idsite_servertime` ( `idsite` , `server_time` )
			   ' => false,

		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_conversion') .'` 
			    DROP `referer_idvisit`,
			    ADD `idvisitor` BINARY(8) NOT NULL AFTER `idsite`,
			    ADD visitor_count_visits SMALLINT(5) UNSIGNED NOT NULL,
			    ADD visitor_days_since_first SMALLINT(5) UNSIGNED NOT NULL,
			    ADD custom_var_k1 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v1 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k2 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v2 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k3 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v3 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k4 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v4 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_k5 VARCHAR(50) DEFAULT NULL,
    			ADD custom_var_v5 VARCHAR(50) DEFAULT NULL
			   ' => false,
		
			// Migrate 128bits IDs inefficiently stored as 8bytes (256 bits) into 64bits
    		'UPDATE '.Piwik_Common::prefixTable('log_visit') .'
    			SET idvisitor = binary(unhex(substring(visitor_idcookie,1,16))),
    				config_id = binary(unhex(substring(config_md5config,1,16)))
	   			' => false,	
    		'UPDATE '.Piwik_Common::prefixTable('log_conversion') .'
    			SET idvisitor = binary(unhex(substring(visitor_idcookie,1,16)))
	   			' => false,	
			
			// Drop migrated fields
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'` 
		    	DROP visitor_idcookie, 
		    	DROP config_md5config
		    	' => false,
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_conversion') .'` 
		    	DROP visitor_idcookie
		    	' => false,
		
			// Recreate INDEX on new field
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'` 
		    	ADD INDEX `index_idsite_datetime_config` (idsite, visit_last_action_time, config_id)
		    	' => false,
		
			// Backfill action logs as best as we can
			'UPDATE '.Piwik_Common::prefixTable('log_link_visit_action') .' as action, 
				  	'.Piwik_Common::prefixTable('log_visit') .'  as visit
                SET action.idsite = visit.idsite, 
                	action.server_time = visit.visit_last_action_time, 
                	action.idvisitor = visit.idvisitor
                WHERE action.idvisit=visit.idvisit
                ' => false, 
		
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_link_visit_action') .'` 
				CHANGE `server_time` `server_time` DATETIME NOT NULL
			   ' => false,

			// New index used max once per request, in case this table grows significantly in the future
			'ALTER TABLE `'. Piwik_Common::prefixTable('option') .'` ADD INDEX ( `autoload` ) ' => false,
		
		    // new field for websites
		    'ALTER TABLE `'. Piwik_Common::prefixTable('site') .'` ADD `group` VARCHAR( 250 ) NOT NULL' => false,
		);

/////////
Updates_1_2_3::getSql($schema = 'Myisam');

		return array(
			// LOAD DATA INFILE uses the database's charset
			'ALTER DATABASE `'. Zend_Registry::get('config')->database->dbname .'` DEFAULT CHARACTER SET utf8' => false,

			// Various performance improvements schema updates
			'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'` 
				DROP INDEX index_idsite_datetime_config,
				DROP INDEX index_idsite_idvisit,
				ADD INDEX index_idsite_config_datetime (idsite, config_id, visit_last_action_time),
				ADD INDEX index_idsite_datetime (idsite, visit_last_action_time)' => false,
		);

/////////
Updates_1_2_5_rc1::getSql($schema = 'Myisam');
		
		return array(
		    'ALTER TABLE `'. Piwik_Common::prefixTable('goal') .'` 
		    	ADD `allow_multiple` tinyint(4) NOT NULL AFTER case_sensitive' => false,
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_conversion') .'` 
				ADD buster int unsigned NOT NULL AFTER revenue,
				DROP PRIMARY KEY,
		    	ADD PRIMARY KEY (idvisit, idgoal, buster)' => false,
		);

/////////
Updates_1_2_5_rc7::getSql($schema = 'Myisam');
		
		return array(
		    'ALTER TABLE `'. Piwik_Common::prefixTable('log_visit') .'` 
		    	ADD INDEX index_idsite_idvisitor (idsite, idvisitor)' => false,
		);

/////////
ExampleFeedburner::install();

			Piwik_Exec('ALTER TABLE '.Piwik_Common::prefixTable('site'). " ADD `feedburnerName` VARCHAR( 100 ) DEFAULT NULL");

/////////
ExampleFeedburner::uninstall();

		Piwik_Query('ALTER TABLE '.Piwik_Common::prefixTable('site'). " DROP `feedburnerName`");

/////////
Provider::install();

		$query = "ALTER IGNORE TABLE `".Piwik_Common::prefixTable('log_visit')."` ADD `location_provider` VARCHAR( 100 ) NULL";

/////////
Provider::uninstall();
		
		$query = "ALTER TABLE `".Piwik_Common::prefixTable('log_visit')."` DROP `location_provider`";

/////////
//Update
/////////
Db_Schema_Myisam::createAnonymousUser();

		$db->query("INSERT INTO ". Piwik_Common::prefixTable("user") . "
					VALUES ( 'anonymous', '', 'anonymous', 'anonymous@example.org', 'anonymous', '".Piwik_Date::factory('now')->getDatetime()."' );" );

/////////
Tracker_Action::loadIdActionNameAndUrl();

		$sql = "INSERT INTO ". Piwik_Common::prefixTable('log_action'). 
				"( name, hash, type ) VALUES (?,CRC32(?),?)";


/////////
Tracker_Action::record( $idVisit, $visitorIdCookie, $idRefererActionUrl, $idRefererActionName, $timeSpentRefererAction);

		Piwik_Tracker::getDatabase()->query( 
						"INSERT INTO ".Piwik_Common::prefixTable('log_link_visit_action')
						." (idvisit, idsite, idvisitor, server_time, idaction_url, idaction_name, idaction_url_ref, idaction_name_ref, time_spent_ref_action) 
							VALUES (?,?,?,?,?,?,?,?,?)",
					array(	$idVisit, 
							$this->idSite, 
							$visitorIdCookie,
							Piwik_Tracker::getDatetimeFromTimestamp($this->timestamp),
							$this->getIdActionUrl(), 
							$idActionName , 
							$idRefererActionUrl, 
							$idRefererActionName, 
							$timeSpentRefererAction
		));

/////////
Tracker_Db::recordProfiling();

			$queryProfiling = "INSERT INTO ".Piwik_Common::prefixTable('log_profiling')."
						(query,count,sum_time_ms) VALUES (?,$count,$time)
						ON DUPLICATE KEY 
							UPDATE count=count+$count,sum_time_ms=sum_time_ms+$time";

/////////
Tracker_GoalManager::recordGoals($idSite, $visitorInformation, $visitCustomVariables, $action, $referrerTimestamp, $referrerUrl, $referrerCampaignName, $referrerCampaignKeyword);

			$sql = "INSERT IGNORE INTO " . Piwik_Common::prefixTable('log_conversion') . "	
					($fields) VALUES ($bindFields) ";

/////////
Tracker_Visit::saveVisitorInformation();

		$sql = "INSERT INTO ".Piwik_Common::prefixTable('log_visit'). " ($fields) VALUES ($values)";
		$bind = array_values($this->visitorInfo);

/////////
ArchiveProcessing::insertRecord($name, $value);

		$query = "INSERT IGNORE INTO ".$table->getTableName()." 
					(". implode(", ", $this->getInsertFields()).")
					VALUES (?,?,?,?,?,?,?,?)";

/////////
Option::set($name, $value, $autoload = 0);
		
		Piwik_Query('INSERT INTO `'. Piwik_Common::prefixTable('option') . '` (option_name, option_value, autoload) '.
					' VALUES (?, ?, ?) '.
					' ON DUPLICATE KEY UPDATE option_value = ?', 
					array($name, $value, $autoload, $value));

/////////
Piwik::tableInsertBatchIterate($tableName, $fields, $values, $ignoreWhenDuplicate = true);					
					
		$query = "INSERT $ignore
				INTO ".$tableName."
				$fieldList
				VALUES (".Piwik_Archive_Array::getSqlStringFieldsArray($row).")";

/////////
Cache_Backend_Sqlite::save($data, $id, $tags = array(), $specificLifetime = false);	

        $this->_query("DELETE FROM cache WHERE id='$id'");
        $sql = "INSERT INTO cache (id, content, lastModified, expire) VALUES ('$id', '$data', $mktime, $expire)";

/////////
Cache_Backend_Sqlite::_registerTag($id, $tag);

        $res = $this->_query("DELETE FROM TAG WHERE name='$tag' AND id='$id'");
        $res = $this->_query("INSERT INTO tag (name, id) VALUES ('$tag', '$id')");

/////////
Cache_Backend_Sqlite::_buildStructure();

        $this->_query('DROP INDEX tag_id_index');
        $this->_query('DROP INDEX tag_name_index');
        $this->_query('DROP INDEX cache_id_expire_index');
        $this->_query('DROP TABLE version');
        $this->_query('DROP TABLE cache');
        $this->_query('DROP TABLE tag');
        $this->_query('CREATE TABLE version (num INTEGER PRIMARY KEY)');
        $this->_query('CREATE TABLE cache (id TEXT PRIMARY KEY, content BLOB, lastModified INTEGER, expire INTEGER)');
        $this->_query('CREATE TABLE tag (name TEXT, id TEXT)');
        $this->_query('CREATE INDEX tag_id_index ON tag(id)');
        $this->_query('CREATE INDEX tag_name_index ON tag(name)');
        $this->_query('CREATE INDEX cache_id_expire_index ON cache(id, expire)');
        $this->_query('INSERT INTO version (num) VALUES (1)');

/////////
Db_Adapter_Abstract::insert($table, /*array*/ $bind);
        
        $sql = "INSERT INTO "
             . $this->quoteIdentifier($table, true)
             . ' (' . implode(', ', $cols) . ') '
             . 'VALUES (' . implode(', ', $vals) . ')';

/////////
Db_Adapter_Sqlsrv::insert($table, /*array*/ $bind);


        $sql = "INSERT INTO "
             . $this->quoteIdentifier($table, true)
             . ' (' . implode(', ', $cols) . ') '
             . 'VALUES (' . implode(', ', $vals) . ')'
             . ' ' . $this->_lastInsertSQL;
             
/////////
Dashboard_Controller::saveLayoutForUser( $login, $idDashboard, $layout);

		Piwik_Query('INSERT INTO '.Piwik_Common::prefixTable('user_dashboard') .
					' (login, iddashboard, layout)
						VALUES (?,?,?)
					ON DUPLICATE KEY UPDATE layout=?',
					$paramsBind);

/////////
LanguagesManager_API::setLanguageForUser($login, $languageCode);

		Piwik_Query('INSERT INTO '.Piwik_Common::prefixTable('user_language') .
					' (login, language)
						VALUES (?,?)
					ON DUPLICATE KEY UPDATE language=?',
					$paramsBind);

/////////
//Update        
/////////
ExampleFeedburner::saveFeedburnerName();

			Piwik_Query('UPDATE '.Piwik_Common::prefixTable('site').' 
						 SET feedburnerName = ? WHERE idsite = ?', 
				array(Piwik_Common::getRequestVar('name','','string'), Piwik_Common::getRequestVar('idSite',1,'int'))
				);

/////////
Goals_API::deleteGoal( $idSite, $idGoal );

		Piwik_Query("UPDATE ".Piwik_Common::prefixTable('goal')."
										SET deleted = 1
										WHERE idsite = ? 
											AND idgoal = ?",
									array($idSite, $idGoal));
		Piwik_Query("DELETE FROM ".Piwik_Common::prefixTable("log_conversion")." WHERE idgoal = ?", $idGoal);

/////////
Tracker_Visit::handleKnownVisit($idActionUrl, $idActionName, $someGoalsConverted);

		$sqlQuery = "UPDATE ". Piwik_Common::prefixTable('log_visit')."
						SET $sqlActionUpdate ".implode($updateParts, ', ')."
						WHERE idsite = ?
							AND idvisit = ?";

/////////
Updater::getSqlQueriesToExecute();

    		$queries[] = 'UPDATE `'.Piwik_Common::prefixTable('option').'`
    				SET option_value = "' .$fileVersion.'" 
    				WHERE option_name = "'. $this->getNameInOptionTable($componentName).'";';

/////////
Updater::___expire($id);

        $this->_query("UPDATE cache SET lastModified=$time, expire=$time WHERE id='$id'");

/////////
//Update        
/////////
Updates_0_2_37::getSql($schema = 'Myisam');

		return array(
			'DELETE FROM `'.  Piwik_Common::prefixTable('user_dashboard') ."`
				WHERE layout LIKE '%.getLastVisitsGraph%'
				OR layout LIKE '%.getLastVisitsReturningGraph%'" => false,
		);

/////////
ArchiveProcessing::postCompute();

		Piwik_Query("DELETE FROM ".$this->tableArchiveNumeric->getTableName()." 
					WHERE idarchive = ? AND name = '".$done."'",
					array($this->idArchive)
		);

/////////
Option::delete($name, $value = null);

		$sql = 'DELETE FROM `'. Piwik_Common::prefixTable('option') . '` WHERE option_name = ?';
		$sql .= ' AND option_value = ?';

/////////
Option::deleteLike($name, $value = null);

		$sql = 'DELETE FROM `'. Piwik_Common::prefixTable('option') . '` WHERE option_name LIKE ?';
		$sql .= ' AND option_value = ?';
		
/////////
Cache_Backend_Sqlite::_clean($mode = Zend_Cache::CLEANING_MODE_ALL, $tags = array());

                $res1 = $this->_query('DELETE FROM cache');
                $res2 = $this->_query('DELETE FROM tag');
                $res1 = $this->_query("DELETE FROM tag WHERE id IN (SELECT id FROM cache WHERE expire>0 AND expire<=$mktime)");
                $res2 = $this->_query("DELETE FROM cache WHERE expire>0 AND expire<=$mktime");
                
/////////
Db_Adapter::delete($table, $where = '');

        $sql = "DELETE FROM "
             . $this->quoteIdentifier($table, true)
             . (($where) ? " WHERE $where" : '');

/////////
Dashboard::deleteDashboardLayout($notification);

		Piwik_Query('DELETE FROM ' . Piwik_Common::prefixTable('user_dashboard') . ' WHERE login = ?', array($userLogin));

/////////
Goals_API::deleteGoal( $idSite, $idGoal );
		Piwik_Query("UPDATE ".Piwik_Common::prefixTable('goal')."
										SET deleted = 1
										WHERE idsite = ? 
											AND idgoal = ?",
									array($idSite, $idGoal));
		Piwik_Query("DELETE FROM ".Piwik_Common::prefixTable("log_conversion")." WHERE idgoal = ?", $idGoal);

/////////
LanguagesManager::deleteUserLanguage($notification);

		Piwik_Query('DELETE FROM ' . Piwik_Common::prefixTable('user_language') . ' WHERE login = ?', $userLogin);
/////////
PDFReports::deleteUserReport($notification);

		Piwik_Query('DELETE FROM ' . Piwik_Common::prefixTable('pdf') . ' WHERE login = ?', $userLogin);
		
/////////
SitesManager_API::deleteSite( $idSite );

		$db->query("DELETE FROM ".Piwik_Common::prefixTable("site")." 
					WHERE idsite = ?", $idSite);
		
		$db->query("DELETE FROM ".Piwik_Common::prefixTable("site_url")." 
					WHERE idsite = ?", $idSite);
		
		$db->query("DELETE FROM ".Piwik_Common::prefixTable("access")." 
					WHERE idsite = ?", $idSite);

/////////
UsersManager_API::deleteUserOnly( $userLogin );

		$db->query("DELETE FROM ".Piwik_Common::prefixTable("user")." WHERE login = ?", $userLogin);

/////////
UsersManager_API::deleteUserAccess( $userLogin, $idSites = null );

			$db->query(	"DELETE FROM ".Piwik_Common::prefixTable("access").
						" WHERE login = ?",
					array( $userLogin) );
				$db->query(	"DELETE FROM ".Piwik_Common::prefixTable("access").
							" WHERE idsite = ? AND login = ?",
						array($idsite, $userLogin)
				);
					
/////////
             
/////////
             
/////////
             