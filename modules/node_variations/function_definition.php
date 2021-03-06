<?php
/**
 * @package ContentExperiments
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    02 Jun 2013
 **/

$FunctionList = array(
	'fetch_variations' => array(
		'name'           => 'fetch_variations',
		'call_method'    => array(
			'class'  => 'NodeVariation',
			'method' => 'fetchNodeVariations'
		),
		'parameter_type' => 'standard',
		'parameters'     => array(
			array(
				'name'     => 'node_id',
				'type'     => 'int',
				'required' => true,
				'default'  => null
			)
		)
	),
	'fetch_experiment_code' => array(
		'name'           => 'fetch_experiment_code',
		'call_method'    => array(
			'class'  => 'ExperimentCode',
			'method' => 'fetchByNodeID'
		),
		'parameter_type' => 'standard',
		'parameters'     => array(
			array(
				'name'     => 'node_id',
				'type'     => 'int',
				'required' => true,
				'default'  => null
			)
		)
	)
);