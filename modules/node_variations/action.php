<?php
/**
* @package ContentExperiments
* @author  Serhey Dolgushev <dolgushev.serhey@gmail.com>
* @date    01 Jun 2013
**/

$http = eZHTTPTool::instance();
$node = eZContentObjectTreeNode::fetch( (int) $Params['NodeID'] );
if( $node instanceof eZContentObjectTreeNode === false ) {
$Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );
}

$redirectURL = $node->attribute( 'url_alias' ) . '/(disable_view_cache)/' . md5( rand() . '-' . microtime() );
if( $http->hasVariable( 'BrowseVariationNode' ) ) {
$ini = eZINI::instance( 'shopping.ini' );
$browseParameters = array(
'action_name' => 'AddNodeVariation',
'type'        => 'NewObjectAddNodeAssignment',
'from_page'   => $redirectURL
);
return eZContentBrowse::browse( $browseParameters, $Params['Module'] );
} elseif( $http->hasVariable( 'CreateVariation' ) ) {
$version       = $http->hasVariable( 'VariationVersion' ) ? trim( $http->variable( 'VariationVersion' ) ) : null;
$variationNode = $http->hasVariable( 'VariationNodeID' )
? eZContentObjectTreeNode::fetch( (int) $http->variable( 'VariationNodeID' ) )
: null;

if(
$variationNode instanceof eZContentObjectTreeNode
&& strlen( $version ) > 0
) {
$variation = new NodeVariation(
array(
'node_id'           => $node->attribute( 'node_id' ),
'variation_node_id' => $variationNode->attribute( 'node_id' ),
'version'           => $version
)
);
$variation->store();
}
} elseif( $http->hasVariable( 'RemoveVariations' ) ) {
$variationIDs = $http->hasVariable( 'NodeVariationID' ) ? (array) $http->variable( 'NodeVariationID' ) : array();
foreach( $variationIDs as $variationID ) {
$variation = NodeVariation::fetch( $variationID );
if( $variation instanceof NodeVariation ) {
$variation->remove();
}
}
} elseif( $http->hasVariable( 'UpdateVariations' ) ) {
$versions = $http->hasVariable( 'NodeVariationVersions' ) ? (array) $http->variable( 'NodeVariationVersions' ) : array();
foreach( $versions as $variationID => $version ) {
$variation = NodeVariation::fetch( $variationID );
if( $variation instanceof NodeVariation ) {
$variation->setAttribute( 'version', $version );
$variation->store();
}
}
}

return $Params['Module']->redirectTo( $redirectURL );
