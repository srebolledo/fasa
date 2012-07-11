<div class="emsefors index">
	<h2><?php __('Emsefors');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('nombre');?></th>
			<th><?php echo $this->Paginator->sort('lugar');?></th>
			<th><?php echo $this->Paginator->sort('unity_id');?></th>
			<th><?php echo $this->Paginator->sort('filial_id');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($emsefors as $emsefor):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $emsefor['Emsefor']['id']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Emsefor']['nombre']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Emsefor']['lugar']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Emsefor']['unity_id']; ?>&nbsp;</td>
		<td><?php echo $emsefor['Emsefor']['filial_id']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $emsefor['Emsefor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $emsefor['Emsefor']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $emsefor['Emsefor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $emsefor['Emsefor']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Emsefor', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Filials', true), array('controller' => 'filials', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Filial', true), array('controller' => 'filials', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Unities', true), array('controller' => 'unities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unity', true), array('controller' => 'unities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Onereports', true), array('controller' => 'onereports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Onereport', true), array('controller' => 'onereports', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tworeports', true), array('controller' => 'tworeports', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tworeport', true), array('controller' => 'tworeports', 'action' => 'add')); ?> </li>
	</ul>
</div>
