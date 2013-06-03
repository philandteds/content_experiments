{def $variations = fetch( 'node_variations', 'fetch_variations', hash( 'node_id',  $node.node_id ) )}
<li id="node-tab-variations" class="middle">
	<a href="/(tab)/variations" title="{'Node variations, which might be used in A/B testing.'|i18n( 'design/admin/node/view/full' )}">{'Variations'|i18n( 'design/admin/node/view/full' )}{if count( $variations )} ({$variations|count}){/if}</a>
</li>
{undef $variations}