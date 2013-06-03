<?php
/**
 * @package ContentExperiments
 * @class   NodeVariationMultivariateTestingHandlerClass
 * @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
 * @date    03 Jun 2013
 **/

class NodeVariationMultivariateTestingHandlerClass implements ezpMultivariateTestHandlerInterface
{
	public function isEnabled() {
		return eZINI::instance( 'content.ini' )->variable( 'TestingSettings', 'MultivariateTesting' ) === 'enabled';
	}

	public function execute( $nodeID ) {
		$variations = NodeVariation::fetchList( $nodeID );
		if( count( $variations ) > 0 ) {
			$http = eZHTTPTool::instance();
			foreach( $variations as $variation ) {
				if( $http->hasVariable( $variation->attribute( 'version' ) ) ) {
					$nodeID = $variation->attribute( 'variation_node_id' );
					break;
				}
			}
		}

		return $nodeID;
	}
}
