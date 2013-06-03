<?php
/**
 * @package Variations
 * @class   NodeVariation
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    02 Jun 2013
 **/

class NodeVariation extends eZPersistentObject
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
				'variation_node_id' => array(
					'name'     => 'VariationNodeID',
					'datatype' => 'integer',
					'default'  => 0,
					'required' => true
				),
				'version' => array(
					'name'     => 'version',
					'datatype' => 'string',
					'default'  => null,
					'required' => true
				)
			),
			'function_attributes' => array(
				'node'           => 'getNode',
				'variation_node' => 'getVariationNode'
			),
			'keys'                => array( 'id' ),
			'sort'                => array( 'id' => 'asc' ),
			'increment_key'       => 'id',
			'class_name'          => __CLASS__,
			'name'                => 'node_variations'
		);
	}

	public function getNode() {
		return eZContentObjectTreeNode::fetch( $this->attribute( 'node_id' ) );
	}

	public function getVariationNode() {
		return eZContentObjectTreeNode::fetch( $this->attribute( 'variation_node_id' ) );
	}

	public static function fetch( $id ) {
		return eZPersistentObject::fetchObject(
			self::definition(),
			null,
			array( 'id' => $id ),
			true
		);
	}

	public static function fetchList( $nodeID = null ) {
		$conds = null;
		if( $nodeID !== null ) {
			$conds = array(
				'node_id' => $nodeID
			);
		}

		return eZPersistentObject::fetchObjectList(
			self::definition(),
			null,
			$conds
		);
	}

	public function fetchNodeVariations( $nodeID = null ) {
		return array(
			'result' => self::fetchList( $nodeID )
		);
	}
}
