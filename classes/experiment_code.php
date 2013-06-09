<?php
/**
 * @package ContentExperiments
 * @class   ExperimentCode
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    06 Jun 2013
 **/

class ExperimentCode extends eZPersistentObject
{
	public static function definition() {
		return array(
			'fields'              => array(
				'id' => array(
					'name'     => 'ID',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'node_id' => array(
					'name'     => 'NodeID',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'experiment_code' => array(
					'name'     => 'version',
					'datatype' => 'string',
					'default'  => null,
					'required' => true
				)
			),
			'function_attributes' => array(),
			'keys'                => array( 'id' ),
			'sort'                => array( 'id' => 'asc' ),
			'increment_key'       => 'id',
			'class_name'          => __CLASS__,
			'name'                => 'node_experiment_codes'
		);
	}

	public static function fetchByNodeID( $nodeID ) {
		return array(
			'result' => eZPersistentObject::fetchObject(
				self::definition(),
				null,
				array( 'node_id' => $nodeID ),
				true
			)
		);
	}
}
