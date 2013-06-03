{def $browse_node = false()}
{if ezhttp_hasvariable( 'SelectedNodeIDArray', 'post' )}
	{set $browse_node = fetch( 'content', 'node', hash( 'node_id',  ezhttp( 'SelectedNodeIDArray', 'post' )[0] ) )}
{/if}
<form method="post" action="{concat( 'node_variations/action/', $node.node_id )|ezurl( 'no' )}">
	<div class="block">
		<fieldset>
			<legend>{'Create new variation'|i18n( 'design/admin/node/view/full' )}</legend>

			{if $browse_node}
				<input type="hidden" name="VariationNodeID" value="{$browse_node.node_id}" />
			{/if}
			{'Variation node'|i18n( 'design/admin/node/view/full' )}:{if $browse_node}<a href="{$browse_node.url_alias|ezurl( 'no' )}" target="_blank">{$browse_node.name|wash}</a>{else}<input class="button" type="submit" name="BrowseVariationNode" value="{'Browse'|i18n( 'design/admin/node/view/full' )}" />{/if} {'Version'|i18n( 'design/admin/node/view/full' )}:	<input type="text" name="VariationVersion" value=""/>
			<input class="button" type="submit" value="{'Create'|i18n( 'design/admin/node/view/full' )}" name="CreateVariation" />
		</fieldset>
	</div>
</form>

{def $variations = fetch( 'node_variations', 'fetch_variations', hash( 'node_id',  $node.node_id ) )}
{if gt( count( $variations ), 0 )}
<form name="variationsForm" method="post" action="{concat( 'node_variations/action/', $node.node_id )|ezurl( 'no' )}">
	<fieldset>
		<legend>{'Existing variations'|i18n( 'design/admin/node/view/full' )}</legend>

		<table class="list" cellspacing="0" summary="{'Existing variations'|i18n( 'design/admin/node/view/full' )}">
			<tbody>
				<tr>
	    			<th class="tight">
						<img src="/design/admin2/images/toggle-button-16x16.gif" width="16" height="16" alt="{'Invert selection.'|i18n( 'design/admin/node/view/full' )}" title="{'Invert selection.'|i18n( 'design/admin/node/view/full' )}" onclick="ezjs_toggleCheckboxes( document.variationsForm, 'NodeVariationID[]' ); return false;"></th>
					<th>{'Variation node'|i18n( 'design/admin/node/view/full' )}</th>
					<th>{'Version'|i18n( 'design/admin/node/view/full' )}</th>
				</tr>
				{foreach $variations as $variation sequence array( 'bgdark', 'bglight' ) as $style}
				<tr class="{$style}">
					<td><input type="checkbox" name="NodeVariationID[]" value="{$variation.id}" /></td>
					<td><a href="{$variation.variation_node.url_alias|ezurl( 'no' )}">{$variation.variation_node.name|wash}</a></td>
					<td><input type="text" name="NodeVariationVersions[{$variation.id}]" value="{$variation.version|wash}" /></td>
				</tr>
				{/foreach}
			</tbody>
		</table>

		<div class="block">
			<div class="button-left">
				<input class="button" type="submit" name="RemoveVariations" value="{'Remove selected'|i18n( 'design/admin/node/view/full' )}" />
	    	</div>
			<div class="button-right">
				<input class="button" type="submit" name="UpdateVariations" value="{'Update'|i18n( 'design/admin/node/view/full' )}" />
			</div>
			<div class="break"></div>
		</div>

	</fieldset>
</form>
{/if}